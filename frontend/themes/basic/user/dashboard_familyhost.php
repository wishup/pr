<section class="main gen-box container-lg">
    <div class="account-primary">
<?= $this->render("//elements/dashboard_head", [
    "infomodel" => $infomodel,
    "hostmodel" => $hostmodel,
    "usermodel" => $usermodel,
    "bgcheckmodel" => $bgcheckmodel,
    "family" => $family
]) ?>
<?= \common\components\Widgetareas::showWidget(5, ['type' => 'hosts_map', 'design' => 'dashboard', 'join_enable' => ($hostmodel->isNewRecord ? true : false), 'show_google_plus_button' => true]); ?>
        </div>
    </section>