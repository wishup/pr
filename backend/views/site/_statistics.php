<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="portlet-title">
    <div class="caption">
        <span class="caption-subject bold font-red-flamingo uppercase"> Statistics </span>
        <span class="caption-helper"></span>
    </div>
    <div class="form-group clearfix">
        <?php

        echo Html::dropDownList('staistics_type', $statistic_type, array('y' => 'This Year', 'm' => 'This month', 'w' => 'This week', 'd' => 'Today'), [
            'onchange' => '
    $.get( "' . Url::toRoute('/site/statistics') . '", { type: $(this).val() } )
    .done(function( data ) {
            $( "#statistics-data").html( data );
            }
            );
            ',
            'class' => 'form-control pull-right', 'style' => 'width:30%'])
        ?>
    </div>
</div>
<div class="portlet-body">
    <div class="statistic-block">
        <p class="statistic-row">
            <span
                class="statistic-name">Hosts :</span> <?php echo $statistics['number_of_hosts'] . ' of ' . $statistics['total_number_of_hosts']; ?>
        </p>

        <p class="statistic-row">
            <span
                class="statistic-name">Families :</span> <?php echo $statistics['number_of_families'] . ' of ' . $statistics['total_number_of_families']; ?>
        </p>



        <p class="statistic-row">
            <span
                class="statistic-name">Contestants :</span> <?php echo $statistics['number_of_contestants'] . ' of ' . $statistics['total_number_of_contestants']; ?>
        </p>

        <p class="statistic-sub-row">
            <span class="statistic-name">Beginner  :</span> <?php echo $statistics['number_of_beginner_contestants'] ?>
        </p>

        <p class="statistic-sub-row">
            <span class="statistic-name">Primary :</span> <?php echo $statistics['number_of_primary_contestants'] ?>
        </p>

        <p class="statistic-sub-row">
            <span class="statistic-name">Junior :</span> <?php echo $statistics['number_of_junior_contestants'] ?>
        </p>

        <p class="statistic-sub-row">
            <span class="statistic-name">Senior :</span> <?php echo $statistics['number_of_senior_contestants'] ?>
        </p>
    </div>


    <div class="statistic-block">
        <h4 class="font-red-flamingo">Study Journals</h4>

        <p class="statistic-row">
            <span class="statistic-name">Beginner :</span> <?php echo $statistics['journals_beginner'] ?>
        </p>

        <p class="statistic-row">
            <span class="statistic-name">Primary :</span> <?php echo $statistics['journals_primary'] ?>
        </p>

        <p class="statistic-row">
            <span class="statistic-name">Junior :</span> <?php echo $statistics['journals_junior'] ?>
        </p>

        <p class="statistic-row">
            <span class="statistic-name">Senior :</span> <?php echo $statistics['journals_senior'] ?>
        </p>
    </div>

    <div class="statistic-block">
        <h4 class="font-red-flamingo">Donations</h4>

        <p class="statistic-row">
            <span class="statistic-name">Donations :</span> $<?php echo $statistics['donations'] * 25 ?>
        </p>
    </div>

    <div class="statistic-block">
        <h4 class="font-red-flamingo">Additional Statistics</h4>

        <p class="statistic-row">
            <span
                class="statistic-name">Family under host :</span> <?php echo $statistics['number_of_families_under_host'] . ' of ' . $statistics['total_number_of_families']; ?>
        </p>

        <p class="statistic-row">
            <span
                class="statistic-name">Family not under host :</span> <?php echo $statistics['number_of_families_not_under_host'] . ' of ' . $statistics['total_number_of_families']; ?>
        </p>

        <p class="statistic-row">
            <span
                class="statistic-name">Contestants under host :</span> <?php echo $statistics['number_of_contestants_under_host'] . ' of ' . $statistics['total_number_of_contestants']; ?>
        </p>

        <p class="statistic-row">
            <span
                class="statistic-name">Contestants not under host :</span> <?php echo $statistics['number_of_contestants_not_under_host'] . ' of ' . $statistics['total_number_of_contestants']; ?>
        </p>
    </div>
</div>