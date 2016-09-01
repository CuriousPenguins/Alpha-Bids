<?php
global $_POST,$_GET,$_SESSION,$_FILES;
if(count($_SESSION)>0){
	foreach ($_SESSION as $key=>$value)
	{
		getpost_ifset($key);
	}
} 
reset ($_FILES);
while (list ($key, $val) = each ($_FILES)) {
   ${$key}=$_FILES[$key]['tmp_name'];
   while (list ($key1, $val1) = each ($val)) {
       ${$key."_".$key1}=$_FILES[$key][$key1];
   }
} 
foreach ($_POST as $key=>$value)
{
	getpost_ifset($key);
}
foreach ($_GET as $key=>$value)
{
	getpost_ifset($key);
}
function getpost_ifset($test_vars) 
{ 
    if (!is_array($test_vars)) 
    { 
        $test_vars = array($test_vars); 
    } 
         
   foreach($test_vars as $test_var) 
   { 
      if (isset($_POST[$test_var])) 
	  { 
         global $$test_var; 
         $$test_var = $_POST[$test_var]; 
      } 
      elseif(isset($_GET[$test_var])) 
      { 
         global $$test_var; 
         $$test_var = $_GET[$test_var]; 
      } 
      elseif(isset($_SESSION[$test_var])) 
      { 
          global $$test_var; 
          $$test_var = $_SESSION[$test_var]; 
      }             
   }
}
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("config.php");

$link=mysql_connect($DB_HOST,$DB_USER,$DB_PSWD);

if ( ! $link) 
 	die ("Database could not be opened");

mysql_select_db($DB_NAME,$link) 
	or die ("Could not open databsase:".mysql_error() );

class admin
{
var $error;
var $loginpage="index.php"; //Where user would be redirected in case of login failure
var $user_id =0;
var $canpublish;
function authenticate($username,$password)
{
		
$sql="select * from admin_users where adminUsrName =\"$username\" and adminUsrPswd = \"$password\" ";
					
$recordset=mysql_query($sql);
	
		if ( ! $recordset)
			{	
			$this->error="Could not execute query ".mysql_error();
			return false;
			}	
	
		if (mysql_num_rows($recordset) > 0 )
			{
			$row = mysql_fetch_array($recordset);
			$this->user_id=$row[0];
			return true;
			}
		else
			{
			$this->error="Invalid Username / Password";
			return false;
			}
	}
	
		
}


function db_error($skip_on_error)
{
	echo "<font face='verdana' size='2' color='#000000'><b>Following error was found while completing your request:<br><br></font>";
	echo "<font face='verdana' size='2' color='#cc0000'> &nbsp;&nbsp; &nbsp;&nbsp;<b>".mysql_error(). "</b></Font><br><br>";
}

function show_msg($txt_msg)
{
	
	$txt_msg = " <font size='1' face=verdana color='#125C86'><b>&nbsp;$txt_msg";
	echo "<script language='javascript'>parent.document.all.status_msg.innerHTML=\"$txt_msg\"</script>";
	
}

function getmysqldate($dt)
{
$dtarray = explode ('/',$dt);
if ($dtarray[0] > 12)
   return -1;

if ($dtarray[1] > 31)
   return -1;

$dt = $dtarray[2]."-".$dtarray[0]."-".$dtarray[1];

return $dt;
}

function getusdatetime($dt)
{
$dttime_array = explode(' ',$dt);
$dtarray = explode ('-',$dttime_array[0]);
$dt = $dtarray[1]."/".$dtarray[2]."/".$dtarray[0];
return $dt;
}	

function check_security()
{
global $adminlogged_in;
if (!session_is_registered (adminlogged_in))
	{
	echo "<script language='javascript'>";
	echo "location.href='index.php?msg=Session Expired';";
	echo "</script>";
	exit;
	}
}

function redirect($url){
?>
	<script language='javascript'>
		location.href='<?=$url?>';
	</script>
<?
}

function getElmInArray($ElementArray,$ElementToFind){
	if($ElementArray!=""){
		foreach($ElementArray as $val){
			if($val==$ElementToFind)
				return true;
		}
	}
	return false;
}

function iif($bool,$var1,$var2)
{
	if($bool)
		return $var1;
	else 
		return $var2;
}

?>
