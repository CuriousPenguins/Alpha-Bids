<?
session_start();
header ("Pragma: no-cache");
header ("Cache-Control: no-cache, must-revalidate, max_age=0");
header ("Expires: 0");
include("include/connection.inc.php");
show_msg("");
check_security();
?>
<html>
<?
include("include/header.php");
?>
<head>
<Script Language='JavaScript' src='admin.js'></Script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bgcolor="#ffffff" onload="setheight()">
<?
include("include/top.php");
?>
<br>
<table width='100%' height='100%' align="center" cellpadding="4" cellspacing="4">
<tr><td class="directory_link" style="border:1px solid #00135F;">
	<a href='ad_links.php'>Current Ad Links</a>&nbsp;&nbsp;
	<a href='ad_links.php?Call=add'>Add New Ad Links</a>&nbsp;&nbsp;
</td></tr>
<tr><td height='100%'><br>
<?
switch($Call)
{
case "":
	showAdLinks();
	break;
case "add":
	addAdLinks();
	break;
case "Save":
	saveAdLinks();
	break;
case "edit":
	editAdLinks();
	break;
case "Update":
	updateAdLinks();
	break;
case "Delete":
	deleteAdLinks();
	break;	
}

function showAdLinks()
{
	?>
	<table width='90%' cellspacing='3' cellpadding='3' border='0' style="border:1px solid #00135F" align='center' id="data_table">
	<tr align='center'><td width='50%' align='left' class='theader'>Ad Link Title</td><td width='50%' class='theader'>Action</td></tr>
	<?
	$query = "select a.* from ad_links as a order by linkTitle";
	$rs=mysql_query($query);
	while($rec = mysql_fetch_array($rs))
	{
		echo "<tr><td class='directory_link'><a href='ad_links.php?Call=edit&linkid=$rec[linkID]' class='links'>" . stripslashes($rec[linkTitle]) . "</a></td><td align='center' class='directory_link'><a href='ad_links.php?Call=edit&linkid=$rec[linkID]'>Edit</a>&nbsp|&nbsp;<a href='ad_links.php?Call=Delete&linkid=$rec[linkID]' onclick=\"return(confirm('Are You Sure to Delete this Record ?'));\">Delete</a></td></tr>";
	}
	echo "<tr><td colspan='4'></td></tr>";
}

function addAdLinks()
{	
	?>
	<form name='frmaddad_links' action='ad_links.php' method='post' enctype='multipart/form-data' onsubmit="return validate_frmad_links();">
	<table width='60%' style="border:1px solid #00135F" align='center' cellspacing='3' cellpadding='3' border='0' id="data_table">
	<tr><td colspan='2' class='theader'>Add Ad Link</td></tr>
	<tr><td width="40%" class='title'>Ad Link Title:</td><td><input type='text' name='linkTitle' id='linkTitle' size="50">&nbsp;(required)</td></tr>
	<tr><td colspan='2' align='center'><input type='submit' value='Save' name="Call" id='Call'></td></tr>
	</table>
	</form>
	<?
	getJsScript();
}

function saveAdLinks()
{
	global $linkTitle;
	
	$linkTitle = addslashes($linkTitle);
	
	mysql_query("insert into ad_links values('','$linkTitle')") or die(mysql_error());

	show_msg("Ad Links Added Successfully");
	
	showAdLinks();
}

function editAdLinks()
{	
	global $linkid;
	$res = mysql_query("select * from ad_links where linkID = '$linkid'") or die("Query could not be executed.".mysql_error());
	$row_res = mysql_fetch_array($res);
	?>
	<form name='frmeditad_links' action='ad_links.php' method='post' enctype='multipart/form-data' onsubmit="return validate_frmad_links();">
	<input type='hidden' name='linkid' id='linkid' value='<?=$linkid?>'>
	<table width='60%' style="border:1px solid #00135F" align='center' cellspacing='3' cellpadding='3' border='0' id="data_table">
	<tr><td colspan='2' class='theader'>Edit Ad Link</td></tr>
	<tr><td width="40%" class='title'>Ad Link Title:</td><td><input type='text' name='linkTitle' id='linkTitle' size="50" value="<?=stripslashes($row_res["linkTitle"])?>">&nbsp;(required)</td></tr>
	<tr><td colspan='2' align='center'><input type='submit' value='Update' name="Call" id='Call'></td></tr>
	</table>
	</form>
	<?
	getJsScript();
}

function updateAdLinks()
{
	global $linkid,$linkTitle;
	
	$linkTitle = addslashes($linkTitle);
	
	mysql_query("update ad_links set linkTitle='$linkTitle' where linkID='$linkid'") or die(mysql_error());

	show_msg("Ad Links updated Successfully");
	
	showAdLinks();
}

function deleteAdLinks(){
	global $linkid;

	mysql_query("delete from ad_links where linkID='$linkid'") or die(mysql_error());
		
	show_msg("Ad Link Deleted Successfully");
	
	showAdLinks();

}

function getJsScript(){
?>
<script language='javascript'>
	function validate_frmad_links(){
		var elmName = document.getElementById("linkTitle");
		if(elmName.value == ""){
			alert("Enter Ad Link Title");
			elmName.focus();
			return false;
		}
	}
</script>
<?
}
?>
</td></tr>
</table>
<?include("include/footer.php");?>
</body>
</HTML>