<?php

namespace app\controllers;

use app\base\controller;
use app\base\Init;
use app\base\Request;
use app\models\Category;

class CategoryController extends controller
{
    public function index()
    {
        $category = new Category();
        $data = $category->getAllCategories();

        $this->setLayout('app');
        return $this->view('category' , ['model' => $category, 'data' => $data]);
    }

    public function create(Request $request)
    {
        $category = new Category();
        if($request->isPost()) {
            $category->loadData($request->payload());
            if ($category->validate() && $category->save()) {
                Init::$self->session->setFlash('success', 'New Category Added');
                self::redirect('/category');
            }
            $this->setLayout('app');
            $category = new Category();
            $data = $category->getAllCategories();
            return $this->view('category', [
                'model' => $category,
                'data' => $data
            ]);
        }

        $this->setLayout('app');
        return $this->view('create', [
            'model' => $category
        ]);
    }

    public function show(Request $request)
    {
        $category = new Category();

        $data = $category->getCategoryById($request->payload()['id']);
        $this->setLayout('app');
        return $this->view('category-update', [
            'model' => $category,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $category = new Category();
        if($request->isPost()) {
            $category->loadData($request->payload());
            if ($category->validate() && $category->updateCategory($request->payload()['id'])) {
                Init::$self->session->setFlash('success', 'Category Updated');
                self::redirect('/category');
            }
            $this->setLayout('app');
            $category = new Category();
            $data = $category->getAllCategories();
            return $this->view('category', [
                'model' => $category,
                'data' => $data
            ]);
        }

        $this->setLayout('app');
        return $this->view('category', [
            'model' => $category
        ]);
    }

    public function delete(Request $request)
    {

        $category = new Category();
        if($request->isGet()) {
            if ($category->deleteCategory($request->payload()['id'])) {
                Init::$self->session->setFlash('success', 'Category Deleted');
                self::redirect('/category');
            }
            $this->setLayout('app');
            $category = new Category();
            $data = $category->getAllCategories();
            return $this->view('category', [
                'model' => $category,
                'data' => $data
            ]);
        }


        $this->setLayout('app');
        return $this->view('category', [
            'model' => $category
        ]);
    }
}