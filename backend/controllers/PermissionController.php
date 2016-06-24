<?php

namespace backend\controllers;

use mdm\admin\controllers\PermissionController as BasePermissionController;

class PermissionController extends BasePermissionController
{

    public function beforeAction($action)
    {

        $this->enableCsrfValidation  = false;
        return parent::beforeAction($action);
    }

}
