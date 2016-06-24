<?php

namespace common\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;
use common\models\SeoSettings;

class rewriterules extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {

        return false;
    }

    public function parseRequest($manager, $request)
    {

        $pathInfo = $request->getPathInfo();


        if( $seo = SeoSettings::find()->where("rewrite_url=:pathInfo", array(':pathInfo' =>$pathInfo))->one() ) {

            $path = $seo->default_url;

            foreach( $manager->rules as $rule ){

                if( !isset($rule->pattern) ) continue;

                if (preg_match($rule->pattern, $path, $matches)) {
                    $request->setPathInfo($path);
                    return $rule->parseRequest($manager, $request);

                }

            }

        }

        return false;
    }
}