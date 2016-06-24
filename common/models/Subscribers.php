<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribers".
 *
 * @property integer $id
 * @property string $email
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'unique'],
            [['date', 'info'], 'safe'],
            [['email'], 'string', 'max' => 150],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $info = $this->info!='' ? unserialize($this->info) : [];

            if( isset($info["first_name"]) ){
                $this->first_name = $info["first_name"];
            }
            if( isset($info["last_name"]) ){
                $this->last_name = $info["last_name"];
            }

            return true;
        }
        return false;
    }
}
