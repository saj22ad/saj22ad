<?php
$link = mysqli_connect('localhost:3306','root','');
mysqli_select_db($link,'data');
$stmt=mysqli_prepare($link,'delete from project where id=?');
$id= (int) $_GET['id'];
mysqli_stmt_bind_param($stmt,'i',$id);
mysqli_stmt_execute($stmt);

header('location: /');

