<?php
/** @var $model \app\model\users */

use app\base\Init;
?>

<div class="container" style="width: 25rem; margin-top: 10rem;">
    <h1 style="text-align: center;">Login</h1>
    <div class="card">
        <div class="card-body" style="">
            <?php if(Init::$self->session->getFlash('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= Init::$self->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
            <?php
            use app\base\components\Form;

            $form = Form::open('', "post");
            echo $form->field($model, 'email');
            echo $form->field($model, 'password')->passwordField();
            echo sprintf('<button type="submit" class="btn btn-primary">Sign In</button>');
            echo sprintf('<a href="/register" class="btn btn-danger" style="margin-left: 10px;">Sign Up</a>');
            Form::close();

            ?>
        </div>
    </div>
</div>


