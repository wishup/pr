<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resources".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $age_group
 * @property integer $version
 * @property string $overlay_text
 * @property string $thumbnail
 * @property string $file
 */
class Resources extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resources';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'version'], 'integer'],
            [['category_id'], 'checkForDuplicate'],
            [['age_group'], 'string', 'max' => 50],
            [['button_type'], 'string', 'max' => 30],
            [['url'], 'string', 'max' => 200],
            [[ 'thumbnail'], 'file', 'extensions' => 'png, jpg, gif, jpeg', 'maxSize' => 1024 * 1024 * 2],
            [[ 'file'], 'file'],
            [['overlay_text'], 'string', 'max' => 300],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResourcesCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function checkForDuplicate($attribute, $params)
    {

        $where = $this->isNewRecord ? '' : " AND `id`!=".$this->id;
        $age_group_where = $this->age_group == '' ? " or age_group!='' " : '';
        $version_where = $this->version == '' ? " or version IS NOT NULL " : '';

        if( $hasmodel = Resources::find()->where("
                `category_id`=".$this->category_id." AND
                (age_group IS NULL or age_group='' or age_group='".$this->age_group."' ".$age_group_where.") AND
                (version IS NULL or version='' or version='".$this->version."' ".$version_where.")
                ".$where
        )->one() ){

            $this->addError($attribute, Yii::t('app', 'Resource for this category, age group, version combination already exist.'));

        }


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'age_group' => 'Age Group',
            'version' => 'Version',
            'overlay_text' => 'Overlay Text',
            'thumbnail' => 'Thumbnail',
            'file' => 'File',
            'button_type' => 'Type',
            'url' => 'Link',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(ResourcesCategories::className(), ['id' => 'category_id']);
    }

    public function uploadThumb()
    {

        if ($this->validate()) {

            if( !file_exists(\Yii::getAlias('@frontend').'/web/upload/resources/') ) mkdir( \Yii::getAlias('@frontend').'/web/upload/resources/', 0777, true );

            $this->thumbnail->saveAs(\Yii::getAlias('@frontend').'/web/upload/resources/' . $this->thumbnail->baseName . '.' . $this->thumbnail->extension);
            return true;
        } else {
            return false;
        }
    }

    public function uploadFile()
    {

        if ($this->validate()) {

            if( !file_exists(\Yii::getAlias('@frontend').'/web/upload/resources/') ) mkdir( \Yii::getAlias('@frontend').'/web/upload/resources/', 0777, true );

            $this->file->saveAs(\Yii::getAlias('@frontend').'/web/upload/resources/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
