<?php

$dsn = 'mysql:host=db;port=3306;dbname=demo';
$user = 'demo';
$pass = 'demo';

$dbh = new PDO($dsn, $user, $pass);

function query($sql, $bindings){
    global $dbh;
    $req = $dbh->prepare($sql);
    $req->execute($bindings);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}