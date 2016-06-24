<?php
use yii\helpers\Html;
use yii\web\Session;

$this->params['breadcrumbs'][] = $this->title;

$session = new Session;
$session->open();
?>
<section>
<div class="container">
<?php
if($page->status == 'private' && (!isset($session['page_id']) || !in_array($page->id,$session['page_id']))){
    echo $this->render('../elements/passwordform');
}else { ?>
        <?php if( $page->header != '' ){ ?><h1><?= Html::encode($page->header) ?></h1><?php } ?>
        <p><?= \common\components\LiveEdit::field( $page->content, "\\common\\models\\Pages", $page->id, "content", "wysiwyg" ) ?></p>
<?php }?>
    </div>
</section>