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
<? if($Call=="edit"){ ?>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
		mode : "exact",
		theme : "advanced",
		elements : "content",
		plugins : "table,advhr,advdoc,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print",
		theme_advanced_buttons1_add_before : "",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advdoc,advhr,separator,print",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "../front.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "a[name|href|target|title|onclick|class],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js"
		//file_browser_callback : "fileBrowserCallBack"
	});

	function fileBrowserCallBack(field_name, url, type) {
		// This is where you insert your custom filebrowser logic
		
		alert("Filebrowser callback: " + field_name + "," + url + "," + type);
	}
</script>
<!-- /tinyMCE -->
<? } ?>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" onload="setheight()">
<?
include("include/top.php");
?>
<br>
<table width='100%' height='100%' style="border:1px solid #00135F" align="center">
<tr><td class="directory_link" align="right">
	<a href='files.php'>Current Files</a>&nbsp;&nbsp;
</td></tr>
<tr bgcolor="#00135F"><td height="1"></td></tr>
<tr><td height='100%'><br>
<?
switch ($Call)
		{	
			case "":
				showdashboard('');
				break;
			case "edit":
				editfile();
				break;
			case "updatecontent":
				updatecontent();
				break;
		}

function showdashboard($msg)
{
	global $lang_id,$cmtfiles;
	global $canpublish;
?>
	<script language ='JavaScript'>
	value=0;
	function setval(num)
	{
		value=num;
	}

	function confirmSelection()
	{
		if (value==1){msg="Are you sure you want to undo the changes made in selected file(s)";}
		else{msg="Are you sure?";}
		response=confirm(msg);
		if (response == true ){return true}; else {return false;}
	}
	</Script>
<?php
print "<form name='dashboard' action='files.php' method='post'>";
print "<table width='100%' cellspacing='1' cellpadding='1'  border='0' align='center' id='data_table'>";
print "<tr><td align='center'>Select A Page: <select name='files' onchange='location.href=this.value;'><option value='' selected>----Select Page----</option>";
$rs=mysql_query("select filename,file_id from cmsfiles") or die(mysql_error());
while($a_row=mysql_fetch_array($rs))
{
	print "<option value='files.php?Call=edit&file_id=$a_row[file_id]'>$a_row[filename]</option>";
}
print "</select></td></tr>";
print "</table>";
print "</form>";
}

function javascript()
{
?>
	<script>
	function setWidth(Text)
	{
		Text.style.width=((Text.value.length*7)==0) ? 2 : ((Text.value.length*7)>399) ? 399 : (Text.value.length*7);
		
	}
	function check_page(frm)
	{
		intarraylen = frm.length;
		for(i=0;i<intarraylen;i++)
		{
			field_name = frm.elements[i].name;
			if(field_name == "filename"){
				if(frm.filename.value=="")
				{
					alert("Enter A File Name");
					frm.filename.focus();
					return false;
				}
				else
				{
					tempstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_";
					var val = frm.filename.value;
					var len = val.length;
					for(i=0;i<len;i++){
						var ch = val.charAt(i);
						if(tempstr.indexOf(ch) == -1){
							alert("No Space Or Special Character Allowed Except Underscore ( _ )");
							frm.filename.focus();
							return false;
						}
					}
				}
			}
		}
		if(frm.title.value=="")
		{
			alert("Enter A Title");
			frm.title.focus();
			return false;
		}
	}
	</script>
<?
}

function editfile()
{
	global $file_id,$user_id,$lang_id,$msg;
	$sql="select * from cmsfiles where file_id='$file_id'";
	$row=mysql_fetch_array(mysql_query($sql));
	javascript();
	if($msg==1)
	{
		print "<font face='arial' size='2' color='#FF0000'>Please Enter Title";
	}

?>
	<form name='content_edit' method='post' action='files.php'>
	<input type='hidden' name='Call' value='updatecontent'>
	<input type='hidden' name='file_id' value='<?=$file_id?>'>
	<table width=100% cellspacing=1 border=0>
	    <tr><td><font color='#cc4444'><b>* Required</b></font></td></tr>
	    <tr><td>&nbsp;</td></tr>
		<tr><td COLSPAN=1><label for="title">Title<font color='#cc4444'>*</font></label></td><td><input id='title' value="<?=stripslashes($row[title])?>" name=title></td></tr>
		<tr><td COLSPAN=1><label for="description">Description<font color='#cc4444'>*</font></td><td><input id='description' value="<?=stripslashes($row[meta_desc])?>" name=description size=80></td></tr>
		<tr><td COLSPAN=1><label for="keywords">Keywords<font color='#cc4444'>*</font></td><td><input id='keywords' value="<?=stripslashes($row[meta_keywords])?>" name=keywords size=80></td></tr>
	</table>
	<br>
	<table width='100%' align='center' cellspacing='0' border='0'>
	<tr id='table_header'><td>
	  Filename: <?=$row[filename]?>&nbsp;&nbsp;&nbsp;&nbsp;
	</td></tr>
	<tr><td colspan='2' align=center valign=top height='410'>
	<textarea style="width:100%;height:400px" name=content id=content><?=stripslashes($row[content])?></textarea>
	</td></tr>
	<tr><td><br><input type=submit value="Update" class='btnsub' onclick="return check_page(this.form);" title='Update'>
	</table> 
</form>
<?
}

function updatecontent()
{
	global $title,$canpublish,$file_id;
	global $description,$keywords,$user_id,$content;
	$content = addslashes($content);
	$title = addslashes($title);
	$keywords = addslashes($keywords);
	$description = addslashes($description);
	
	$sql = "update cmsfiles set content = '$content', meta_desc='$description',meta_keywords='$keywords',title='$title' where file_id='$file_id'";
	
	$recordset=mysql_query($sql);
	if (! $recordset)
		show_msg("Could not make changes - ".mysql_error());
	else
		show_msg("File updated successfully - ".$filename);
	showdashboard('');
}

function getJsScript(){
?>

<?
}
?>
</td></tr>
</table>
<?include("include/footer.php");?>
</body>
</HTML>