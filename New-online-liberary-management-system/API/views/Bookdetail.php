<?php
// This file serves as the entry point for the request, initializing the controller and displaying the response

include_once '../controllers/BookController.php';

// Create an instance of the BookController
$bookController = new BookController();

// Fetch and return the book details in JSON format
$bookController->getBookDetails();
