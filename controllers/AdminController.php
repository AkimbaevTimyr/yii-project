<?php 

namespace app\controllers;

use app\models\Courses;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['admin'],
                'rules' => [
                    [
                        'actions' => ['admin',],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    return $this->goBack(Yii::$app->request->referrer);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionAdmin()
    {
        return $this->render('main');
    }



    public function actionCreateCourse()
    {
        $course = new Courses();
        $request = Yii::$app->request->post();
        
        if($request)
        {
            if($course->load($request) && $course->save() && $course->validate())
            {
                return $this->redirect('create-course');
            }
        }

        return $this->render('createCourse', [
            'course' => $course
        ]);

    }

}