<?php
namespace backend\components;

class PageSize extends \nterms\pagesize\PageSize{

    public $label = 'Per page';

    public $sizes = [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200, -1 => 'All'];

    public $template = '{list}';

}