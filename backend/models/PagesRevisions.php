<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "pages_revisions".
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $user_id
 * @property string $content
 * @property string $date
 *
 * @property Pages $page
 * @property User $user
 */
class PagesRevisions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages_revisions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'user_id', 'content', 'date'], 'required'],
            [['page_id', 'user_id'], 'integer'],
            [['content','action'], 'string'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
