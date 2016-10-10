<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_item".
 *
 * @property integer $id
 * @property integer $gallery_id
 * @property string $name
 * @property string $description
 * @property string $image
 *
 * @property Gallery $gallery
 */
class GalleryItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['gallery_id'], 'integer'],
            [['description'], 'string'],
            [['image'], 'file'],
            [['name'], 'string', 'max' => 300],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Gallery ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }
}
