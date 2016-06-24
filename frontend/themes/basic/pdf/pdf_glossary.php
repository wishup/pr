<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Glossary</title>
        <link href="<?php echo $siteUrl; ?>/css/pdf.css" rel="stylesheet" />
    </head>
    <body>
        <h1 style="text-align:center;">Glossary</h1>
        <!-- main-->
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
            <li>
                <h2 class="letter"><?php echo $first_letter;?></h2>
                <ul>
                    <?php endif;?>
                    <li>
                        <div class="letter-result"><strong><?php echo $item["word"];?></strong>
                            <?php if($item["acronim"]):?>
                                <small><?php echo $item["acronim"];?></small>
                            <?php endif;?>
                        </div>
                        <div>
                            <?php echo $item["description"];?>
                        </div>
                    </li>
            <?php $i++; endforeach;?>
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