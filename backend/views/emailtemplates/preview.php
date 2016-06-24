<?php

use common\components\Email;

echo Email::render($id,['username'=>'John', 'surname'=> 'Smith']);