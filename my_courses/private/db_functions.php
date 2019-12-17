<?php

function db_connect()
{
    try {

        $con = new PDO(DSN, DB_USER, DB_PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (Exception $ex) {
        exit("فشل الاتصال بقاعدة البيانات " . $ex->getMessage());
    }
    return $con;
}


function db_disconnect($connection)
{

    if (isset($connection)) {
        $connection = null;
    }
}
