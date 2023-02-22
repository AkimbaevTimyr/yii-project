<?php 

namespace app\controllers;

use app\models\Events;
use Event;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class TeacherController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['main'],
                'rules' => [
                    [
                        'actions' => ['main',],
                        'allow' => true,
                        'roles' => ['teacher'],
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

    public function actionMain()
    {
        return $this->render('main');
    }


    public function actionTimetable()
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

        return $this->render('timetable', [
            'events' => $tasks
        ]);
    }

    public function actionCreateLesson($date)
    {
        $request = Yii::$app->request->post();
        $model = new Events();
        $model->created_date = $date;

        if($model->load($request) && $model->save() && $model->validate())
        {
            return $this->redirect(['/teacher/main']);
        }else {
            return $this->renderAjax('create', [
                'model' => $model
            ]);
        }
    }

}