<?php 

namespace app\controllers;

use app\models\CourseMaterials;
use app\models\CourseMaterialsItems;
use app\models\Courses;
use app\models\Files;
use app\models\UploadForm;
use yii\web\UploadedFile;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
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
        $section = new CourseMaterials();
        $courseMaterials = new CourseMaterialsItems();
        $sectionItems = CourseMaterials::find()->all();
        $request = Yii::$app->request->post();
        $courses = Courses::find()->all();
        
        if($request)
        {
            if($course->load($request) && $course->save() && $course->validate())
            {
                return $this->redirect('create-course');
            }
        }

        return $this->render('createCourse', [
            'course' => $course,
            'courses' => $courses,
            'section' => $section,
            'courseMaterials' => $courseMaterials,
            'sectionItems' => $sectionItems,
        ]);

    }

    public function actionCreateSections()
    {
        $section = new CourseMaterials();
        $request = Yii::$app->request->post();
        if($request)
        {
            if($section->load($request) && $section->save() && $section->validate())
            {
                return $this->redirect('create-course');
            }
        }
    }

    public function actionMaterials()
    {
        
        $courses = Courses::find()->all();  // ищем курсы для рендеринга
        $sectionItems = CourseMaterials::find()->all(); //ищем материалы курса
        $section = new CourseMaterialsItems(); // создаем новую секцию для метериалов к разделу

        $request = Yii::$app->request->post();

        if($request)
        {
            if($section->load($request) && $section->save() && $section->validate())
            {
                return $this->redirect('materials');
            }
        }
        return $this->render('materials',[
            'courses' => $courses,
            'sectionItems' => $sectionItems,
            'section' => $section
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();
        $files = new Files();

        if(Yii::$app->request->isPost) 
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            $files->saveImage($model->upload());
        }
        return $this->render('upload', ['model' => $model]);
    }

}