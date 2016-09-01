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
	<a href='banner.php'>Current Ad Banners</a>&nbsp;&nbsp;
	<a href='banner.php?Call=add'>Add New Ad Banner</a>&nbsp;&nbsp;
</td></tr>
<tr><td height='100%'><br>
<?
switch($Call)
{
case "":
	showAdBanners();
	break;
case "add":
	addAdBanners();
	break;
case "Save":
	saveAdBanners();
	break;
case "edit":
	editAdBanners();
	break;
case "Update":
	updateAdBanners();
	break;
case "Delete":
	deleteAdBanners();
	break;
}

function showAdBanners()
{
	?>
	<table width='90%' cellspacing='3' cellpadding='3' border='0' style="border:1px solid #00135F" align='center' id="data_table">
	<tr align='center'><td width='50%' align='left' class='theader'>Banner</td><td width='50%' class='theader'>Action</td></tr>
	<?
	$query = "select a.* from ad_banner as a order by bannerID";
	$rs=mysql_query($query);
	while($rec = mysql_fetch_array($rs))
	{
		echo "<tr><td class='directory_link'><a href='banner.php?Call=edit&bannerid=$rec[bannerID]' class='links'><img src='../img/" . $rec[bannerImage] . "' border=0></a></td><td align='center' class='directory_link'><a href='banner.php?Call=edit&bannerid=$rec[bannerID]'>Edit</a>&nbsp|&nbsp;<a href='banner.php?Call=Delete&bannerid=$rec[bannerID]' onclick=\"return(confirm('Are You Sure to Delete this Record ?'));\">Delete</a></td></tr>";
	}
	echo "<tr><td colspan='4'></td></tr>";
}

function addAdBanners()
{	
	?>
	<form name='frmaddad_banners' action='banner.php' method='post' enctype='multipart/form-data'>
	<table width='60%' style="border:1px solid #00135F" align='center' cellspacing='3' cellpadding='3' border='0' id="data_table">
	<tr><td colspan='2' class='theader'>Add Banner</td></tr>
	<tr><td width="40%" class='title'>Upload Banner:</td><td><input type='file' name='bannerImage' id='bannerImage' size="40"></td></tr>
	<tr><td colspan='2' align='center'><input type='submit' value='Save' name="Call" id='Call'></td></tr>
	</table>
	</form>
	<?
}

function saveAdBanners()
{
	global $bannerImage,$bannerImage_name,$_FILES;
	
	if($bannerImage_name<>""){
		mysql_query("insert into ad_banner values('','')") or die(mysql_error());
		$id = mysql_insert_id();
		$image_name=str_replace(" ","_",$bannerImage_name);
		$image_name=$id."_".$image_name;
		$imagePath = "../img/";
		copy($bannerImage,$imagePath.$image_name);
		mysql_query("update ad_banner set bannerImage='$image_name' where bannerID='$id'") or die(mysql_query());
		show_msg("Ad Banner Added Successfully");
	}
	else
	{
		show_msg("Ad Banner Not Added Successfully");
	}
	
	showAdBanners();
}

function editAdBanners()
{	
	global $bannerid;
	$res = mysql_query("select * from ad_banner where bannerID = '$bannerid'") or die("Query could not be executed.".mysql_error());
	$row_res = mysql_fetch_array($res);
	?>
	<form name='frmeditad_banners' action='banner.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='bannerid' id='bannerid' value='<?=$bannerid?>'>
	<table width='60%' style="border:1px solid #00135F" align='center' cellspacing='3' cellpadding='3' border='0' id="data_table">
	<tr><td colspan='2' class='theader'>Edit Banner</td></tr>
	<tr><td width="40%" class='title'>Upload Banner:</td><td><input type='file' name='bannerImage' id='bannerImage' size="40"></td></tr>
	<tr><td colspan='2' align='center'><input type='submit' value='Update' name="Call" id='Call'></td></tr>
	</table>
	</form>
	<?
}

function updateAdBanners()
{
	global $bannerid,$bannerImage,$bannerImage_name,$_FILES;
	
	if($bannerImage_name<>""){
		$rs = mysql_query("select bannerImage from ad_banner where bannerID='$bannerid'") or die(mysql_error());
		$row = mysql_fetch_array($rs);
		if($row[bannerImage]<>"")
			unlink("../img/$row[bannerImage]");
		$image_name=str_replace(" ","_",$bannerImage_name);
		$image_name=$bannerid."_".$image_name;
		$imagePath = "../img/";
		copy($bannerImage,$imagePath.$image_name);
		mysql_query("update ad_banner set bannerImage='$image_name' where bannerID='$bannerid'") or die(mysql_query());
	}

	show_msg("Ad Banner updated Successfully");
	
	showAdBanners();
}

function deleteAdBanners(){
	global $bannerid;

	$rs = mysql_query("select bannerImage from ad_banner where bannerID='$bannerid'") or die(mysql_error());
	$row = mysql_fetch_array($rs);
	if($row[bannerImage]<>"")
			unlink("../img/$row[bannerImage]");
			
	mysql_query("delete from ad_banner where bannerID='$bannerid'") or die(mysql_error());
		
	show_msg("Ad Banner Deleted Successfully");
	
	showAdBanners();

}

?>
</td></tr>
</table>
<?include("include/footer.php");?>
</body>
</HTML>