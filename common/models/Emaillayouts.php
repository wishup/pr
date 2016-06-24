<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emaillayouts".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $path
 *
 * @property Emailtemplates[] $emailtemplates
 */
class Emaillayouts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emaillayouts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'path'], 'required'],
            [['name', 'slug'], 'string', 'max' => 50],
            [['path'], 'string', 'max' => 100]
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
            'slug' => 'Slug',
            'path' => 'Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailtemplates()
    {
        return $this->hasMany(Emailtemplates::className(), ['layout_id' => 'id']);
    }
}
