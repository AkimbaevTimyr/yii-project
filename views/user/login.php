<?php 

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Button;


?>

<div id="wrapper">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">Вход</h2>
                <p>
                    Вступайте в программы, курсы и выбирайте свой формат обучения.
                </p>
                <p>
                Бесплатно учитесь основам программирования.
                </p>
            </div>
            <div class="col-md-6 auth">
                <div class="ibox-content">
                    <?php 
                        $form = ActiveForm::begin([
                            'action' => ['user/login'],
                            "id" => "login-form",
                            'method' => 'post',
                            'class' => 'm-t',
                        ])
                    ?>
                        <div class="form-group">
                            <?= $form->field($user, 'email', ['options' => [  'type' => 'email']])->input('email')?>
                        </div>
                        <div class="form-group m-b">
                            <?= $form->field($user, 'password', ['options' => [ 'type' => 'password']])->passwordInput()?>
                        </div>
                        <?php    
                            echo Button::widget([
                            'label' => 'Login',
                            'options' => ['class' => '"btn btn-primary block full-width m-b'], // produces class "btn btn-primary"
                            ]);
                        ?>
                    <?php 
                        ActiveForm::end();
                    ?>
                </div>
                <div class="ibox-content auth-bottom">
                    Нет аккаунта? <a href="/user/register">Создать новый аккаунт</a>
                </div>
            </div>
        </div>
        <hr/>
        </div>
    </div>
</div>
