<?php
use kartik\date\DatePicker;
use miloschuman\highcharts\Highmaps;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

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
                                'events' => $events
                        ));
                        ?>
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
        ],
    ]); ?>

<!-- 
        <div class="course-items">
               
                
        </div> -->

</div>





