<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Button;
use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
use yii\widgets\ActiveForm;

?>


<div class="attendance">
    <div class="table-responsive">
        <div class="table">
            <div class="flex">
                <div>
                </div>
                <div class="buttons">
                    <div class="date">
                        Tue<br />
                        29<br />
                        Oct
                    </div>
                    <div class="date">
                        Tue<br />
                        29<br />
                        Oct<br />
                    </div>
                    <div class="date">
                        Tue<br />
                        29<br />
                        Oct
                    </div>
                    <div class="date">
                        Tue<br />
                        29<br />
                        Oct
                    </div>
                    <div class="date">
                        Tue<br />
                        29<br />
                        Oct
                    </div>
                </div>
            </div>
            <div class="table table-striped">
                <?php foreach ($students as $student): ?>
                    <div class="student">
                        <div class="name">
                            <?= Html::tag('p', Html::encode("{$student->name}"), ['class' => ''] ) ?>
                        </div>
                        <div class="buttons">
                            <div class="button">
                                <?= Html::a('+', ['site/update']) ?>
                            </div>
                            <div class="button">
                                <?= Html::a('+', ['site/update']) ?>
                            </div>
                            <div class="button">
                                <?= Html::a('+', ['site/update']) ?>
                            </div>
                            <div class="button">
                                <?= Html::a('+', ['site/update']) ?>
                            </div>
                            <div class="button">
                                <?= Html::a('+', ['site/update']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- 
<?= Html::a('Обновить', ['site/update']) ?> -->


<?php echo LinkPager::widget([
    'pagination' => $pagination,
    'prevPageLabel' => false,
    'nextPageLabel' => false,
    'options' => [
        'class' => 'ip-mosaic__pagin-list content-center',
    ],
]); ?>

