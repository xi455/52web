<?php

include('./link.php');

// echo $_POST['name'];
// echo $_POST['DealWith'];
// echo $_POST['TimeNow'];
// echo $_POST['StartTime'];
// echo $_POST['EndTime'];
// echo $_POST['TextBox'];


$sql = $db->prepare('update works set Name=:name,DealWith=:delwith,
TimeNow=:timenow,StartTime=:start,EndTime=:end,TextBox=:text where Name=:name');

$sql->bindValue('name', $_POST['name']);
$sql->bindValue('delwith', $_POST['DealWith']);
$sql->bindValue('timenow', $_POST['TimeNow']);
$sql->bindValue('start', $_POST['StartTime']);
$sql->bindValue('end', $_POST['EndTime']);
$sql->bindValue('text', $_POST['TextBox']);

$sql->execute();

header('location:./draggable.php');
