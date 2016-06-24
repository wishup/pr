<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_items".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $name
 * @property string $url
 * @property integer $order
 *
 * @property Menu $menu
 * @property MenuItems $parent
 * @property MenuItems[] $menuItems
 */
class MenuItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['parent_id', 'menu_id', 'order'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['url', 'other_url'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent item',
            'menu_id' => 'Menu',
            'name' => 'Name',
            'url' => 'Url',
            'order' => 'Order',
            'other_url' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(MenuItems::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::className(), ['parent_id' => 'id']);
    }

    public static function getHierarchy( $menu_id, $parent_id = 0 ){

        $menu_items = array();

        $items_models = self::find()->where("menu_id=".$menu_id." AND parent_id=".$parent_id)->orderBy("order")->all();

        foreach( $items_models as $im ){

            $menu_items[] = [
                "model" => $im,
                "childs" => self::getHierarchy( $menu_id, $im->id ),
            ];

        }

        return $menu_items;

    }

    public static function getNavHierarchy( $menu_id, $parent_id = 0 ){

        $menu_items = array();

        $items_models = self::find()->where("menu_id=".$menu_id." AND parent_id=".$parent_id)->orderBy("order")->all();

        foreach( $items_models as $im ){

            $subitems = self::getNavHierarchy( $menu_id, $im->id );

            $sub_selected = 0;

            foreach( $subitems as $si )
                if( $si["selected"] == 1 ) $sub_selected = 1;

            $item_url = $im->url=='other' ? $im->other_url : $im->url;

            $class = '';
            $selected = 0;

            if( in_array( $item_url, \Yii::$app->params['active_urls'] ) || $sub_selected == 1 ){
                $class .= 'active';
                $selected = 1;
            }

            $item_arr = ['label' => $im->name, 'options'=>['class'=>( count($subitems) > 0 ? 'hassubnav' : '' ).$class], 'selected'=>$selected];

            if( $item_url != '' ) $item_arr["url"] = $item_url;


            if( count($subitems) > 0 ){
                $item_arr['items'] = $subitems;
            }



            $menu_items[] = $item_arr;

        }

        return $menu_items;

    }

    public static function reorder( $parent_id ){

        $items = MenuItems::find()->where("parent_id=".$parent_id)->orderBy("order")->all();

        $pos = 0;

        foreach($items as $it){

            $it->order = $pos;

            $it->save(false);

            $pos++;

        }

    }

    public static function deleteChilds( $parent_id ){

        if( $childs = MenuItems::find()->where("parent_id=".$parent_id)->all() ){

            foreach( $childs as $child ){

                self::deleteChilds( $child->id );

            }

        }

        $model = MenuItems::find()->where("id=".$parent_id)->one();

        $model->delete();

    }
}
