<?php
/** @var $model \app\models\Product */
/** @var $data \app\models\Product */

use app\base\Init;
use app\models\Category;


$categories = Category::findAll();

$optionsHtml = '';

foreach ($categories as $category) {
    $optionsHtml .= sprintf('<option value="%d">%s</option>',
        $category->id,
        htmlspecialchars($category->name)
    );
}
?>

<div class="container" style="padding: 5rem;">
    <?php if(Init::$self->session->getFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= Init::$self->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Product
    </button>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Create At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $product)
        {
            echo '<td>' . htmlspecialchars($product->id) . '</td>';
            echo '<td>' . htmlspecialchars($product->name) . '</td>';
            echo '<td>' . htmlspecialchars(Category::findOne(['id' => $product->category_id])->name) . '</td>';
            echo '<td>' . htmlspecialchars($product->price) . '</td>';
            echo '<td> <img src="storage/'.htmlspecialchars($product->image ?? '').'" alt="product image" width="50px;" height="50px"></td>';
            echo '<td>' . htmlspecialchars($product->description) . '</td>';
            echo '<td>' . htmlspecialchars($product->created_at) . '</td>';
            echo '<td><a href="/product/show?id=' . htmlspecialchars($product->id) . '" class="btn btn-warning">Update</a>
                              <a href="/product/delete?id=' . htmlspecialchars($product->id) . '" class="btn btn-danger">Delete</a>
                            </td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    use app\base\components\Form;

                    $form = Form::open('', "post");
                    echo $form->field($model, 'name');
                    echo $form->field($model, 'price');
                    echo $form->field($model, 'description');
                    echo sprintf('<div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        <option selected>Select Category</option>
                                              %s
                                    </select>
                                </div>', $optionsHtml);
                    echo sprintf('<div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="image">
                                </div>');
                    echo sprintf('<button type="submit" class="btn btn-success">Add New</button>');
                    Form::close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>