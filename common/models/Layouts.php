<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\WidgetsInLayouts;

/**
 * This is the model class for table "layouts".
 *
 * @property integer $id
 * @property string $title
 *
 * @property LayoutsSettings[] $layoutsSettings
 * @property LayoutsWidgets[] $layoutsWidgets
 */
class Layouts extends \yii\db\ActiveRecord
{
    public $oldParent = 0;
    public $newParent = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'layouts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title'], 'required'],
            [[ 'url'], 'unique'],
            ['url', 'required', 'when' => function($model) {

                if( $model->url == '' ) {

                    if ($lay = Layouts::find()->where("id!=" . (int)$model->id . " AND url=''")->one()) {
                        return true;
                    } else {
                        return false;
                    }

                } else {
                    return true;
                }
            }],
            [['url', 'title'], 'string', 'max' => 300],
            [['layout_file'], 'string', 'max' => 50],
            [['parent_id', 'homepage'], 'integer']
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
            'url' => 'Url',
            'parent_id' => 'Base layout',
            'homepage' => 'Homepage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayoutsSettings()
    {
        return $this->hasMany(LayoutsSettings::className(), ['layout_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayoutsWidgets()
    {
        return $this->hasMany(LayoutsWidgets::className(), ['layout_id' => 'id']);
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }

    public function getName( $withHtml = true ){

        $name = $this->title.' ';
        if( $withHtml ) $name .= '<small>';
        $name .= $this->url == '' ? '[root]' : '['.$this->url.']';
        if( $withHtml ) $name .= '</small>';

        if( $this->homepage == 1 ){

            if( $withHtml ) $name .= '<small><b>';
            $name .= ' [Homepage]';
            if( $withHtml ) $name .= '</b></small>';

        }

        return $name;

    }

    public static function getPositions(){

        return [
            "top" => "Top",
            "left" => "Left",
            "center" => "Center",
            "right" => "Right",
            "bottom" => "Bottom",
        ];

    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            $this->url = trim( $this->url, '/');

            if( $this->homepage == 1 ){

                $othermodels = Layouts::find()->all();

                foreach( $othermodels as $omodel ){

                    $omodel->homepage = 0;

                    $omodel->save( false );

                }

            }

            if( $this->isNewRecord ){

                if( $this->attributes["parent_id"]!=0 ){

                    $this->oldParent = 0;
                    $this->newParent = $this->attributes["parent_id"];

                }

            } else {

                if (($this->oldAttributes["parent_id"] != $this->attributes["parent_id"])) {

                    $this->oldParent = $this->oldAttributes["parent_id"];
                    $this->newParent = $this->attributes["parent_id"];

                }

            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        if( $this->oldParent != $this->newParent ){

            $this->changedParent($this->oldParent, $this->newParent);

            $this->oldParent = $this->newParent;

        }

    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {

            $this->unchildLayout();

            return true;
        } else {
            return false;
        }
    }

    public function changedParent( $from_parent_id, $to_parent_id ){

        if( $from_parent_id != 0 ) $this->deleteParentWidgets();

        if( $to_parent_id != 0 ) $this->addParentWidgets();

    }

    public function deleteParentWidgets(){

        WidgetsInLayouts::deleteAll("`layout_id`=".$this->id." AND `parent_id`!=0");

        if( $childLayouts = Layouts::find()->where("`parent_id`=".$this->id)->all() ){

            foreach( $childLayouts as $childLayout ){

                $childLayout->deleteParentWidgets();

            }

        }

        return true;

    }

    public function addParentWidgets(){

        if( $parentWidgets = WidgetsInLayouts::find()->where("`layout_id`=".$this->parent_id)->all() ){

            foreach( $parentWidgets as $parentWidget ){

                $clone = new WidgetsInLayouts;
                $clone->attributes = $parentWidget->attributes;
                $clone->layout_id = $this->id;
                $clone->parent_id = $this->parent_id;
                $clone->parent_widget_id = $parentWidget->id;
                $clone->save(false);

            }

        }

        if( $childLayouts = Layouts::find()->where("`parent_id`=".$this->id)->all() ){

            foreach( $childLayouts as $childLayout ){

                $childLayout->addParentWidgets();

            }

        }

        return true;

    }

    public function unchildLayout(){

        if( $childLayouts = Layouts::find()->where("`parent_id`=".$this->id)->all() ){

            foreach( $childLayouts as $childLayout ){

                $childLayout->parent_id = 0;
                $childLayout->save(false);

            }

        }

        return true;

    }

    public static function getLayoutFiles(){

        $files = [];

        $files[''] = '';

        if ($handle = opendir( Yii::getAlias('@theme').'/layouts/' )) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $filename = pathinfo($entry, PATHINFO_FILENAME);
                    $files[ $filename ] = ucfirst(str_replace("_"," ",$filename));
                }
            }
            closedir($handle);
        }

        return $files;

    }
}
