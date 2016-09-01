<?
session_start();
header ("Pragma: no-cache");
header ("Cache-Control: no-cache, must-revalidate, max_age=0");
header ("Expires: 0");
include("include/connection.inc.php");
check_security();
show_msg("");
?>
<html>
<?
include("include/header.php");
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bgcolor="#ffffff" onload="setheight()">
<?
include("include/top.php");
?>
		<table width='80%' height='100%' style="border:1px solid #00135F" align="center">
			<tr><td  class='theader'>Admin Profile</td></tr><BR>
				<tr><td>
				
	<?			
				
switch($Call) 
	{
	case "":
	showform();
	break;

	case "savesettings":
	savesettings();
	break;
	}

function showform()
{
global $PHP_SELF,$user_id;

$rs  = mysql_query("select * from admin_users where adminUsrID='$user_id'") or $dberror=true;
if ($dberror)
	db_error(true);

$row= mysql_fetch_array($rs);
?>
<form name="settings" action="<?=$PHP_SELF?>" method='post' onsubmit="return validate_adminprofile(settings);">
<table width='65%' border='0' cellspacing='4' cellpadding='2' align='center' id="data_table">
<Input type='hidden' name='Call' id='Call' value='savesettings'>

<tr><td class='title'>User Name:</td><td><input name="username" id='username'  type='text' maxlength='16' size='17' value="<?=$row[adminUsrName]?>">&nbsp;(required)</td></tr>

<tr><td class='title'>Old Password:</td><td><input name="oldpass" id='oldpass'  type='password' maxlength='16' size='17'></td></tr>
<tr><td class='title'>New Password:</td><td><input name='newpass' id='newpass' type='password' maxlength='16' size='17'></td></tr>
<tr><td class='title'>Retype New Password:</td><td><input name='repass' id='repass' type='password' maxlength='16' size='17'></td></tr>
<tr><td class='title'>Administrator's Email Address:</td><td><input name ='email' id='email' type='text' size='40' value="<?=$row[adminUsrEmail]?>">&nbsp;(required)</td></tr>
<tr><td>&nbsp;</td><td ><input type='submit' value='Apply Changes'>&nbsp;</tr>
</table>
</form>
<?
}

function savesettings()
{
global $oldpass,$newpass,$repass,$email,$user_id,$username;
if($oldpass == ""){
	mysql_query("Update admin_users set adminUsrName=\"$username\",adminUsrEmail = \"$email\" where adminUsrID='$user_id'") or $dberror=true;
	if ($dberror)
		db_error(false);
	else
		show_msg("Admin Profile updated successfully.",0,false);
}
else
{
	if($newpass != ""){
		if($newpass != $repass){
			show_msg("Retype New Password Correctly");
			showform();
			exit;
		}
		else
		{
			$rs = mysql_query("select * from admin_users where adminUsrID='$user_id'") or $dberror=true;
			if ($dberror)
				db_error(true);
			else
			{
				$row= mysql_fetch_array($rs);
				if($oldpass != $row[adminUsrPswd]){
					show_msg("Please Enter Old Password Correctly");
					showform();
					exit;	
				}
				else
				{
					mysql_query("Update admin_users set adminUsrName=\"$username\",adminUsrPswd = \"$newpass\",adminUsrEmail = \"$email\" where adminUsrID='$user_id'") or $dberror=true;
					if ($dberror)
						db_error(false);
					else
						show_msg("Admin Profile updated successfully.",0,false);
				}			
			}
		}
	}
}
showform();
}

?>
	</td></tr>
			</table>
			<? include("include/footer.php"); ?>
	</body>

