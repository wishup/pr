<?php

namespace common\components;

use common\models\WidgetsInLayouts;
use frontend\models\WidgetsInAreas;
use frontend\models\Widgets;
use frontend\models\WidgetsAreas;

class Widgetareas{

    public function showArea( $widget_id ){

        if( $widgetmodel = WidgetsInLayouts::find()->where("id=".$widget_id)->one() ){

            $area_id = $widgetmodel->widget_id;

        } else
            return false;

        if( is_int($area_id) ) {

            $area = WidgetsAreas::find()->where("id=".$area_id)->one();

            $widgetsareas = WidgetsInAreas::find()->where("area_id=" . $area_id)->orderBy("order")->all();

        } else {

            $area = WidgetsAreas::find()->where("slug='".$area_id."'")->one();

            $widgetsareas = $area ? WidgetsInAreas::find()->where("area_id=" . $area->id)->orderBy("order")->all() : false;

        }

        if( $widgetsareas ) {

            $html = '<div class="widget_area_container widget_area_container_'.$area->slug.'">';

            foreach ($widgetsareas as $widgetarea) {

                $widget = Widgets::find()->where("id=" . $widgetarea->widget_id)->one();

                $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

                $params = unserialize($widgetarea->params);

                $widgetObj = new $widgetClass();

                $html .= '<div class="widget_container widget_container_'.$widget->slug.' widget_container_'.$widgetarea->id.'">';
                $html .= $widgetObj->render($params);
                $html .= '</div>';

            }

            $html .= '</div>';

            return $html;

        } else
            return false;

    }

    public function showLayoutWidget( $widget_id ){

        if( $widgetmodel = WidgetsInLayouts::find()->where("id=".$widget_id)->one() ){

            $widget = Widgets::find()->where("id=" . $widgetmodel->widget_id)->one();

            $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

            $params = unserialize($widgetmodel->params);

            $widgetObj = new $widgetClass();

            $params["widget_id"] = $widget_id;

            $html = '<div class="widget_container widget_container_'.$widget->slug.' widget_container_'.$widgetmodel->id.'">';
            $html .= $widgetObj->render($params);
            $html .= '</div>';

            return $html;

        } else
            return false;

    }

    public static function showWidget( $id, $params = [] ){

        if( $widget = Widgets::find()->where( is_int($id) ? "id=".$id : "slug='".$id."'" )->one() ) {

            $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

            $widgetObj = new $widgetClass();

            $params["id"] = $id;

            $html = '<div class="widget_container widget_container_' . $widget->slug . '">';
            $html .= $widgetObj->render($params);
            $html .= '</div>';

            return $html;

        } else
            return false;

    }

    public function showSectionWidget( $id ){

        if( $model = WidgetsInLayouts::find()->where("id=".$id)->one() ){

            if( $model->type == 'widget' ){

                return self::showLayoutWidget( $id );

            } else {

                return self::showArea( $id );

            }

        } else
            return false;

    }

}