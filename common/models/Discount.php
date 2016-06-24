<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $discount_type
 * @property double $amount
 * @property integer $limit
 * @property integer $usage
 * @property integer $per_type
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code', 'amount', 'discount_type', 'per_type', 'limit'], 'required'],
            ['code', 'unique'],
            [['amount'], 'number'],
            [['limit', 'usage', 'per_type'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['code', 'discount_type'], 'string', 'max' => 20],
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
            'code' => 'Code',
            'discount_type' => 'Discount Type',
            'amount' => 'Amount',
            'limit' => 'Limit',
            'usage' => 'Usage',
            'per_type' => 'Per Type',
        ];
    }
}
