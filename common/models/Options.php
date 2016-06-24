<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $key
 * @property string $value
 */
class Options extends \yii\db\ActiveRecord
{

    const INCOMPLETE_USER_REMINDER = 'incomplete_user_reminder';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'model_id'], 'required'],
            [['model_id'], 'integer'],
            [['value'], 'safe'],
            [['date'], 'safe'],
            [['model'], 'string', 'max' => 150],
            [['key'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'model_id' => 'Model ID',
            'key' => 'Key',
            'value' => 'Value',
            'date' => 'Date',
        ];
    }

    public static function setOption( $model, $model_id, $key, $value ){

        if( !$optmodel = Options::find()->where("model='".$model."' and model_id=".$model_id." and `key`='".$key."'")->one() )
            $optmodel = new Options();

        $optmodel->model = $model;
        $optmodel->model_id = $model_id;
        $optmodel->key = $key;
        $optmodel->value = $value;
        $optmodel->date = date("Y-m-d H:i:s");

        $optmodel->save();

    }

    public static function getOption( $model, $model_id, $key ){

        if( $optmodel = Options::find()->where("model='".$model."' and model_id=".$model_id." and `key`='".$key."'")->one() ){

            return $optmodel->value;

        } else {

            return false;

        }

    }
}
