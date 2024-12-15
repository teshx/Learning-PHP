<?php
require_once '../models/Category.php';

class CategoryController
{
    private $categoryModel;

    public function __construct($db)
    {
        $this->categoryModel = new Category($db);
    }

    public function getAllCategories()
    {
        return $this->categoryModel->getAllCategories();
    }

    public function deleteCategory($id)
    {
        return $this->categoryModel->deleteCategory($id);
    }

    public function addCategory($categoryName, $status)
    {
        return $this->categoryModel->addCategory($categoryName, $status);
    }
}
