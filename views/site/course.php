<?php
use miloschuman\highcharts\Highmaps;
use yii\bootstrap\Tabs;
use yii\helpers\Html;

?>
        
      

<div class="course">

        <h1><?= $course->name ?> Курс</h1>

        <?php $this->beginBlock('visits'); ?>
                <div class="course-statistics">
                        <?php
                                $current_month = date('m');
                                $monthes = array("Январь","Февраль","Март","Апрель","Май","Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" );
                                
                                $m = substr($current_month, 1);

                                echo Highmaps::widget([
                                        'id' => 'maps',
                                        'options' => [
                                                'chart' => [
                                                        'type' => 'pie',
                                                ],
                                                'credits' => [
                                                        "enabled" => false,
                                                ],
                                                'title' => [
                                                'text' => 'Статистика посещений за ' . $monthes[$m-1] . '' ,
                                                'style' => [
                                                        'align' => 'left'
                                                ],
                                                ],
                                                'accessibility' => [
                                                        'announceNewData' => [
                                                                'enabled' => 'true',
                                                        ],
                                                        'point' => [
                                                        ],
                                                ],
                                                'plotOptions' => [
                                                        'series' => [
                                                                'dataLabels' => [
                                                                        'enabled' => 'true',
                                                                        'format' => '{point.name}: {point.y} уроков'
                                                                ],
                                                        ],
                                                        'pie' => [
                                                                'allowPointSelect' => true,
                                                                'cursor' => 'pointer',
                                                                'dataLabels' =>  [
                                                                        'enabled' => false,
                                                                ],
                                                                'showInLegend'=> true,
                                                        ],
                                                ],
                                                'series' => [
                                                [
                                                        'data' => [
                                                                [
                                                                        'name' => 'Посещено',
                                                                        'y' => 23,
                                                                ],
                                                                [
                                                                        'name' => 'Пропущено',
                                                                        'y' => 5,
                                                                ],

                                                        ],
                                                        'joinBy' => 'hc-key',
                                                        'name' => 'Статистика посещений',
                                                ],
                                                ],
                                        ],
                                ]);
                        ?>
                </div>
        <?php $this->endBlock(); ?> 

        <?php $this->beginBlock('DatePicker'); ?>
                <div class="yii2fullcalendar">
                        <?= yii2fullcalendar\yii2fullcalendar::widget(array(
                                'clientOptions' => [
                                        'height' => 650,
                                        'selectable' => true,
                                        'selectHelper' => true,
                                        'droppable' => true,
                                        'editable' => true,
                                        'fixedWeekCount' => false,
                                        'defaultDate' => date('Y-m-d'),
                        ],
                                'ajaxEvents' => $events
                        ));?> 
                </div>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('CourseMaterials') ?>
        <div class="panel-group course-materials" id="accordion" role="tablist" aria-multiselectable="true">
                <?php  foreach ($course_materials as $item): ?>
                        <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-one" aria-expanded="true">
                                                <?= $item->name ?>
                                        </a>
                                </h4>
                                </div>
                                <!-- Содержимое раскрыто: aria-expanded="true", есть класс class="in" -->
                                <div id="collapse-one" class="panel-collapse collapse in" role="tabpanel" aria-expanded="true">
                                <div class="panel-body">
                                        <?php foreach( $course_materials_items as $item): ?>
                                                <h4 class="black course-materials-item"><a><?= $item->name ?></a></h4>
                                        <?php endforeach;?>
                                        <div>
                                                <?= Html::a('Скачать материалы курса', ['site/download', 'name' =>  strtolower($course->name)]) ?>
                                        </div>
                                </div>
                                </div>
                                
                        </div>

                <?php endforeach; ?>
                <!-- <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                                <!-- Содержимое скрыто: aria-expanded="false", есть класс class="collapsed" -->
                                <!-- <a class="collapsed" role="button" data-toggle="collapse"
                                data-parent="#accordion" href="#collapse-two" aria-expanded="false">
                                Основы Python
                                </a>
                        </h4>
                        </div>
                        <!-- Содержимое скрыто:  aria-expanded="false", нет класса class="in" -->
                        <!-- <div id="collapse-two" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                        <div class="panel-body">
                                <h4 class="black">Второй заголовок</h4>
                                <p class="black">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                        </div>
                        </div> -->
                <!-- </div>
                <div class="panel panel-default"> -->
                        <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                                <!-- Содержимое скрыто: aria-expanded="false", есть класс class="collapsed" -->
                                <a class="collapsed" role="button" data-toggle="collapse"
                                data-parent="#accordion" href="#collapse-three" aria-expanded="false">
                                Коллекция,циклы и логика в Python
                                </a>
                        </h4>
                        </div>
                        <!-- Содержимое скрыто: aria-expanded="false", нет класса class="in" -->
                        <div id="collapse-three" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                        <div class="panel-body">
                                <h4 class="black">Третий заголовок</h4>
                                <p class="black">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                        </div>
                        </div>
                <!-- </div> --> --> -->
        </div>

        <?php $this->endBlock(); ?>
       
       <?php echo Tabs::Widget([
        'items' => [
            [
                'label' => 'Посещения',
                'content' => $this->blocks['visits'],
                'active' => true,
            ],
            [
                'label' => 'Календарь',
                'content' => $this->blocks['DatePicker'],
            ],
            [
                'label' => 'Материалы курса',
                'content' => $this->blocks['CourseMaterials'],
            ],
        ],
    ]); ?>

</div>





