<?php
/** @var $model \app\models\Category */
/** @var $data \app\models\Category */
?>



<div class="container" style="width: 25rem; margin-top: 2rem;">
    <h1 style="text-align: center;">Category Update</h1>
    <div class="card">
        <div class="card-body" style="">
            <?php
            use app\base\components\Form;
            $form = Form::open('/category/update', "post");
            echo sprintf('<input type="hidden" name="id" value="%s">', $data->id);
            echo $form->field($model, 'name', $data->name);
            echo $form->field($model, 'description', $data->description);
            echo sprintf('<button type="submit" class="btn btn-success">update</button>');
            Form::close();
            ?>
        </div>
    </div>
</div>


