<!DOCTYPE html>
<html>
<head>
	<title>Process</title>
</head>
<body>
<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$id=0;
$update=false;
$name='';
$location='';
// $con = mysqli_connect('localhost','root','','crud');
$mysqli= new mysqli('localhost','root','','crud') or die(mysqli_errno($mysqli));

if(isset($_POST['save'])){
	$name=$_POST['name'];
	$location=$_POST['location'];

	$mysqli->query("INSERT into data (name,location)  VALUES ('$name','$location') ") or die($mysqli->error);

	$_SESSION['message']="Record has been saved!";
	$_SESSION['msg_type']="success";

	header('location: index.php');
}

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$mysqli -> query("DELETE FROM data  WHERE id=$id") or die($mysqli->error);

	$_SESSION['message']="Record has been deleted!";
	$_SESSION['msg_type']="danger";
	 header('location: index.php');
}


if(isset($_GET['edit'])){
	$id=$_GET['edit'];
	$update=true;
	$res = $mysqli-> query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);

	if(count($res)==1){
		$row=$res->fetch_array(); // or fetch_assoc(); both are working
		$name=$row['name'];
		$location=$row['location'];
	}

}

if(isset($_POST['update'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$location=$_POST['location'];

	$mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id ") or die($mysqli->error);

	$_SESSION['message']="Record has been Updated!";
	$_SESSION['msg_type']="warning ";

	header('location: index.php');
}

?>
</body>
</html>
