<?php

// echo $_GET['value'];


include('./link.php');

$sql = $db->prepare('delete from works where Name=:name');

$sql->bindValue('name', $_GET['value']);

$sql->execute();
header('location:./draggable.php');
