<?php

namespace backend\controllers;

use mdm\admin\controllers\AssignmentController as BaseAssignmentController;

class AssignmentController extends BaseAssignmentController
{

    public function beforeAction($action)
    {

        $this->enableCsrfValidation  = false;
        return parent::beforeAction($action);
    }

}
