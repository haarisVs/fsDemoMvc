<?php

namespace app\controllers;

use app\base\controller;
use app\base\Init;
use app\base\Request;
use app\models\Product;

class ProductController extends controller
{
    public ?object $product;

    /**
     * @param object|null $product
     */
    public function __construct()
    {
        $this->product = (new Product());
    }


    public function index()
    {
        $data = $this->product->getAllProducts();

        $this->setLayout('app');
        return $this->view('product' , ['model' => $this->product, 'data' => $data]);
    }

    public function create(Request $request)
    {
        if($request->isPost()) {

            $uploadedFile = $_FILES['image'];
            if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
                $uploadDir = Init::$ABS_DIR.'/public/storage/';
                $uploadPath = $uploadDir . basename($uploadedFile['name']);
                if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
                    $this->product->image = basename($uploadedFile['name']);
                }
            }
            $this->product->loadData($request->payload());
            if ($this->product->validate() && $this->product->save()) {
                Init::$self->session->setFlash('success', 'New Product Added');
                self::redirect('/product');
            }
            $this->setLayout('app');
            $data = $this->product->getAllProducts();
            return $this->view('product', [
                'model' => $this->product,
                'data' => $data
            ]);
        }

        $this->setLayout('app');
        return $this->view('create', [
            'model' => $this->product
        ]);
    }

    public function show(Request $request)
    {
        $data = $this->product->getProductById($request->payload()['id']);
        $this->setLayout('app');
        return $this->view('product-update', [
            'model' => $this->product,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        if($request->isPost()) {
            $this->product->loadData($request->payload());
            if ($this->product->validate() && $this->product->updateProduct($request->payload()['id'])) {
                Init::$self->session->setFlash('success', 'Product Updated');
                self::redirect('/product');
            }
            $this->setLayout('app');
            $data = $this->product->getAllProducts();
            return $this->view('product', [
                'model' => $this->product,
                'data' => $data
            ]);
        }
    }

    public function delete(Request $request)
    {
        if($request->isGet()) {
            $this->product->loadData($request->payload());
            if ($this->product->deleteProduct($request->payload()['id'])) {
                Init::$self->session->setFlash('success', 'Product Deleted');
                self::redirect('/product');
            }
            $this->setLayout('app');
            $data = $this->product->getAllProducts();
            return $this->view('product', [
                'model' => $this->product,
                'data' => $data
            ]);
        }
    }

}