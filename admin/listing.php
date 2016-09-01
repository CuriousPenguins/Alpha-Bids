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
	<a href='listing.php'>Current Listing</a>&nbsp;&nbsp;
	<a href='listing.php?Call=add'>Add New Listing</a>&nbsp;&nbsp;
</td></tr>
<tr><td height='100%'><br>
<?
switch($Call)
{
case "":
	showlisting();
	break;
case "add":
	addlisting();
	break;
case "save":
	savelisting();
	break;
case "edit":
	editlisting();
	break;
case "Update":
	updatelisting();
	break;
case "Delete":
	deletelisting();
	break;
case "setorder":
	setorder();
	break;
case "saveorder":
	saveorder();
	break;
case "enable":
	enableListing();
	break;
case "disable":
	disableListing();
	break;
}

function showlisting()
{
	$activeStatus = "<font size='4' color='green'>!</font>";
        $deactiveStatus = "<font size='4' color='red'>!</font>";
	?>
	<form name='changeListstatus' action='listing.php' method='post' enctype='multipart/form-data' onsubmit="return checkboxListSelection();">
        <input type='hidden' name='Call' value=''>
	<table width='98%' cellspacing='3' cellpadding='3' border='0' style="border:1px solid #00135F" align='center' id="data_table">
	<tr align='right'><td colspan="6"><?=$activeStatus?> - Enabled Listing&nbsp;&nbsp;&nbsp;<?=$deactiveStatus?> - Disabled Listing</td></tr> 
	<tr align='center'><td class='theader'>&nbsp;</td><td class='theader'>&nbsp;</td><td width='25%' align='left' class='theader'>Title</td><td width='45%' align='left' class='theader'>Website URL</td><td width='12%' align='left' class='theader'>Current Bid</td><td width='15%' class='theader'>Action</td></tr>
	<?
	$bool = false;
	$query = "select a.* from listing as a order by title";
	$rs=mysql_query($query);
	while($rec = mysql_fetch_array($rs))
	{
		echo "<tr><td>". iif($rec[listStatus]=="1",$activeStatus,$deactiveStatus) ."</td><td><input type='checkbox' name='chk[]' value='$rec[listID]'></td><td class='directory_link'><a href='listing.php?Call=edit&listid=$rec[listID]' class='links'>" . stripslashes($rec[title]) . "</a></td>";
		echo "<td class='directory_link'><a href='$rec[siteUrl]' class='links' target='_blank'>" . $rec[siteUrl] . "</a></td><td class='directory_link'>$" . sprintf("%.2f",$rec[currentBid]) . "</td>";
		echo "<td align='center' class='directory_link'><a href='listing.php?Call=edit&listid=$rec[listID]'>Edit</a>&nbsp|&nbsp;<a href='listing.php?Call=Delete&listid=$rec[listID]' onclick=\"return(confirm('Are You Sure to Delete this Record ?'));\">Delete</a></td></tr>";
		$bool = true;
	}
	echo "<tr><td colspan='6'></td></tr>";
	if($bool == true)
                echo "<tr><td colspan='6'><input type='submit' name='disable' value='Enable Selected' onclick=\"changeListstatus.Call.value='enable';\">&nbsp;&nbsp;<input type='submit' name='enable' value='Disable Selected' onclick=\"changeListstatus.Call.value='disable';\"></td></tr>";
        echo "</table>";
        ?>
        </form> 
        <script language='javascript'>
        function checkboxListSelection(){
                found = false;
                element = document.changeListstatus.elements['chk[]'];
                if(element.length==undefined){
                        if(element.checked)
                                found = true;
                }
                else
                {
                        for(i = 0; i < element.length; i++){
                                if(element[i].checked){ 
                                        found = true;
                                }
                        }
                }
                if(!found){
                        alert("Please Select Atleast One Listing."); 
                        return false;
                }
        }
        </script>
<?
}

function addlisting()
{	?>
	<form name='frmaddlisting' action='listing.php' method='post' enctype='multipart/form-data' onsubmit="return validate_frmlisting();">
	<input type='hidden' name='Call' id='Call' value='save'>
	<table width=64%' style="border:1px solid #00135F" align='center' cellspacing='3' cellpadding='3' border='0' id="data_table">
	<tr><td colspan='2' class='theader'>Add New Listing</td></tr>
	<tr><td width="40%" class='title'>Email Address:</td><td><input type='text' name='Email' id='Email' maxlength="255" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Website URL:</td><td><input type='text' name='siteUrl' maxlength="255" id='siteUrl' value="http://" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Title:</td><td><input type='text' name='title' id='title' maxlength="150"  size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Description line 1:</td><td><input type='text' maxlength="255"  name='description_1' id='description_1' size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Description line 2:</td><td><input type='text' maxlength="255"  name='description_2' id='description_2' size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Bid:</td><td>$<input type='text' name='bid' id='bid' size="10">.00&nbsp;(required)</td></tr>
	<tr><td colspan='2' align='center'><input type='submit' value='Add Listing'></td></tr>
	</table>
	</form>
	<?
	getJsScript();
}

function savelisting()
{
	global $title,$description_1,$description_2,$Email,$bid,$siteUrl;
	
	$title = addslashes($title);
	$description_1 = addslashes($description_1);
	$description_2 = addslashes($description_2);
	
	mysql_query("insert into listing values('','$Email','$title','$description_1','$description_2','$bid','$siteUrl',curdate(),curdate(),'1')") or die("Query could not be executed.".mysql_error());

	show_msg("New Listing Added Successfully");

	showlisting();
}

function editlisting()
{	
	global $listid;
	$res = mysql_query("select * from listing where listID = '$listid'") or die("Query could not be executed.".mysql_error());
	$row_res = mysql_fetch_array($res);
	?>
	<form name='frmeditlisting' action='listing.php' method='post' enctype='multipart/form-data' onsubmit="return validate_frmlisting();">
	<input type='hidden' name='listid' id='listid' value='<?=$listid?>'>
	<table width='64%' style="border:1px solid #00135F" align='center' cellspacing='3' cellpadding='3' border='0' id="data_table">
	<tr><td colspan='2' class='theader'>Edit Listing</td></tr>
	<tr><td width="40%" class='title'>Email Address:</td><td><input type='text' name='Email' id='Email' maxlength="255" value="<?=$row_res["email"]?>" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Website URL:</td><td><input type='text' name='siteUrl' maxlength="255" id='siteUrl'  value="<?=$row_res["siteUrl"]?>" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Title:</td><td><input type='text' name='title' id='title' maxlength="150"  value="<?=stripslashes($row_res["title"])?>" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Description line 1:</td><td><input type='text' maxlength="255"  name='description_1' id='description_1' value="<?=stripslashes($row_res["description_1"])?>" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Description line 2:</td><td><input type='text' maxlength="255"  name='description_2' id='description_2' value="<?=stripslashes($row_res["description_2"])?>" size="50">&nbsp;(required)</td></tr>
	<tr><td width="40%" class='title'>Bid:</td><td>$<input type='text' name='bid' id='bid' value="<?=$row_res["currentBid"]?>" size="10">.00&nbsp;(required)</td></tr>
	<tr><td colspan='2' align='center'><input type='submit' value='Update' name="Call" id='Call'></td></tr>
	</table>
	</form>
	<?
	getJsScript();
}

function updatelisting()
{
	global $listid,$title,$description_1,$description_2,$Email,$bid,$siteUrl;
	
	$title = addslashes($title);
	$description_1 = addslashes($description_1);
	$description_2 = addslashes($description_2);
	
	mysql_query("update listing set title='$title',description_1='$description_1',description_2='$description_2',email='$Email',currentBid='$bid',siteUrl='$siteUrl' where listID='$listid'") or die(mysql_error());

	show_msg("Listing updated Successfully");
	
	showlisting();
}


function deletelisting(){
	global $listid;

	mysql_query("delete from listing where listID='$listid'") or die(mysql_error());
		
	show_msg("Listing Deleted Successfully");
	
	showlisting();

}

function enableListing(){
	global $HTTP_POST_VARS;
	foreach ($HTTP_POST_VARS[chk] as $key=>$val){
		mysql_query("update listing set listStatus='1' where listID='$val'") or die (mysql_error());
	}	
	show_msg("Selected Listing Enabled Successfully");
	showlisting();
}

function disableListing(){
	global $HTTP_POST_VARS;
	foreach ($HTTP_POST_VARS[chk] as $key=>$val){
		mysql_query("update listing set listStatus='0' where listID='$val'") or die (mysql_error());
	}	
	show_msg("Selected Listing Disabled Successfully");
	showlisting();
}

function getJsScript(){
?>
<script language='javascript'>
	function validate_frmlisting(){
		var elmEmail = document.getElementById("Email");elmSite = document.getElementById("siteUrl");
		var elmDesc1 = document.getElementById("description_1");elmDesc2 = document.getElementById("description_2");
		var elmTitle = document.getElementById("title");elmBid = document.getElementById("bid");
		if(elmEmail.value == ""){
			alert("Enter A Email Address");
			elmEmail.focus();
			return false;
		}
		else
		{
			if(!validateEmail(elmEmail.value)){
				alert("Not A Valid Email Address");
				elmEmail.focus();
				return false;
			}
		}
		if(elmSite.value == "" || elmSite.value == "http://"){
			alert("Enter A Website URL");
			elmSite.focus();
			return false;
		}
		if(elmTitle.value == ""){
			alert("Enter A Title");
			elmTitle.focus();
			return false;
		}
		if(elmDesc1.value == ""){
			alert("Enter A Description Line 1");
			elmDesc1.focus();
			return false;
		}
		if(elmDesc2.value == ""){
			alert("Enter A Description Line 1");
			elmDesc2.focus();
			return false;
		}
		if(elmBid.value == ""){
			alert("Enter A Bid Amount");
			elmBid.focus();
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