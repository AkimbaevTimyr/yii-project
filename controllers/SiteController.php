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

use app\models\CourseMaterials;
use app\models\CourseMaterialsItems;

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
       
        
        $model = new Courses();
        $query = Courses::find()->all();

        return $this->render('main', [
            'model' => $model,
            'courses' => $query,
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
        $course_materials = CourseMaterials::find()->where(['course_id' => $id])->all();
        $course_materials_items = CourseMaterialsItems::find()->where(['course_id' => $id])->all();
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

        return $this->render('course',[
            'course' => $item, 
            'events' => $tasks, 
            'course_materials' => $course_materials, 
            'course_materials_items' => $course_materials_items
        ]);

    }


    public function actionDownload($name)
    {
        $file = Yii::getAlias('../files/' . $name . '.docx');
        if(file_exists($file))
        {
            \Yii::$app->response->sendFile($file);
        }
    }


}
