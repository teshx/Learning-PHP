<?php
class CategoryController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function createCategory($name, $status)
    {
        if (empty($name)) {
            return "Category name is required.";
        }

        $result = $this->model->addCategory($name, $status);
        if ($result) {
            $_SESSION['msg'] = "Category added successfully!";
            header('Location: ../views/manage-categories.php');
        } else {
            $_SESSION['error'] = "Failed to add category.";
            header('Location: ../views/add_category.php');
        }
    }
}
