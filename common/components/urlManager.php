<?php

namespace common\components;

use yii\web\UrlManager as BaseUrlManager;
use yii\base\Object;
use common\models\SeoSettings;

class UrlManager extends BaseUrlManager
{

    public function createUrl($params)
    {

        $url = parent::createUrl($params);

        $parts = parse_url($url);

        $url = $parts['path'];
        $query = @$parts['query'];

        if ($seo = SeoSettings::find()->where("default_url='" . trim($url, '/') . "'")->one()) {
            $url = '/' . $seo->rewrite_url;
        }

        return ($query) ? $url . '?' . $query : $url;
    }
}