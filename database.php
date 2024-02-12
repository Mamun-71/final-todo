<?php
$HOST = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DBNAME = 'todo';
$connection = new mysqli($HOST,$USERNAME,$PASSWORD,$DBNAME);

if ($connection->connect_error) {
  die("connect error: " . $connection->connect_error);
}

