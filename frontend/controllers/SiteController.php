<?php
namespace frontend\controllers;

use common\models\Unsubscribe;
use common\models\UnsubscribeReasons;
use Yii;
use frontend\controllers\BaseController;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Pages;
use common\models\Glossary;
use common\models\Faq;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\models\FaqCategories;
use yii\web\Session;
use kartik\mpdf\Pdf;
use moonland\phpexcel\Excel;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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
        $this->layout = 'index';
        return $this->render('index');
    }

    /**
     * Displays FAQ.
     *
     * @return mixed
     */
    public function actionFaq()
    {
        if( !$glossary = Glossary::find()->where("status = 'published'")->orderBy('word')->all()){
            $glossary = '';
        }

        if( !$faq = FaqCategories::find()->all()){
            $faq = '';
        }
        
        $request = Yii::$app->request;
        $query = Faq::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if($request->post('type') == 'faq'){
            $columns = [
                "question",
                [
                    'attribute' => 'answer',
                    'header' => 'Answer',
                    'format' => 'text',
                    'value' => function($mod) {
                        return strip_tags($mod->answer);
                    },
                ],
                [
                    'attribute' => 'name',
                    'header' => 'Category name',
                    'format' => 'text',
                    'value' => function($mod) {
                        return $mod->faqcategories->name;
                    },
                ],
            ];
            if($request->post('action') == 'download_pdf') {
                $model = $faq;
            }else{
                $model = $provider->getModels();
            }
            $file = '//pdf/pdf_faq';

            $XLSfileName = 'faq.xlsx';

        }elseif($request->post('type') == 'glossary'){
            $columns = ['word','acronim','description'];
            $model = $glossary;
            $file = '//pdf/pdf_glossary';

            $XLSfileName = 'glossary.xlsx';

        }

        if($request->post('action') == 'download_xls') {
            \moonland\phpexcel\Excel::widget([
                'models' => $model,
                'mode' => 'export',
                "columns" => $columns,
                "fileName" => $XLSfileName
            ]);
        }elseif($request->post('action') == 'download_pdf') {
            $content = $this->renderPartial($file, [
                'siteUrl' => Yii::getAlias('@webroot'),
                $request->post('type') => $model
            ]);
            $pdf = new \mPDF();

            $pdf->WriteHTML($content);
            $pdf->output($request->post('type').'.pdf', 'D');
        }

        return $this->render('faq', [
            'glossary' => $glossary,
            'faq' => $faq,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionView( $id )
    {
        if( !$page = Pages::find()->where("id=".$id)->one() ){
            return $this->redirect('/404');
        }

        $session = new Session;
        if($page->status == 'private'){
            if(Yii::$app->request->post("password") ){
                if ($page->password == Yii::$app->request->post("password")) {
                    $session->open();
                    $ids = $session['page_id'];
                    $ids[] = $page->id;
                    $session['page_id'] = $ids;
                }
            }
        }

        return $this->render('view', ['page'=>$page]);
    }

    public function actionSearch( )
    {
        if(Yii::$app->request->get("search")) {
            $search = Yii::$app->request->get("search");
            $sections_arr = [
                [
                    "classname" => "\\common\\models\\Pages",
                    "section_name" => "Pages",
                    "searchfields" => array(
                        "name","content"
                    ),
                    "options" => array(
                        "title" => "name",
                        "content" => "content"
                    ),
                    "conditions" =>
                        [
                            array(
                                "field" => "status",
                                "value" => "published",
                                "cond"  => "="
                            ),
                            array(
                                "field" => "exclude_from_search",
                                "value" => "0",
                                "cond"  => "="
                            ),
                        ]
                ],
                [
                    "classname" => "\\common\\models\\Faq",
                    "section_name" => "Faq",
                    "searchfields" => array(
                        "answer","question"
                    ),
                    "options" => array(
                        "title" => "question",
                        "content" => "answer"
                    ),
                    "conditions" =>
                        [
                            array(
                                "field" => "exclude_from_search",
                                "value" => "0",
                                "cond"  => "="
                            ),
                        ],
                ],
                [
                    "classname" => "\\common\\models\\Glossary",
                    "section_name" => "Glossary",
                    "searchfields" => array(
                        "word", "description"
                    ),
                    "options" => array(
                        "title" => "word",
                        "content" => "description"
                    ),
                    "conditions" =>
                        [
                            array(
                                "field" => "exclude_from_search",
                                "value" => "0",
                                "cond"  => "="
                            ),
                        ]
                ],
            ];
            $sections_arr_view = array();
            foreach($sections_arr as $index => $section){
                $like_cont = array();
                foreach($section['searchfields'] as $searchfield){
                    $like_cont[] = $searchfield . " like '%" . $search . "%'";
                }
                $like_str = implode(" or ", $like_cont);

                $where_cond = array();
                foreach($section['conditions'] as $condition){
                    if (is_array($condition['value'])){
                        $cond = "IN";
                        $value = implode(",", $condition['value']);
                    }else {
                        $cond = $condition['cond'];
                        $value= $condition['value'];
                    }
                    $field = $condition['field'];
                    $where_cond[]= $field.$cond."'".$value."'";
                }
                $where_cond = implode(" and ", $where_cond);
                $model_name = $section['classname']::find()
                    ->Where('( '.$like_str.') AND '. $where_cond .'')
                    ->all();
                foreach($model_name as $model){
                    $sections_arr_view[$index]['section_name'] = $section['section_name'];
                    foreach($section['options'] as $key=>$searchfield){
                        $sections_arr_view[$index]['searchfields'][$key] = $model->$searchfield;
                    }
                    $sections_arr_view[$index]['options'] = $section['options'];
                }
            }
        }else{
            $sections_arr_view = [];
        }
        return $this->render('search', [
            'search_results' => $sections_arr_view,
        ]);
    }

    public function beforeAction($action)
    {
        if( $action->id == 'captcha' ){
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionUnsubscribe(){

        if( Yii::$app->request->get("email") && Yii::$app->request->get("group_id") && Yii::$app->request->get("token") ){

            if( md5(Yii::$app->params["unsubscribe_secret_key"].Yii::$app->request->get("email").Yii::$app->request->get("group_id")) == Yii::$app->request->get("token") ){

                if( Yii::$app->request->post() ){

                    $model = new Unsubscribe();

                    $model->email = addslashes( Yii::$app->request->get("email") );
                    $model->group_id = (int)Yii::$app->request->get("group_id");
                    $model->reason_id = (int)Yii::$app->request->post("reason");

                    $model->save();

                    return $this->redirect("/");

                } else {

                    $reasonmodels = UnsubscribeReasons::find()->orderBy("reason")->all();
                    $reasons = [
                        '' => ''
                    ];
                    foreach( $reasonmodels as $resmodel )
                        $reasons[ $resmodel->id ] = $resmodel->reason;

                    $this->layout = 'login';
                    $this->view->params['bodyClass'] = 'layout2';

                    return $this->render('unsubscribe', [
                        "reasons" => $reasons
                    ]);

                }

            } else
                return $this->redirect("/");

        } else
            return $this->redirect("/");

    }

}
