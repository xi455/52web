<?php

// echo $_POST['name'];
// echo $_POST['DealWith'];
// echo $_POST['TimeNow'];
// echo $_POST['StartTime'];
// echo $_POST['EndTime'];
// echo $_POST['TextBox'];

include('./link.php');

$sql = $db->prepare('insert into works(Name,DealWith,TimeNow,StartTime,EndTime,TextBox) values(:name,:deal,:timenow,:start,:end,:text)');

$sql->bindValue('name', $_POST['name']);
$sql->bindValue('deal', $_POST['DealWith']);
$sql->bindValue('timenow', $_POST['TimeNow']);
$sql->bindValue('start', $_POST['StartTime']);
$sql->bindValue('end', $_POST['EndTime']);
$sql->bindValue('text', $_POST['TextBox']);


$sql->execute();
header('location:./draggable.php');
