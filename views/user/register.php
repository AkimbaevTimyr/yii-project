<?php 
    use yii\widgets\ActiveForm;
?>


<div id="wrapper">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">Регистрация Аккаунта</h2>
                <p>
                    Учитесь основам программирования 
                </p>
            </div>
            <div class="col-md-6 auth">
                <div class="ibox-content">
                    <?php 
                        $form = ActiveForm::begin([
                            'action' => ['user/sign-up'],
                            'method' => 'post',
                            'class' => 'm-t',
                        ])
                    ?>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Имя" required>
                        </div>
                        <div class="form-group m-b">
                            <input type="email" name="email" class="form-control" placeholder="Электронная почта" required>
                        </div>
                        <div class="form-group m-b">
                            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Регистрация</button>
                    <?php 
                        ActiveForm::end();
                    ?>
                </div>
                <div class="ibox-content auth-bottom">
                    Уже есть аккаунт? <a href="/user/login">Войти</a>
                </div>
            </div>
        </div>
        <hr/>
    </div>
</div>