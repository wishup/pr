<?php
namespace common\components;

class Captcha extends \yii\captcha\CaptchaAction{

    public $minLength = 4;

    public $maxLength = 5;

    public $fontFile = '@frontend/web/fonts/AHGBold.ttf';

    public $foreColor = 0x777777;

    public $offset = 3;

}