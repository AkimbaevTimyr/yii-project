<?php 
use yii\helpers\Html;
use yii\bootstrap5\Nav;

?>

<div class="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element p-h-lg p-l-md">
                        <?= Html::a('Админ Панель', ['admin/admin'])?>
                    </div>
                </li>
                <!-- <li>
                    <?= Html::a('Обучение', ['site/education'])?>
                </li> -->
            </ul>
        </div>
    </nav>
</div>
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; height: 60px">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <?php 
                echo Nav::widget([
                'options' => ['class' => 'navbar-nav align-center'],
                'items' => [
                    Yii::$app->user->isGuest
                        ? ['label' => 'Login', 'url' => ['/user/login']]
                        : '<li class="nav-item">'
                            . Html::beginForm(['/user/logout'])
                            . Html::submitButton(
                                'Выйти',
                                ['class' => 'm-t-xs nav-link btn logout']
                            )
                            . Html::endForm()
                            . '</li>'
                    ]
                ]);
            ?>
        </li>
        <li>
            <a class="right-sidebar-toggle">
                <i class="fa fa-tasks"></i>
            </a>
        </li>
    </ul>
</nav>