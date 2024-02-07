<?php
include_once './model/model.php';
function loginUser($user, $pass) {
    login($user, $pass);
}

function checkUserLogin() {
    checklog();
}
?>
