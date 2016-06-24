<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "emailtemplates".
 *
 * @property integer $id
 * @property string $title
 * @property string $subject
 * @property string $from_name
 * @property string $from_email
 * @property string $content
 * @property string $shortcodes
 * @property integer $status
 * @property string $slug
 */
class Emailtemplates extends \yii\db\ActiveRecord
{
    public $is_used;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emailtemplates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'subject', 'from_name', 'from_email', 'content'], 'required'],
            [['content', 'slug', 'plaintext', 'shortcodes', 'description'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['subject'], 'string', 'max' => 300],
            [['from_name', 'from_email'], 'string', 'max' => 100],
            [['layout_id', 'status', 'group_id'], 'integer'],
            [['slug'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subject' => 'Subject',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'content' => 'Content',
            'shortcodes' => 'Shortcodes',
            'plaintext' => 'Plain text',
            'layout_id' => 'Layout Style',
            'status' => 'Status',
            'slug' => 'Slug',
            'description' => 'Admin notes',
        ];
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
        $query->andFilterWhere(['like', 'subject', $this->subject]);
        $query->andFilterWhere(['like', 'from_name', $this->from_name]);
        $query->andFilterWhere(['like', 'from_email', $this->from_email]);
        $query->andFilterWhere(['status' => $this->status]);


        if($this->slug != '' and $this->slug == 1){
            $query->andWhere("slug != ''");
        } else if($this->slug != '' and $this->slug == 0){
            $query->andWhere("slug = '' ");
        }


        return $dataProvider;
    }

    public static function findBySlug($slug)
    {
        return self::find()->where("slug='".$slug."'")->one();
    }
}
