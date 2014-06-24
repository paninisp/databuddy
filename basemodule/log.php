<?php
//error_reporting(E_ALL);
//ini_set('display_errors','1');

require_once 'connectDB.php';

if(isset($_GET['action']) && $_GET['action'] == "login") {
	$USERID = $_POST['userid'];
	$PWD = $_POST['pwd'];
	$USERID=mysql_escape_string($USERID); 
	$PWD=mysql_escape_string($PWD); 
	$result = mysql_query("SELECT * FROM Employees WHERE Login='$USERID' AND Current='1'");

	if(mysql_num_rows($result) == 1) {

		$data = mysql_fetch_array($result);
		if(md5($PWD) == $data['Password']) { 
			if(isset($_POST['rememberme'])){
				setcookie('userid', $_POST['userid'], time()+60*60*24*30);
				setcookie('password', md5($PWD), time()+60*60*24*30);
			} else{
				setcookie('userid', $_POST['userid']);
				setcookie('password', md5($PWD));
			}
			$EMPLOYEEID=$data['EmployeeId'];
			$PERSONID=$data['PersonId'];
			
		} else {
			header("Location: login.php?login=failed&cause=".urlencode('Wrong Password'));
			exit;
		}
	} else {
		header("Location: login.php?login=failed&cause=".urlencode('Invalid User'));
		exit;
	}
}else if(isset($_COOKIE['userid']) && isset($_COOKIE['password'])) {
	$USERID=$_COOKIE['userid'];
	$result = mysql_query("SELECT * FROM Employees WHERE Login='$USERID'");

	if(mysql_num_rows($result) == 1){
		$data = mysql_fetch_array($result);
		if($_COOKIE['password'] == $data['Password']){
			$EMPLOYEEID=$data['EmployeeId'];
			$PERSONID=$data['PersonId'];
		}else{
			header("Location: login.php");
		}
	}else{
	header("Location: login.php");
	}
}else{
	header("Location: login.php");
}

if(isset($_GET['action']) &&  $_GET['action'] == "logout") {
	setcookie('userid', '', false);
	setcookie('password', '', false);
	
	header("Location: login.php?cause=".urlencode('Logged Out'));
	exit;
}



function dateFromDB($date){
	$d=explode("-",$date);
	$date=$d[1]."/".$d[2]."/".$d[0];
	return $date;
}

function dateFromForm($date){
	$d=explode("/",$date);
	if(strlen($d[2])==2){
		date("Y")-(date("y")%2000)+$d[2];
	};
	$date=$d[2]."-".$d[0]."-".$d[1];
	return $date;
}
?>