<?php 
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Tabs;
?>


<div>
    <?= $this->render('main') ?>
</div>

<div class="admin-create-course">


    <?php $this->beginBlock('AddCourse'); ?>
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


    <?php $this->beginBlock('CourseMaterials'); ?>
        <div>Материалы курса</div>
    <?php $this->endBlock(); ?>

    <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => 'Добавить курс',
                    'content' => $this->blocks['AddCourse'],
                    'active' => true,
                ],
                [
                    'label' => 'Добавить Материалы Курса',
                    'content' => $this->blocks['CourseMaterials'],
                ],
            ],
    ]); ?>

    
</div>
