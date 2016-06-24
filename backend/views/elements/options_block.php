<?php
use yii\helpers\Html;

?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Options</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="blockui_sample_3_2_element">
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th>Value</th>
                </tr>
                <?php
                foreach( $options as $option ){
                    ?>
                    <tr>
                        <td><?= $option["key"] ?></td>
                        <td><?= $option["value"] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>