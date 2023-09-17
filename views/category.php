<?php
/** @var $model \app\models\Category */
/** @var $data \app\models\Category */

use app\base\Init;
?>

<div class="container" style="padding: 5rem;">
    <?php if(Init::$self->session->getFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= Init::$self->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Category
    </button>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Create At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach ($data as $category)
                {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($category->id) . '</td>';
                    echo '<td>' . htmlspecialchars($category->name) . '</td>';
                    echo '<td>' . htmlspecialchars($category->description) . '</td>';
                    echo '<td>' . htmlspecialchars($category->created_at) . '</td>';
                    echo '<td><a href="/category/show?id=' . htmlspecialchars($category->id) . '" class="btn btn-warning">Update</a>
                              <a href="/category/delete?id=' . htmlspecialchars($category->id) . '" class="btn btn-danger">Delete</a>
                            </td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    use app\base\components\Form;

                    $form = Form::open('', "post");
                    echo $form->field($model, 'name');
                    echo $form->field($model, 'description');
                    echo sprintf('<button type="submit" class="btn btn-success">Add New</button>');
                    Form::close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>