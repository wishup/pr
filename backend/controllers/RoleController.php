<?php

namespace backend\controllers;

use mdm\admin\controllers\RoleController as BaseRoleController;

class RoleController extends BaseRoleController
{

    public function beforeAction($action)
    {

        $this->enableCsrfValidation  = false;
        return parent::beforeAction($action);
    }

}
