<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "live_edit_texts".
 *
 * @property integer $id
 * @property string $key
 * @property string $content
 */
class LiveEditTexts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'live_edit_texts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['key'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'content' => 'Content',
        ];
    }
}
