<?php
   /** @var $model \app\models\User */
?>



<div class="container" style="width: 25rem; margin-top: 2rem;">
    <h1 style="text-align: center;">Administration Registration</h1>
    <div class="card">
        <div class="card-body" style="">
                <?php
                use app\base\components\Form;
                $form = Form::open('', "post");
                echo $form->field($model, 'firstname');
                echo $form->field($model, 'lastname');
                echo $form->field($model, 'email');
                echo $form->field($model, 'password')->passwordField();
                echo $form->field($model, 'confirmpassword')->passwordField();
                echo sprintf('<button type="submit" class="btn btn-primary">Submit</button>');
                Form::close();
                ?>
        </div>
    </div>
</div>


