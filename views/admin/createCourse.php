<?php 
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Tabs;
    use yii\helpers\ArrayHelper;
?>


<div>
    <?= $this->render('main') ?>
</div>

<div class="admin-create-course">

    <?php $this->beginBlock('AddCourse') ?>
        <div>
            <?php 
                $form = ActiveForm::begin([
                    'action' => ['admin/create-course'],
                    'method' => 'post'
                ])
            ?>
                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($course, 'name',  ['options' => ['class' => 'm-b-sm input-s-lg']])->input('name') ?>
                        <button class="btn btn-sm btn-primary  " type="submit"><strong>Add</strong></button>
                    </div>
                </div>
            <?php 
                ActiveForm::end();
            ?>
        </div>
    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('AddCourseSection') ?>
        <div class="admin-create-course">
            <div>
                <?php 
                    $form = ActiveForm::begin([
                        'action' => ['admin/create-sections'],
                        'method' => 'post'
                    ])
                ?>
                    <?php 
                        $items = ArrayHelper::map($courses, 'id', 'name');
                        $params = [
                            'prompt' => 'Выберите Курс'
                        ];
                        echo $form->field($section, 'course_id')->dropDownList($items,$params);
                        echo $form->field($section, 'course_materials_id', ['options' => ['placeholder' => 'Введите позицию раздела']],)->input('course_materials_id');
                    ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?= $form->field($section, 'name',  ['options' => ['class' => 'm-b-sm input-s-lg']])->input('name') ?>
                            <button class="btn btn-sm btn-primary  " type="submit"><strong>Add</strong></button>
                        </div>
                    </div>
                <?php 
                    ActiveForm::end();
                ?>
            </div>
        </div>
    <?php $this->endBlock(); ?>

    <?php echo Tabs::Widget([
        'items' => [
            [
                'label' => 'Добавить курс',
                'content' => $this->blocks['AddCourse'],
                'active' => true,
            ],
            [
                'label' => 'Добавить раздел курса',
                'content' => $this->blocks['AddCourseSection'],
            ],
        ],
    ]); ?>

    
</div>
