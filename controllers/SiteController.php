<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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

    public function actionReqresetpassword()
    {
        $this->layout = 'login';

        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
          $user_email = User::findByEmail($model->first_email);
          if(!empty($user_email)){
              $user_email->password_token= sha1(mt_rand(10000, 99999).time().$user_email->password);
              $user_email->save();
              $admin_email = \Yii::$app->mailer->compose()
                  ->setTo($model->first_email)
                  ->setFrom([\Yii::$app->params['adminEmail'] => 'Admin ' . \Yii::$app->name])
                  ->setSubject('Reset Password for SIA UI PLN')
                  ->setTextBody("Click this link ".\yii\helpers\Html::a('Reset Password',
                        Yii::$app->urlManager->createAbsoluteUrl(
                          ['site/confirmreset', 'password_token'=>$user_email->password_token]
                        )
                      )
                    )
                  ->send();
              if($admin_email) {
                Yii::$app->getSession()->setFlash('success','Check Your email!');
              } else {
                Yii::$app->getSession()->setFlash('warning','Failed, contact Admin!');
              }
              return $this->goHome();
          }
          return null;
        }

        return $this->render('requestResetPassword', [
        'model' => $model,
        ]);
    }

    public function actionConfirmreset($password_token)
    {
        $this->layout = 'login';

        $model = new User();
        if($model->load(Yii::$app->request->post())) {
            $user = User::find()->where(['password_token' => $password_token])->one();
            $user->password = $model->password;
            $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $user->updated_at = date('Y-m-d H:i:s');
            if($user->save()) {
                Yii::$app->getSession()->setFlash('success','Success!');
                return $this->goHome();
            } else {
              Yii::$app->getSession()->setFlash('warning','Failed!');
              return $this->goBack();
            }
        } else {
            return $this->render('resetPassword', [
              'model' => $model,
            ]);
        }
    }

    // public function actionResetpassword($email){
    //   $model = new User();
    //   if($model->load(Yii::$app->request->post())) {
    //       $user = User::find()->where(['first_email' => $email])->one();
    //       $user->password = $model->password;
    //       $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
    //       $user->updated_at = date('Y-m-d H:i:s');
    //       if($user->save()) {
    //           Yii::$app->getSession()->setFlash('success','Success!');
    //           return $this->goHome();
    //       }
    //   } else {
    //     return $this->render('resetPassword', [
    //       'model' => $model,
    //     ]);
    //   }
    // }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model_1 = new LoginForm();
        $model_2 = new User();

        //login
        if ($model_1->load(Yii::$app->request->post())) {
            if($model_1->login() && $model_1->getUser()->verification_status === 1)
                return $this->goBack();
            else
                return $this->redirect(['site/login']);
        }

        //Signup
        if ($model_2->load(Yii::$app->request->post())) {
          if ($model_2->validate()) {
              $model_2->password_hash = Yii::$app->security->generatePasswordHash($model_2->password);
              $model_2->auth_key = sha1(mt_rand(10000, 99999).time().$model_2->first_email);
              $model_2->created_at = date('Y-m-d H:i:s');
              if ($model_2->save(false)) {
                  $email = \Yii::$app->mailer->compose()
                      ->setTo($model_2->first_email)
                      ->setFrom([\Yii::$app->params['adminEmail'] => 'Admin ' . \Yii::$app->name])
                      ->setSubject('Signup Confirmation')
                      ->setTextBody("Click this link ".\yii\helpers\Html::a('Confirm Registration',
                            Yii::$app->urlManager->createAbsoluteUrl(
                              ['site/confirmregistration','auth_key'=>$model_2->auth_key]
                            )
                          )
                        )
                      ->send();
                  if($email) {
                    Yii::$app->getSession()->setFlash('success','Check Your email!');
                  } else {
                    Yii::$app->getSession()->setFlash('warning','Failed, contact Admin!');
                  }
              }
          }
          return $this->goBack();
        }
        return $this->render('login', [
            'model_1' => $model_1,
            'model_2' => $model_2,
        ]);
    }

    public function actionConfirmregistration($auth_key)
    {
          $user = User::find()->where(['auth_key' => $auth_key])->one();
          if(!empty($user)) {
              $user->verification_status=1;
              $user->save();
              Yii::$app->getSession()->setFlash('success','Success!');
          } else {
              Yii::$app->getSession()->setFlash('warning','Failed!');
          }
          return $this->goHome();
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $model = User::findOne(Yii::$app->user->id);
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save(false);

        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
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
