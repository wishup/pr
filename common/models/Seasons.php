<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use common\models\Users;
use common\models\UsersIds;

/**
 * This is the model class for table "seasons".
 *
 * @property integer $id
 * @property string $title
 * @property integer $active
 *
 * @property UsersId[] $users
 */
class Seasons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'active', 'year'], 'required'],
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['year'], 'string', 'max' => 4],
            [['year'], 'checkYear'],
        ];
    }

    public function checkYear($attribute, $params)
    {
        if( (int)$this->year <1900 || (int)$this->year > (int)date("Y") ){

            $this->addError($attribute, Yii::t('app', 'Incorrect year.'));

        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'active' => 'Active',
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(UsersId::className(), ['season_id' => 'id']);
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['=', 'active', $this->active]);

        return $dataProvider;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here

            if( $this->active == 1 ){

                Seasons::updateAll(['active' => 0]);

            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        $users = Users::find()->all();

        foreach( $users as $user ) {

            if (!UsersId::find()->where("user_id=" . $user->id . " AND season_id=" . $this->id)->one()) {

                if ($maxId = UsersId::find()->orderBy('dynamic_id desc')->limit(1)->one()) {
                    $dyn_id = $maxId->dynamic_id + 1;
                } else {
                    $dyn_id = 1;
                }

                $users_id = new UsersId();
                $users_id->user_id = $user->id;
                $users_id->season_id = $this->id;
                $users_id->dynamic_id = $dyn_id;

                $users_id->save();

            }

        }

    }

    public static function getCurrent( $real = false ){

        $session = Yii::$app->session;

        if( !$real && isset(Yii::$app->params["is_backend"]) && Yii::$app->params["is_backend"] && isset($session["admin_season"]) && $session["admin_season"] ) {

            if ($season = Seasons::find()->where("id=".$session["admin_season"])->one()) {

                return $season;

            } else {

                throw new Exception("Season not found.");

            }

        } else {

            if ($season = Seasons::find()->where("active=1")->one()) {

                return $season;

            } else {

                if ($season = Seasons::find()->orderBy("id desc")->limit(1)->one()) {

                    return $season;

                } else {

                    throw new Exception("Season not found.");

                }

            }

        }

    }

    public static function getPrevious(){

        if( $current_season = Seasons::getCurrent() ) {

            if ($season = Seasons::find()->where("id<".$current_season->id)->orderBy("id desc")->limit(1)->one()) {

                return $season;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }
}
