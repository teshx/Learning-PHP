<?php
session_start();
session_unset();
session_destroy();
//gobackto front page
header("location:../index.php?error=none");
