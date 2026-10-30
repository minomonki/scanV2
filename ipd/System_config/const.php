<?php
//################################################ ###########
//######################## Constant value ########################
//############################################################
date_default_timezone_set("Asia/Bangkok");
$appname="";
$startyr="2551";
$curyr=date("Y")+543;
//if (date("m")=='10'){$setyr=date("Y")+543+1;}else{$setyr=date("Y")+543;}
//$setyr="2551";
//echo $setyr;
$now = date("Y-m-d H:i:s");
$today = date("d-m")."-".$curyr;
$today2 = $curyr."-".date("m-d");
$today3 = $curyr.date("md");

$month=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

$f=basename($_SERVER['REQUEST_URI']);
$fn=strpos($f,".");
$filename=substr($f,0,$fn);
//echo $f.", ".$fn.", ".$filename;
$exportdir="../exportfile";

//default display per page
$perPage = 20;//5
$arrnum=array("1","2","3","4","5","6","7","8","9");

$logtype_array=array(1=>'Login',2=>'Logout',3=>'Error Login',4=>'HosXP',5=>'Bypass',6=>'Login ipdl',7=>'Logout ipdl');
$logtypes_array=array(1=>'I',2=>'O',3=>'E',4=>'N',5=>'B',6=>'L',7=>'Q'); //quit
$pcode_array=array(1=>'View',2=>'Print',3=>'Save as',4=>'Add',5=>'Update',6=>'Delete',7=>'Alter',8=>'Forbidden',9=>'Print all',10=>"Export");
$pcodes_array=array(1=>'V',2=>'P',3=>'S',4=>'A',5=>'U',6=>'D',7=>'AL',8=>'F',9=>'PA',10=>'E');

//################################################ ###########
//###########################################################
//###########################################################
?>

