<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "layouts_settings".
 *
 * @property integer $id
 * @property integer $layout_id
 * @property string $key
 * @property string $value
 *
 * @property Layouts $layout
 */
class LayoutsSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'layouts_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['layout_id', 'key', 'value'], 'required'],
            [['layout_id'], 'integer'],
            [['key', 'value'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'layout_id' => 'Layout ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayout()
    {
        return $this->hasOne(Layouts::className(), ['id' => 'layout_id']);
    }

    public static function isActive( $layout_id, $section ){

        if( $setting = LayoutsSettings::find()->where("layout_id=".$layout_id." AND `key`='section_".$section."_active'")->one() ){

            if( $setting->value ){
                return true;
            } else
                return false;

        } else
            return false;

    }

    public function setActive( $layout_id, $section, $active ){

        if( !$setting = LayoutsSettings::find()->where("layout_id=".$layout_id." AND `key`='section_".$section."_active'")->one() )
            $setting = new LayoutsSettings();

        $setting->layout_id = $layout_id;
        $setting->key = 'section_'.$section.'_active';
        $setting->value = $active;

        $setting->save(false);

    }
}
