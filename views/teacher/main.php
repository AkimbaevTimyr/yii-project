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
                        <?= Html::a('Кабинет Учителя', ['teacher/main'])?>
                    </div>
                </li>
                <li>
                    <button class="dropdown-content-button" onclick="myTimetableFunction()">Добавить расписание</button>
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
            <div style="margin-right: 30px; font-size:20px; display: flex; margin-right: 30px; color: rgba(0, 0, 0, 0.55); align-items: center; cursor: pointer" onclick="exitFunction()">Выйти</div>
        </ul>
    </nav>
    <div class="main-body-content" id="main-body-content"></div>
</div>

<script type="text/javascript">

    function myTimetableFunction() {
        $.ajax({
            url: '/teacher/timetable',
            method: 'GET',
            success: function(data) {
                $("#main-body-content").html(data);
            }
        })
        document.getElementById('main-body-content').classList.add('show')
    }


    function exitFunction(){
        $.ajax({
            url: '/user/logout',
            method: "POST",
            success: function(){
                console.log('exit');
            }
        })
    }

</script>