<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "recent_urls".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $url
 */
class RecentUrls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recent_urls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'url'], 'required'],
            [['user_id'], 'integer'],
            [['title', 'url'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'url' => 'Url',
        ];
    }
}
