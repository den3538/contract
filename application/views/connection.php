<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'accounting');
if ($mysqli->connect_errno) {

    echo "Извините, возникла проблема на сайте";
    echo "Ошибка: Не удалсь создать соединение с базой MySQL и вот почему: \n";
    echo "Номер_ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}