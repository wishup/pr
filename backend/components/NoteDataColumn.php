<?php
namespace backend\components;

use mdm\admin\models\User;
use yii\grid\DataColumn;
use Yii;


class NoteDataColumn extends DataColumn
{


    function __construct($config = [])
    {
        parent::__construct($config);


        $this->label = "Note";
        $this->value = function ($model) {


            $view_or_create = '<a class="note-view note-view-main ' . ((!$model->note_text) ? "hidden" : "") . '" href="#"><span class="notes_count" style="padding:0px 5px">' . intval(@$model->notes_count) . '</span></a>
            <a class="note-create note-create-main ' . ((!$model->note_text) ? "" : "hidden") . '" href="#"><span style="padding:0px 5px">0</span></a>';

            if ($model->note_author_id)
                $note_admin = User::find()->where('id=' . $model->note_author_id)->one();

            $last_note = '<p><span class="note-autor">' . @$note_admin->username . '</span><span class="note-date">' . @$model->note_date . '</span></p>
            <p class="note-text">' . @$model->note_text . '</p>';

            $block = '<div class="users-notes-wrap">' . $view_or_create;
            $block .= '<div class="note-view-box note-box">
            <div class="note-box-cont"><a class="note-create pull-right" href="#"><i class="glyphicon glyphicon-edit"></i></a>' . $last_note . '</div>
            <div class="note-box-foot clearfix">
            <a class="note-view-all  pull-left" href="/backend/users/update/' . $model->id . '/6">View All</a>
            </div>
            </div>';
            $block .= '<div class="note-create-box note-box">
            <div class="note-box-cont">
            <div class="form-group">
            <label>Add Note</label>
            <textarea rows="4" class="form-control"></textarea>
            </div>
            </div>
            <div class="note-box-foot clearfix">
            <button class="note-save pull-right btn btn-primary" data-id="' . $model->id . '" data-author="' . Yii::$app->user->id . '">Save</button>
            </div>
            <div/>';
            $block .= '</div>';


            return $block;
        };

        $this->contentOptions = ['class' => 'note-content-td'];
        $this->headerOptions = ['class' => 'note-header-td'];
        $this->filterOptions = ['class' => 'note-filter-td'];

        $this->format = "raw";

    }

    protected function renderFilterCellContent()
    {
        $this->attribute = 'note_text';
        return parent::renderFilterCellContent();
    }

    protected function renderHeaderCellContent()
    {
        $this->attribute = 'notes_count';
        return parent::renderHeaderCellContent();
    }
}
