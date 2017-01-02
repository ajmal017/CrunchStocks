<?php
//$pass= isset($_POST['pass']) ? $_POST['pass'] : die;
$pass= 'kissMyPass';

$hash= password_hash($password, PASSWORD_BCRYPT);
echo $hash;
password_verify($pass, $hash);