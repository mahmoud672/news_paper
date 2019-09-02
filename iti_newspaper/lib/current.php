<?php
session_start();
header("content-type:application/json");
$data=array('id'=>$_SESSION['id'],'job_type'=>$_SESSION['job_type'],'email'=>$_SESSION['email']);
echo json_encode($data);
exit(0);