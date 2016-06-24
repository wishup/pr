<?php
    use yii\helpers\Html;
    use \common\components\LiveEdit;
?>
<!--ul class="quick-links hidden-small">
    <li>
        <a href="">
            <i class="icon-info"></i>
            <strong>Learn</strong>
            <span>More</span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="icon-flag"></i>
            <strong>Start</strong>
            <span>Now</span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="icon-help"></i>
            <strong>Ask</strong>
            <span>question</span>
        </a>
    </li>
</ul -->

<div style="padding: 50px 0;">


    <div class="primary-tabs faq-tab" id="myTabs">
        <!-- Nav tabs -->
        <ul class="tab-nav" role="tablist">
<!--            <li role="presentation">-->
<!--                <a href="#faq" aria-controls="faq" role="tab" data-toggle="tab">-->
<!--                    Frequently Asked Questions-->
<!--                </a>-->
<!--            </li>-->
            <li role="presentation">
                <a href="#glossary" aria-controls="glossary" role="tab" data-toggle="tab">
                    <?= LiveEdit::text(__FILE__, 'Glossary') ?>
                </a>
            </li>
<!--            <li role="presentation">-->
<!--                <a href="#importantDocument" aria-controls="importantDocument" role="tab" data-toggle="tab">-->
<!--                    Important Document-->
<!--                </a>-->
<!--            </li>-->
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-inst">
                <div class="tab-options clearfix">
                    <div class="checkbox" id="showAllAnswers">
                        <label>
                            <input type="checkbox">
                            <span></span>
                            <?= LiveEdit::text(__FILE__, 'Click Here to Show all Answers') ?>
                        </label>
                    </div>
                    <ul class="doc-controls">
                        <li><?= Html::a('', null, ['class' => 'icon-pdf', 'data' => [
                                'method' => 'post',
                                'params' => [
                                    'action' => 'download_pdf',
                                    'type' => 'download'
                                ]
                            ]]) ?></li>
                        <li><?= Html::a('', null, ['class' => 'icon-xls', 'data' => [
                                'method' => 'post',
                                'params' => [
                                    'action' => 'download_xls',
                                    'type' => 'download'
                                ]
                            ]]) ?></li>
                        <li><?= Html::a('', null, ['class' => 'icon-print']) ?></li>
                    </ul>
                </div>
                <!--<small class="update-info">Last updated 17/12/2015</small>-->
            </div>
            <div role="tabpanel" class="tab-pane" id="faq">
                <h2 class="print-title visible-print-block"><?= LiveEdit::text(__FILE__, 'Frequently Asked Questions') ?></h2>
                <?php if($faq):?>
                    <ul class="faq-list">
                        <?php $j=1; foreach($faq as $item): //var_dump($item->faq);

                            $faqs = $item->getFaqByStatus('published');

                            if( count($faqs) == 0 ) continue;
                            ?>
                            <li>
                                <h5 class="faq-header sep-border"><?php echo $item->name;?></h5>
                                <?php if($faqs):?>
                                    <ul class="letter-result">
                                        <?php $i = 1; foreach($faqs as $faq):?>
                                                <li>
                                                    <div class="collapse-toggle" data-toggle="collapse" data-target="#collapse_faq<?php echo $j.$i;?>" >
                                                        <div class="col-sm-7"><h5><?php echo $faq->question;?></h5></div>
                                                    </div>
                                                    <div class="collapse" id="collapse_faq<?php echo $j.$i;?>">
                                                        <div class="panel-body">
                                                            <?php echo $faq->answer;?>
                                                        </div>
                                                    </div>
                                                </li>
                                        <?php $i++; endforeach;?>
                                    </ul>
                                <?php endif;?>
                            </li>
                        <?php $j++; endforeach;?>
                    </ul>
                <?php endif;?>
            </div>
            <!--Glossary-->
            <?php if($glossary):?>
            <div role="tabpanel" class="tab-pane" id="glossary">
                <h2 class="print-title visible-print-block"><?= LiveEdit::text(__FILE__, 'Glossary') ?></h2>
                <ol class="alpha-paging">
                    <?php
                    foreach (range('A', 'Z') as $char) :
                        $i = 1;
                        $letter = '';
                        $letter_arr = array();
                        foreach($glossary as $item):
                            $first_letter = substr($item["word"], 0, 1);
                            if($first_letter !== $letter):
                                $letter_arr[] = $first_letter;
                                $letter = $first_letter;
                            endif;
                        endforeach;
                        if (!in_array($char, $letter_arr)) :
                            $alph_item = '<span>'. $char .'</span>';
                        else:
                            $alph_item = '<a href="#'.$char.'">'. $char .'</a>';
                        endif;
                    ?>
                        <li><?php echo $alph_item;?></li>
                    <?php endforeach;?>
                </ol>
                <section class="faq-cont">
                    <header class="faq-header sep-border clearfix">
                        <div class="col-xs-11 col-xs-offset-1 no-gutter">
                            <div class="col-sm-7"><?= LiveEdit::text(__FILE__, 'Word or Terms') ?></div>
                            <div class="col-sm-5"><?= LiveEdit::text(__FILE__, 'Acronym or Aka') ?></div>
                        </div>
                    </header>
                    <ul class="faq-list">
                        <?php
                        $i = 1;
                        $letter = "";
                        foreach($glossary as $item):
                            $first_letter = substr($item["word"], 0, 1);
                            if($first_letter !== $letter):
                                $letter = $first_letter;

                        if( $i!=1 ) echo '</ul></li>';
                        ?>
                        <li id="<?php echo $first_letter;?>" >
                            <h3 class="letter col-xs-1"><?php echo $first_letter;?></h3>
                            <ul class="letter-result col-xs-11">
                        <?php endif;?>
                                <li class="row">
                                    <div class="collapse-toggle" data-toggle="collapse" data-target="#collapse<?php echo $first_letter.$i;?>" >
                                        <div class="col-sm-7"><h5><?php echo $item["word"];?></h5></div>
                                        <?php if($item["acronim"]):?>
                                            <div class="col-sm-5"><?php echo $item["acronim"];?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="collapse" id="collapse<?php echo $first_letter.$i;?>">
                                        <div class="panel-body">
                                            <?php echo $item["description"];?>
                                        </div>
                                    </div>
                                </li>
                        <?php $i++; endforeach;?>
                    </ul>
                </section>

            </div>
            <?php endif;?>
            <div role="tabpanel" class="tab-pane" id="importantDocument">
                <h2 class="print-title visible-print-block"><?= LiveEdit::text(__FILE__, 'Documents') ?></h2>
            </div>
        </div>
    </div>
	
</div>	
