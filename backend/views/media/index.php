<?php
use dosamigos\fileupload\FileUploadUI;
use common\components\attachments;
use common\models\Media;

$this->title = 'Media';
$this->params['breadcrumbs'][] = 'Media';
?>

<div class="row margin-bottom30">
    <div class="col-sm-12">
        <a href="#uploadfiles" data-toggle="modal" class="btn btn-success">Upload files</a>
    </div>
</div>

<div class="modal fade basic-modal" id="uploadfiles" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Upload files</h4>
            </div>
            <div class="modal-body">
                <?= FileUploadUI::widget([
                    'name' => "Media[attachment]",
                    'url' => ['media/uploadfile'],
                    'gallery' => true,
                    'clientOptions' => [
                        'maxFileSize' => 10000000
                    ],
                    // ...
                    'clientEvents' => [
                        'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
                        'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
                    ],
                ]);
                ?>
            </div>
            <div class="modal-footer">
                <a href="javascript:window.location.reload();" class="btn dark btn-outline">Close</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade basic-modal" id="replacefile" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Upload files</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="file_id" value="" id="replace_file_id">
                    <div class="row">
                        <div class="col-sm-9">
                            <input type="file" name="Media[attachment]" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" name="replacefile" value="Upload" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:window.location.reload();" class="btn dark btn-outline">Close</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="portfolio-content portfolio-1">
    <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> All
            <div class="cbp-filter-counter"></div>
        </div>
        <?php
        $filetypes = Media::fileTypes();

        foreach( $filetypes as $ft ){
            ?>
            <div data-filter=".<?= $ft ?>" class="cbp-filter-item btn dark btn-outline uppercase"> <?= ucfirst($ft) ?>
                <div class="cbp-filter-counter"></div>
            </div>
            <?php
        }
        ?>
    </div>
    <div id="js-grid-juicy-projects" class="cbp">
        <?php
        if( $models ){

            foreach( $models as $model ){

                $thumbnailURL = in_array($model->type, ['image/jpeg', 'image/png', 'image/gif']) ? attachments::getThumbnailUrl( "/upload/media/".$model->attachment, 600, 600, "CROP" ) : 'http://www.placehold.it/600x600/EFEFEF/AAAAAA&text=Preview+Unavailable';

                ?>
                <div class="cbp-item <?= $model->fileType() ?>">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <?php
                            if (in_array($model->type, ['image/jpeg', 'image/png', 'image/gif'])) {
                                ?>
                                <a href="<?= "/upload/media/" . $model->attachment ?>"
                                       class="cbp-lightbox"
                                       data-title="">
                                <?php
                            }
                            ?>
                            <img src="<?= $thumbnailURL ?>" alt="">
                                    <?php
                                    if (in_array($model->type, ['image/jpeg', 'image/png', 'image/gif'])) {
                                    ?>
                                    </a>
                                        <?php
                                        }
                            ?>
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    <?php
                                    if( isset($tinymce) ){

                                        ?>
                                        <a href="#"
                                           class=" cbp-l-caption-buttonLeft btn red uppercase btn red uppercase tinymce_use_file"
                                           rel="nofollow" data-file-type="<?= $model->fileType() ?>">use</a>
                                        <?php

                                    } else {
                                        ?>
                                        <a href="/backend/media/delfile/<?= $model->id ?>"
                                           class=" cbp-l-caption-buttonLeft btn red uppercase btn red uppercase"
                                           rel="nofollow">delete</a>
                                        <a href="#replacefile"
                                           class=" cbp-l-caption-buttonRight btn uppercase btn btn-primary uppercase replace_file"
                                           data-title="" data-toggle="modal" data-file-id="<?= $model->id ?>">replace</a>
                                        <a href="#"
                                           class="  btn uppercase btn btn-primary uppercase show_media_url"
                                           data-title="" style="    padding: 4px 12px 5px 12px;">url</a>
                                    <?php
                                    }
                                        ?>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="cbp-l-grid-projects-title text-center text-center media_url" style="display: none;"><input type="text" value="<?= Yii::$app->params["domainUrl"].'upload/media/'.$model->attachment ?>" class="form-control"></div>
                    <div class="cbp-l-grid-projects-title text-center text-center media_file_name"><?= $model->attachment ?></div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center"><?= ucfirst($model->fileType()).' ['.Media::formatBytes( $model->size ).']' ?></div>
                </div>
                <?php

            }

        }
        ?>
    </div>
</div>