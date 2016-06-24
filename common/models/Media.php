<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property integer $id
 * @property string $attachment
 * @property string $size
 * @property string $type
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attachment'], 'required'],
            [['attachment'], 'file'],
            [['size', 'type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attachment' => 'Attachment',
            'size' => 'Size',
            'type' => 'Type',
        ];
    }

    public function upload(){

        if ($this->validate()) {

            $filename = str_replace(" ","_",$this->attachment->baseName) . '.' . $this->attachment->extension;

            $i=0;

            while( file_exists(\Yii::getAlias("@frontend").'/web/upload/media/' . $filename) ){

                $i++;

                $filename = str_replace(" ","_",$this->attachment->baseName) . '_'.$i.'.' . $this->attachment->extension;

            }

            $this->attachment->saveAs(\Yii::getAlias("@frontend").'/web/upload/media/' . $filename);

            $this->attachment->name = $filename;
            
            return true;
        } else {
            return false;
        }

    }

    public function fileType(){

        $types = [
            "image/jpeg" => "image",
            "image/png" => "image",
            "image/gif" => "image",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "excel",
            "application/vnd.ms-excel" => "excel",
        ];

        return isset( $types[ $this->type ] ) ? $types[ $this->type ] : 'other';

    }

    public static function fileTypes(){

        return ["image", "excel", "other"];

    }

    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
         $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
