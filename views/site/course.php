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
                        <?php foreach ($course_materials as $course_item): ?>
                                <div class="panel panel-default">
                                        <div class="panel-heading" role="tab">
                                                <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse"
                                                        data-parent="#accordion" href="#<?php echo $course_item->id ?>" aria-expanded="true">
                                                                <?= $course_item->name ?>
                                                        </a>
                                                </h4>
                                        </div>
                                        <div id="<?php echo $course_item->id ?>" class="panel-collapse collapse in" role="tabpanel" aria-expanded="true">
                                                <div class="panel-body">
                                                        <?php foreach ($course_materials_items as $item): ?>
                                                                <?php if($course_item->course_materials_id == $item->course_materials_id): ?>
                                                                        <h4 class="black"><?= $item->name ?></h4>
                                                                <?php endif; ?>
                                                        <?php endforeach; ?>
                                                </div>
                                        </div>
                                </div>
                        <?php endforeach; ?>
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





