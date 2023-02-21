<?php 
    use yii\widgets\Pjax;
    use yii\helpers\Html;
?>


<div class="col-sm-12 col-md-6">
 <?php Pjax::begin(); ?>
    <?= Html::a("Java", ['site/multiple'], ['class' => 'btn btn-lg btn-primary']) ?>
    <h3><?= $item->name ?></h3>
 <?php Pjax::end(); ?>
</div>
<div class="col-sm-12 col-md-6">
 <?php Pjax::begin(); ?>
    <?= Html::a("Новый случайный ключ", ['site/multiple'], ['class' => 'btn btn-lg btn-primary']) ?>
    <h3><?= $randomKey ?><h3>
 <?php Pjax::end(); ?>
</div>


<?php
 $this->registerJs(
    '$("document").ready(function(){
    $(".myButtom").click(function() {
    $.pjax.reload({container:"#payments"}); //Reload GridView
    });
    });'
 );
?>
<?php yii\widgets\Pjax::begin(['id' => 'new_payment']) ?>
 <div>123</div>
<?php yii\widgets\Pjax::end(); ?>