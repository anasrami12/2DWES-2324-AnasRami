<?php
include_once './controller/controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    loginUser($_POST['username'], $_POST['password']);
}
include_once './view/view.php';
?>
