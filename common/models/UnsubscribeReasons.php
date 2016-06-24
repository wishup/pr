<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unsubscribe_reasons".
 *
 * @property integer $id
 * @property string $reason
 */
class UnsubscribeReasons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unsubscribe_reasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reason'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reason' => 'Reason',
        ];
    }
}
