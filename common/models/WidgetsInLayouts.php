<?php

namespace common\models;

use Yii;
use backend\models\Widgets;
use backend\models\WidgetsAreas;

/**
 * This is the model class for table "widgets_in_layouts".
 *
 * @property integer $id
 * @property integer $widget_id
 * @property integer $layout_id
 * @property string $params
 * @property integer $order
 *
 * @property Widgets $widget
 * @property Layouts $layout
 */
class WidgetsInLayouts extends \yii\db\ActiveRecord
{
    public $addinchildlayouts = false;
    public $editinchildlayouts = false;
    public $edited_layout = false;
    public $oldAttrs = array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widgets_in_layouts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['widget_id', 'layout_id'], 'required'],
            [['widget_id', 'layout_id', 'order', 'active', 'parent_id', 'parent_widget_id'], 'integer'],
            [['params', 'position', 'title', 'type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'widget_id' => 'Widget ID',
            'layout_id' => 'Layout ID',
            'params' => 'Params',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidget()
    {
        return $this->hasOne(Widgets::className(), ['id' => 'widget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetarea()
    {
        return $this->hasOne(WidgetsAreas::className(), ['id' => 'widget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayout()
    {
        return $this->hasOne(Layouts::className(), ['id' => 'layout_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here

            if( $this->isNewRecord ){

                $this->active = 1;

                $this->addinchildlayouts = true;

            } else {

                $this->editinchildlayouts = true;

                $this->oldAttrs = $this->oldAttributes;

            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        if( $this->addinchildlayouts ){

            $this->addInChildLayouts();

            $this->addinchildlayouts = false;

        }

        if( $this->editinchildlayouts ){

            $this->editInChildLayouts();
            if( $this->edited_layout ) $this->syncLayouts();

            $this->editinchildlayouts = false;
            $this->edited_layout = false;

        }

    }

    public function addInChildLayouts(){

        if( $childLayouts = Layouts::find()->where("`parent_id`=".$this->layout_id)->all() ){

            foreach( $childLayouts as $childLayout ){

                $clone = new WidgetsInLayouts;
                $clone->attributes = $this->attributes;
                $clone->layout_id = $childLayout->id;
                $clone->parent_id = $childLayout->parent_id;
                $clone->parent_widget_id = $this->id;
                $clone->save(false);

            }

        }

    }

    public function editInChildLayouts(){

        if( $childWidgets = WidgetsInLayouts::find()->where("`parent_widget_id`=".$this->id)->all() ){

            foreach( $childWidgets as $childWidget ){

                if( $this->oldAttrs["active"] == $childWidget->active ) $childWidget->active = $this->active;
                //if( $this->oldAttrs["position"] == $childWidget->position ) $childWidget->position = $this->position;
                if( $this->oldAttrs["order"] == $childWidget->order ) $childWidget->order = $this->order;

                $childWidget->save(false);

            }

        }

    }

    public function syncLayouts(){

        $main_parent_id = $this->getMainParentID();

        if( $childWidget = WidgetsInLayouts::find()->where("`id`=".$main_parent_id)->one() ){

            $childWidget->params = $this->params;
            $childWidget->title = $this->title;
            $childWidget->widget_id = $this->widget_id;

            $childWidget->save(false);

        }

        if( $childWidgets = WidgetsInLayouts::find()->where("`parent_widget_id`=".$main_parent_id)->all() ){

            foreach( $childWidgets as $childWidget ){

                $childWidget->params = $this->params;
                $childWidget->title = $this->title;
                $childWidget->widget_id = $this->widget_id;

                $childWidget->save(false);

            }

        }

    }

    public function getMainParentID(){

        $parent_widget_id = $this->parent_widget_id;
        $id = $this->id;

        while( $parent_widget_id != 0 ){

            $model = WidgetsInLayouts::find()->where("`id`=".$parent_widget_id)->one();

            $parent_widget_id = $model->parent_widget_id;
            $id = $model->id;

        }

        return $id;

    }

    public function afterDelete()
    {
        parent::afterDelete();

        $this->deleteChilds();

     }

    public function deleteChilds(){

        if( $childWidgets = WidgetsInLayouts::find()->where("`parent_widget_id`=".$this->id)->all() ){

            foreach( $childWidgets as $childWidget ){

                $childWidget->delete();

            }

        }

    }
}
