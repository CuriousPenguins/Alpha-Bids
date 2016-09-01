<?php
session_start();
include("include/connection.inc.php"); // includes connection as well as class admin
$admin = new admin();
$username=$_POST[username];
$password=$_POST[password];
$response=$admin->authenticate($username,$password);
if ($response==1)
{
		session_register("adminlogged_in");
		$_SESSION["adminlogged_in"]=true;
		session_register("user_id");
		$_SESSION["user_id"]=$admin->user_id;
		header("Location:main.php");
		}
		else
		{
			header("Location: index.php?msg=$admin->error");
		}
		
?>