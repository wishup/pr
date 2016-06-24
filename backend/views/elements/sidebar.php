<?php
function is_seled( $items ){

    $seled = 0;

    foreach( $items as $item ){

        if( $_SERVER["REQUEST_URI"] == $item["url"] ){

            $seled = 1;
            break;

        }

        if( $seled == 0 && isset($item["items"]) && count($item["items"])>0 ){

            $seled = is_seled( $item["items"] );

        }

    }

    return $seled;

}

function renderSidebar( $items, $roles ){

    $html = '';

    foreach( $items as $item ){

        if( isset($item['roles']) ){

            $perm = 0;

            foreach( $roles as $role=>$roleobj ){
                if( in_array($role, $item['roles']) ){
                    $perm=1;
                    break;
                }
            }

        } else {
            $perm = 1;
        }

        if( $perm == 0 ) continue;

        if( isset($item["heading"]) ){

            $html .= '<li class="heading">
                            <h3 class="uppercase">'.$item["heading"].'</h3>
                        </li>';

        } else {

            if (isset($item["items"]) && count($item["items"]) > 0) {

                $seled = is_seled( $item["items"] );

                $html .= '<li class="nav-item '.($seled ? 'active open' : '').'">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-' . (isset($item["icon"]) ? $item["icon"] : 'settings') . '"></i>
                                <span class="title">' . $item["label"] . '</span>
                                <span class="arrow '.($seled ? 'open' : '').'"></span>
                                '.($seled ? '<span class="selected"></span>' : '').'
                            </a>
                            <ul class="sub-menu">';

                $html .= renderSidebar($item["items"], $roles);

                $html .= '</ul>
                        </li>';

            } else {

                $seled = $_SERVER["REQUEST_URI"] == $item["url"] ? 1 : 0;

                $html .= '<li class="nav-item '.($seled ? 'active' : '').'">
                                    <a href="' . $item["url"] . '" class="nav-link">
                                        '.(isset($item["icon"]) && $item["icon"]!='' ? '<i class="fa fa-' .$item["icon"] . '"></i>' : '').' <span class="title">' . $item["label"] . '</span>
                                        '.($seled ? '<span class="selected"></span>' : '').'
                                        </a>
                                </li>';

            }

        }

    }

    return $html;

}

?>
<ul class="page-sidebar-menu   " data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">

    <?php
    $items = [
        ["label"=>"Dashboard", "icon"=>"home", "url"=>"/backend/site/index"],

        ["heading"=>"Tools", "roles"=>["Superadmin", "Admin"]],

        ["label"=>"Communication center", "icon"=>"comment-o", "url"=>"/backend/mailing/index", "roles"=>["Superadmin", "Admin"], "items" =>[
            ["label"=>"Messages", "icon"=>"comment-o", "url"=>"/backend/messaging/index", "roles"=>["Superadmin", "Admin"]],
            ["label"=>"Emails", "icon"=>"envelope-o", "url"=>"/backend/mailing/index", "roles"=>["Superadmin", "Admin"]],
        ]],
        ["label"=>"Resources", "icon"=>"file-zip-o", "url"=>"#", "roles"=>["Superadmin", "Admin"], "items" => [
            ["label"=>"Resources List", "icon"=>"file-pdf-o", "url"=>"/backend/resources/index", "roles"=>["Superadmin", "Admin"]],
            ["label"=>"Resources Categories", "icon"=>"folder-open-o", "url"=>"/backend/resources-categories/index", "roles"=>["Superadmin", "Admin"]],
        ]],
        ["label"=>"Contact Requests", "icon"=>"book", "url"=>"/backend/contact-form/index", "roles"=>["Superadmin", "Admin"]],

        ["heading"=>"Payment", "roles"=>["Superadmin", "Admin"]],

        ["label"=>"Discounts", "icon"=>"ticket", "url"=>"/backend/discount", "roles"=>["Superadmin", "Admin"]],

        ["heading"=>"CMS", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Users", "icon"=>"user", "url"=>"/backend/users/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Email Templates", "icon"=>"envelope-o", "url"=>"#", "roles"=>["Superadmin", "Admin"], "items" => [
            ["label"=>"Email templates", "icon"=>"envelope-o", "url"=>"/backend/emailtemplates/index", "roles"=>["Superadmin", "Admin"]],
            ["label"=>"Email Groups", "icon"=>"envelope", "url"=>"/backend/email-groups/index", "roles"=>["Superadmin", "Admin"]],
            ["label"=>"Unsubscribe List", "icon"=>"minus-circle", "url"=>"/backend/unsubscribe/index", "roles"=>["Superadmin", "Admin"]],
            ["label"=>"Unsubscribe Reasons", "icon"=>"minus-circle", "url"=>"/backend/unsubscribe-reasons/index", "roles"=>["Superadmin", "Admin"]],
        ]],

        ["label"=>"Media", "icon"=>"folder-open-o", "url"=>"/backend/media/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Sliders", "icon"=>"file-image-o", "url"=>"/backend/sliders/index", "roles"=>["Superadmin", "Content manager", "Admin"]],
        ["label"=>"Pages", "icon"=>"file-o", "url"=>"/backend/pages/index", "roles"=>["Superadmin", "Content manager", "Admin"]],
        ["label"=>"FAQ", "icon"=>"question", "url"=>"#", "roles"=>["Superadmin", "Admin"], "items" => [
            ["label"=>"FAQ List", "icon"=>"question", "url"=>"/backend/faq/index", "roles"=>["Superadmin", "Admin"]],
            ["label"=>"FAQ Categories", "icon"=>"question", "url"=>"/backend/faq-categories/index", "roles"=>["Superadmin", "Admin"]],
        ]],
        ["label"=>"Glossary", "icon"=>"book", "url"=>"/backend/glossary/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Menu", "icon"=>"sitemap", "url"=>"/backend/menu/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Live Edit", "icon"=>"pencil", "url"=>"/backend/live-edit-texts/", "roles"=>["Superadmin", "Admin"]],

        ["label"=>"SEO", "icon"=>"map-signs", "url"=>"/backend/seo-parameters/index", "roles"=>["Superadmin", "Admin"]],


        ["heading"=>"System", "roles"=>["Superadmin", "Admin"]],

        ["label"=>"Rewrite Rules", "icon"=>"paper-plane", "url"=>"/backend/seo-settings/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Layouts", "icon"=>"database", "url"=>"/backend/layouts/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Settings", "icon"=>"gears", "url"=>"/backend/settings/update/1", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Subscribers", "icon"=>"puzzle-piece", "url"=>"/backend/subscribers/index", "roles"=>["Superadmin", "Admin"]],
        ["label"=>"Administrators", "icon"=>"trophy", "url"=>"/backend/user/index", "roles"=>["Superadmin"]],
        ["label"=>"Help", "icon"=>"book", "url"=>"/backend/help/index", "roles"=>["Superadmin"]],

    ];

    $authManager = new yii\rbac\DbManager();
    $roles = $authManager->getAssignments( \Yii::$app->user->identity->id );

    echo renderSidebar( $items , $roles );

    ?>

</ul>