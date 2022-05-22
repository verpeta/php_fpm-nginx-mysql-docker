<?php

$pdo = new PDO('mysql:dbname=demo;host=demo-mysql', 'root', 'root');

$sql = 'select @@version';

$stmt = $pdo->prepare($sql);
$stmt->execute();

print_r($stmt->fetchAll());
