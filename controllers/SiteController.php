<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Popup;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function beforeAction($action)
    {

            if ($this->action->id == 'popup') {
                $this->enableCsrfValidation = false;
            }
            return true;
    }

    /**
     * answer on request
     *
     * @return string
     */
    public function actionPopup()
    {
        if (Yii::$app->request->isAjax) {

            $id = Yii::$app->request->post('id');

            //add show count
            $popup = Popup::find()
                ->where(['id' => $id])
                ->one();

            if($popup->is_active == 'on'){

                $popup->count_show += 1;
                $popup->save();


                $modal ='
                <div class="popup_wrapper">
                    <div class="block_popup">
                        <div class="block_popup-content">
                            <div class="close">&times;</div>
                                '.$popup['text'].'
                            </div>
                    </div>
                </div>
                <style>
                .popup_wrapper{
                    display: none;
                }
                .block_popup{
                    width:100%;
                    min-height:100%;
                    background-color: rgba(0,0,0,0.5);
                    overflow:hidden;
                    position:fixed;
                    top:0px;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-pack: center;
                    justify-content: center;
                    -ms-flex-align: center;
                    align-items: center;
                    z-index: 99;
                }
                .block_popup .block_popup-content{
                    margin:3rem auto 3rem auto;
                    max-width: 600px;
                    width:100%;
                    height: auto;
                    padding:2rem;
                    background-color: #c5c5c5;
                    position: relative;
                }
                .show_modal{
                    display: block;
                }
                .show_modal .block_popup .block_popup-content{
                     animation: zoomIn .5s forwards;
                }
                .modalOut .block_popup .block_popup-content{
                    animation: modalOut 1s forwards;
                    
                }
                .block_popup .block_popup-content .close{
                    display: block;
                    position: absolute;
                    top: .5rem;
                    right: .5rem;
                }
                @keyframes zoomIn {
                  0% {
                    transform:scale(0);
                  }
                  100% {
                    transform:scale(1);
                  }
                }
                @keyframes modalOut {
                  0% {
                    transform:translateY(0) rotate(0deg);
                    opacity:1;
                  }
                  100% {
                    transform:translateY(300px) rotate(45deg);
                    opacity:0;
                  }
                }
                </style>
                <script>
                    $(".block_popup .block_popup-content .close").on("click",function(){
                        $(".popup_wrapper").addClass("modalOut");
                        setTimeout(function(){
                            $(".popup_wrapper").hide();
                        },800);
                    });
                         
                    setTimeout(function(){
                          $(".popup_wrapper").addClass("show_modal");  
                     },10000);
                </script>
                ';
                return $modal;
            }
        }



    }



    /**
     * exemple with popup
     *
     * @return string
     */
    public function actionExample()
    {
        return $this->render('example');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
