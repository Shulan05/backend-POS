<?php
  $host = '127.0.0.1';
  $dbname ='webapp';
  $user ='root';
  $password='';

  $db = new mysqli($host, $user, $password,$dbname);
  if($db->connect_error){
    echo 'Connection failed.'.$db->connect_error;
    die();
  }
?>