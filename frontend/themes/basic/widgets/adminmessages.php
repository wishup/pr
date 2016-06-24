<?php
use common\models\Messaging;
use common\models\Users;

if( $user_id = Users::user_id() ){

    $messages = Messaging::getMessages( $user_id );

    foreach( $messages as $message ){

        ?>
        <div class="notice-box notice-success">
            <?php if( $message->can_close ){ ?><a href="#" class="icon-close close_admin_message" data-msg-id="<?= $message->id ?>"></a><?php } ?>
            <?= $message->message ?>
        </div>
        <?php

    }

}
