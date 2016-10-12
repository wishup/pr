<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_comments".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $comment
 * @property string $answer
 * @property string $name
 * @property string $email
 * @property integer $status
 * @property string $date
 */
class PostComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment'], 'required'],
            [['post_id', 'status'], 'integer'],
            [['comment', 'answer'], 'string'],
            [['date'], 'safe'],
            [['name', 'email'], 'string', 'max' => 300],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'comment' => 'Comment',
            'answer' => 'Answer',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
