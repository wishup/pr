<?php
namespace frontend\controllers;

use common\models\PostComments;
use common\models\Posts;
use Yii;

/**
 * Site controller
 */
class BlogController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'common\components\Captcha',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $current_page = Yii::$app->request->get("p") ? (int)Yii::$app->request->get("p") : 1;

        $per_page = 10;

        $posts = \common\models\Posts::find()->offset( ( $current_page - 1 ) * $per_page )->limit($per_page)->orderBy("date")->all();
        $postcount = \common\models\Posts::find()->count();

        $pages_count = ceil( $postcount / $per_page );

        return $this->render('index', [
            "posts" => $posts,
            "pages_count" => $pages_count,
            "current_page" => $current_page,
        ]);
    }

    public function actionPost( $id ){

        $message = 0;

        if( $post = Posts::find()->where("id=".(int)$id)->one() ){

            $commentmodel = new PostComments();

            if( $commentmodel->load(Yii::$app->request->post()) ){

                if( $commentmodel->validate() ){

                    $commentmodel->date = date("Y-m-d H:i:s");
                    $commentmodel->status = 0;
                    $commentmodel->post_id = $post->id;

                    $commentmodel->save();

                    $commentmodel = new PostComments();

                    $message = 1;

                }

            }

            return $this->render("post", [
                "post" => $post,
                "commentmodel" => $commentmodel,
                "message" => $message,
            ]);

        } else {

            return $this->redirect("/blog/404");

        }

    }



}
