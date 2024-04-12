<?php
include("../config/sess.php");

session_unset();


session_destroy();


header('Location: ../index.php');
exit();
?>
