<?php
session_start();
?>
<html><head>
<TITLE>Web Admin Panel </title>
<link rel='stylesheet' type='text/css' href='include/default.css'>
<Script language= 'JavaScript'>
function changePage()
	{
		if (window != top) top.location.href = location.href;

	}
</Script>
<script src='admin.js'></Script>
</head>
<body onLoad='changePage()'>
<table width='40%' align=center cellSpacing=5 cellPadding=5 border=0>
<?
global $msg;
if($msg != ""){
	echo "<tr><td align=center><font color=ff0000>$msg</font></td></tr>";
}
?>
<tr><td align=center valign=middle>
<table width='100%' align=center cellspacing=0 style="border:1px solid #00135F">
<form name = 'login' action = 'login.php' method='post' >
<th height="25" style="border:0px solid #C0C0C0">&nbsp;Web Admin Panel</th>
<tr><td valign=middle><table align=center>
	<tr><td colspan='2'>&nbsp;</td> </tr>	 
	<tr><td>User Name </td>  
	<td><input name='username' type =text>  </td>  	</tr>
	<tr><td>Password</td>
	<td><input name='password' type =password> </td></tr>
	<tr><td colspan='2'>&nbsp;</td> </tr>
	<tr><td colspan='2' align ='center'><input type=submit value="Login"></td></tr>
</table></td></tr>	
</form>
</table></td></tr>
</table>
</body>
</html>