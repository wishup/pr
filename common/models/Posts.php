<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_content
 * @property string $content
 * @property string $date
 * @property string $image
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['short_content', 'content'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 300],
            ['image', 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short_content' => 'Short Content',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
        ];
    }

    public function getCommentscount(){

        return PostComments::find()->where("post_id=".$this->id." and status=1")->count();

    }

    public function getComments(){

        return PostComments::find()->where("post_id=".$this->id." and status=1")->orderBy("date desc")->all();

    }
}
