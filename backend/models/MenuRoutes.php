<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_routes".
 *
 * @property integer $id
 * @property string $title
 * @property string $model
 * @property string $field
 * @property string $url_template
 */
class MenuRoutes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_routes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'model', 'field', 'url_template'], 'required'],
            [['title', 'model', 'field'], 'string', 'max' => 100],
            [['url_template'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'model' => 'Model',
            'field' => 'Field',
            'url_template' => 'Url Template',
        ];
    }
}
