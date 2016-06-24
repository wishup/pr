<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hear_about".
 *
 * @property integer $id
 * @property string $answer
 */
class HearAbout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hear_about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer'], 'required'],
            [['answer'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Answer',
        ];
    }
}
