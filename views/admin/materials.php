<?php 
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Tabs;
    use yii\helpers\ArrayHelper;
?>

<div>
    <?= $this->render('main') ?>
</div>


<div class="admin-create-course">
            <div>
                <?php 
                    $form = ActiveForm::begin([
                        'action' => ['admin/materials'],
                        'method' => 'post'
                    ])
                ?>
                    <?php 

                        $items = ArrayHelper::map($courses, 'id', 'name');
                        $params = [
                            'prompt' => 'Выберите Курс'
                        ];

                        echo $form->field($section, 'course_id')->dropDownList($items,$params);

                        $items = ArrayHelper::map($sectionItems,'course_materials_id', 'name', 'id', );
                        $params = [
                            'prompt' => 'Выберите Раздел',
                        ];

                        echo $form->field($section, 'course_materials_id')->dropDownList($items,$params);
                    
                    ?>

                    <div class="row">
                        <div class="col-md-2">
                            <?= $form->field($section, 'name',  ['options' => ['class' => 'm-b-sm input-s-lg']])->input('name') ?>
                            <button class="btn btn-sm btn-primary" type="submit"><strong>Add</strong></button>
                        </div>
                    </div>
                <?php 
                    ActiveForm::end();
                ?>
            </div>
        </div>