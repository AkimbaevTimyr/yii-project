<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Students;
use app\models\Courses;
use yii\data\Pagination;
use app\models\Events;


class SiteController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['main', 'education'],
                'rules' => [
                    [
                        'actions' => ['main', 'education'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->response->redirect(['user/login']); 
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

    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAttendance()
    {
        $query = Students::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $students = $query->offset($pagination->offset)
        ->limit($pagination->limit)->all();

        return $this->render('attendance', [
            'students' => $students,
            'pagination' => $pagination,
        ]);
    }
    

    public function actionMain()
    {
        $events = Events::find()->all();
        $tasks = [];
        foreach($events as $eve)
        {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eve->id;
            $event->title = $eve->title;
            $event->start = $eve->created_date;
            $tasks[] = $event;
        }
        
        $model = new Courses();
        $query = Courses::find();
        $courses = $query->all();

        return $this->render('main', [
            'model' => $model,
            'courses' => $courses,
            'events' => $tasks
        ]);
    }

    public function actionRegistration()
    {
        return $this->render('registration');
    }

    public function actionEducation()
    {
        return $this->render('education');
    }

    public function actionCourse(int $id)
    {

        $events = Events::find()->all();

        $tasks = [];
        foreach($events as $eve)
        {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eve->id;
            $event->title = $eve->title;
            $event->start = $eve->created_date;
            $tasks[] = $event;
        }

        $item = Courses::findOne($id);

        return $this->render('course',['course' => $item, 'events' => $tasks]);

    }

}
