<?php session_start();
session_destroy();
header('Location: etusivu.php');
exit;
?>