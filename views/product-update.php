<?php
/** @var $model \app\models\Product */
/** @var $data \app\models\Product */

use app\models\Category;
use app\base\components\Form;

$categories = Category::findAll();

$optionsHtml = '';

foreach ($categories as $category) {
    $isSelected = $category->id == $data->category_id ? 'selected' : '';
    $optionsHtml .= sprintf('<option value="%d" %s>%s</option>',
        $category->id,
        $isSelected,
        htmlspecialchars($category->name)
    );
}
?>



<div class="container" style="width: 25rem; margin-top: 2rem;">
    <h1 style="text-align: center;">Product Update</h1>
    <div class="card">
        <div class="card-body" style="">
            <?php

            $form = Form::open('/product/update', "post");
            echo sprintf('<input type="hidden" name="id" value="%s">', $data->id);
            echo $form->field($model, 'name', $data->name);
            echo $form->field($model, 'price', $data->price);
            echo $form->field($model, 'description', $data->description);
            echo sprintf('<div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        <option selected>Select Category</option>
                                              %s
                                    </select>
                                </div>', $optionsHtml);
            echo sprintf('<button type="submit" class="btn btn-success">update</button>');
            Form::close();
            ?>
        </div>
    </div>
</div>