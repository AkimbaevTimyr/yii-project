<?php 
use yii\helpers\Html;

?>

<div class="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation" style="background-color: #293846;">
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
        <ul class="nav navbar-top-links navbar-right ">
            <div style="margin-right: 30px; font-size:20px; display: flex; margin-right: 30px; color: rgba(0, 0, 0, 0.55); align-items: center; cursor: pointer" onclick="exitFunction()">Выйти</div>
        </ul>
    </nav>
    <div>
    
    </div>

    <div class="main-body-content" id="main-body-content">
        
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
    
    function exitFunction() {
        $.ajax({
            url: '/user/logout',
            method: "POST",
            success: function() {
                console.log('exit')
            }
        })
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

