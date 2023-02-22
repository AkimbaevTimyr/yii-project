<?php

use yii\bootstrap5\Modal;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
?>



<div class="timetable">
   

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
</div>




<script type="text/javascript">
    $(document).on('click', 'fc-day', function(){
        const date = $(this).attr('data-date');

        $.get('/teacher/createLesson', {'date': date}, function(data){
            $('modal').modal('show').find('#modalContent').load(data);
        });

    })

    $('modalButton').click(function (){
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    })


</script>