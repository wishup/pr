<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>F.A.Q</title>
        <link href="<?php echo $siteUrl; ?>/css/pdf.css" rel="stylesheet" />
    </head>
    <body>
        <h1 style="text-align:center;">F.A.Q</h1>
        <!-- main-->
        <ul class="faq-list">
            <?php if($faq):?>
                <ul class="faq-list">
                    <?php $j=1; foreach($faq as $item):?>
                        <li>
                            <h2 class="letter"><?php echo $item->name;?></h2>
                            <?php if($item->faq):?>
                                <ul class="letter-result">
                                    <?php $i = 1; foreach($item->faq as $faq):?>
                                        <li>
                                            <div class="letter-result"><strong><?php echo $faq->question;?></strong></div>
                                            <div><?php echo $faq->answer;?></div>
                                        </li>
                                        <?php $i++; endforeach;?>
                                </ul>
                            <?php endif;?>
                        </li>
                        <?php $j++; endforeach;?>
                </ul>
            <?php endif;?>
        </ul>
        <!--main end-->


        <htmlpagefooter name="standartFooter">
            <div style="text-align:right;"><i>{PAGENO}</i></div>
        </htmlpagefooter>
        <sethtmlpagefooter name="standartFooter"  value="on" />

       <!-- footer -->
        <htmlpagefooter name="standart-footer">
            <hr>
            <div style="text-align:right;">{PAGENO}</div>
        </htmlpagefooter>



        <!-- footer end -->
    </body>
</html>