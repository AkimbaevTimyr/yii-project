<?php

namespace app\commands;

use Yii;
use yii\console\Controller;


class RbacController extends Controller
{
    public function actionInit()
    {

        $auth = Yii::$app->authManager;

        // $auth->removeAll();

        $user = $auth->createRole('user');
        $teacher = $auth->createRole('teacher');
        $admin = $auth->createRole('admin');

        $auth->add($user);
        $auth->add($teacher);
        $auth->add($admin);

        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админ панели';

        $viewUserPage = $auth->createPermission('viewUserPage');
        $viewUserPage->description = 'Просмотр Страницы пользователя';

        $auth->add($viewAdminPage);
        $auth->add($viewUserPage);

        $auth->addChild($admin, $viewAdminPage);
        $auth->addChild($user, $viewUserPage);

        $auth->assign($admin, 1);
        $auth->assign($teacher, 2);
        $auth->assign($user, 3);
        
    }
}