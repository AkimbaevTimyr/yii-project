<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;


class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'register', 'login'],
                'rules' => [
                    [
                        'actions' => ['logout',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['register', 'login'],
                        'allow' => true,
                    ],
                ],
                // 'denyCallback' => function($rule, $action) {
                //     Yii::$app->response->redirect(['user/login']); 
                // },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){
            return $this->redirect(['site/main']);
        }

        $request = Yii::$app->request->post();
        $user = new User();

        if($request)
        {
            if($user->load($request) && $user->login())
            {
                if(\Yii::$app->user->can('user'))
                {
                    return $this->redirect(['site/main']);
                }else if(\Yii::$app->user->can('admin'))
                {
                    return $this->redirect(['admin/admin']);
                }else if(\Yii::$app->user->can('teacher'))
                {
                    $this->redirect(['teacher/main']);
                }
            }
            $session = Yii::$app->session;
            $session->setFlash('errorMessage', $user->getErrors());
        }
        $user->password = "";
        return $this->render('login', [
            'user' => $user,
        ]);
    }

    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(["user/login"]);
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionSignUp()
    {
        $request = Yii::$app->request->post();

        $user = new User();
        $user->attributes = $request;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
        $session = Yii::$app->session;

        if($user->validate() && $user->save())
        {

            $session->setFlash('successMessage', 'Регистрация прошла успешно');

            //Присвоение роли пользовет
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($userRole, $user->getId());

            return $this->redirect(['user/login']);
        }
        $session->setFlash('errorMessage', $user->getErrors());
        return $this->redirect(['user/register']);
    }
    
}