<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "emailtemplates_revisions".
 *
 * @property integer $id
 * @property integer $emailtemplate_id
 * @property integer $user_id
 * @property string $content
 * @property string $plaintext
 * @property string $date
 * @property string $action
 *
 * @property Emailtemplates $emailtemplate
 */
class EmailtemplatesRevisions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emailtemplates_revisions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emailtemplate_id', 'user_id', 'date'], 'required'],
            [['emailtemplate_id', 'user_id'], 'integer'],
            [['content', 'plaintext'], 'string'],
            [['date'], 'safe'],
            [['action'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emailtemplate_id' => 'Emailtemplate ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'plaintext' => 'Plaintext',
            'date' => 'Date',
            'action' => 'Action',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailtemplate()
    {
        return $this->hasOne(Emailtemplates::className(), ['id' => 'emailtemplate_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
