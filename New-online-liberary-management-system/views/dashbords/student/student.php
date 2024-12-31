<?php
require_once __DIR__ . '/../../../middlewares/authMiddleware.php';
checkRole('Member');


header("Location: ./views/index.php");
