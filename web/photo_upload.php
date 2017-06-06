<?php
$data = $_POST['photo'];
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/photos/".time().'.png', $data);
var_dump($_SERVER['DOCUMENT_ROOT'] . "/photos/".time().'.png');exit;
die;
?>
