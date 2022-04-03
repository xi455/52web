<?php

include('./link.php');

echo $_GET['value'];
// echo $_GET['value'];

$val = explode(",", $_GET['value']);

$sql = $db->prepare('update works set StartTime=:start,EndTime=:end where Name=:name');

$sql->bindValue('start', $val[1]);
$sql->bindValue('end', $val[2]);
$sql->bindValue('name', $val[0]);

$sql->execute();

header('location:./draggable.php');
