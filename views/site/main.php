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
                        <?= Html::a('Онлайн школа', ['site/main'])?>
                    </div>
                </li>
                <li >
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Курсы</button>
                        <div id="myDropdown" class="dropdown-content">
                            <?php foreach ($courses as $course): ?>
                                    <button class="dropdown-content-button" onclick="myCourseFunction(<?= $course->id ?>)"><?=  $course->name ?></button><br />
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="main-body">
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


    <div>
        
    </div>
    <div class="main-body-content" id="main-body-content">
        <?= $this->render('course', ['course' => $course, 'events' => $events ]); ?>
    </div>
</div>



</div>

<script type="text/javascript">
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function myCourseFunction(id) {
        $.ajax({
            url: '/site/course?id='+id,
            method: "GET",
            success: function(data) {
                $("#main-body-content").html(data);
            }
        })
        document.getElementById('main-body-content').classList.add("show");
    }
    

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    // openDropdown.classList.add('active');
                }
            }
        }
    }
</script>


<!--                                <button onclick="myCourseFunction()" >--><?php //= Html::encode("{$course->name}") ?><!--</button><br />-->


 <!-- <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Курсы</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level block">
                        <li><a href="index.html">Java</a></li>
                        <li><a href="dashboard_2.html">Python</a></li>
                        <li><a href="dashboard_3.html">PhP</a></li>
                    </ul> -->
<!--                    --><?php
//                        $form = ActiveForm::begin();
//                        $items = ArrayHelper::map($courses,'id','name');
//                        $params = [
//                            'prompt' => 'Курсы',
//                            'class' => 'dropdown'
//                        ];
//                        echo $form->field($model, 'name')->dropDownList($items,$params);
//                        ActiveForm::end();
//                    ?>


                                    <!-- <?= Html::a($course->name, ['site/course', 'id' => $course->id]) ?> -->