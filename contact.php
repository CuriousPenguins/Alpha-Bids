<?
session_start();
include("admin/include/connection.inc.php");
include("admin/include/common.inc.php");
$CMS_PAGES_TITLE = getFileContent("contact.php","title");
$CMS_PAGES_META_KEYWORDS = getFileContent("contact.php","meta_keywords");
$CMS_PAGES_META_DESCRIPTION = getFileContent("contact.php","meta_desc");
include("admin/include/front_header.inc.php");
include("admin/include/submenu.inc.php");

if(isset($_POST["submit"]))
	saveForm();
else
	showForm();

include("admin/include/front_footer.inc.php");



function showForm(){
	global $LinkMapTo;
	
?>
	<div align="center" valign='top'> 
		<table border="0" class="listingMaintable" width="450" id="table1"> 
		<tr> 
			<td width="450"> 
			<?=getFileContent("contact.php","content")?>
			</td> 
		</tr>
		<tr height="5"><td></td></tr> 
		<tr> 
			<td width="450"> 
			<form method="post" name="pgfrm" onsubmit="return chkfrm();" action="<?=$LinkMapTo?>/contact/">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
			<tr> 
				<td width="147" height="28"><b><font size="2">Your e-mail address:</font></b></td> 
				<td height="28"><input type="text" id="email" name="email" size="34"></td> 
			</tr> 
			<tr> 
				<td width="147" valign="top" height="156"><font size="2"><b>Your Message:</b></font></td> 
				<td height="156"><textarea rows="9" id="msg" name="msg" cols="28"></textarea></td> 
			</tr> 
			<tr> 
				<td width="147">&nbsp;</td> 
				<td><input type="hidden" name="fsubmit" value="1"><input type="submit" name="submit" id="submit" class="button" value="Send message"></td> 
			</tr> 
			<tr> 
				<td width="147">&nbsp;</td> 
				<td>&nbsp;</td> 
			</tr> 
			</table>
			</form>
			<script language="javascript"> 
				function chkfrm() { var frm = document.pgfrm; if (!frm.email.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide an e-mail address."); frm.email.focus(); return false; } if (!validateEmail(frm.email.value)) { alert("Not a valid e-mail address."); frm.email.focus(); return false; } if (!frm.msg.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide a message."); frm.msg.focus(); return false; } } 
			</script> 
			</td> 
		</tr> 
		</table> 
	</div>

<?
}

function saveForm(){
	global $LinkMapTo,$EMAIL_Contact,$Domain_name;
	$email = $_POST["email"];
	$msg = $_POST["msg"];
	$content = $msg;
	$to= $EMAIL_Contact;
	$subject="New Enquiry Submitted";
	$from=$email;
	mail($to,$subject,$content,"From:$from\n"."Content-type: text/html");
	?>
	<div align="center" valign='top'> 
		<table border="0" class="listingMaintable" width="450" id="table1"> 
		<tr> 
			<td width="450"> 
				<table border="0" class="glow" cellpadding="0" cellspacing="0" width="100%" height="25"> 
				<tr> 
					<td> 
						<table border="0" cellpadding="5" cellspacing="5" width="100%"> 
						<tr> 
							<td><span style="font-size: 8pt"><b>Your message has been sent.<br> </b><br> Please note, due to the demand in support we are not able to reply to every question we receive.</span></td> 
						</tr> 
						</table> 
					</td> 
				</tr> 
				</table> 
			</td> 
		</tr> 
		<tr> 
			<td width="450"> 
				<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
				<tr> 
					<td> <input type="button" onclick="document.location.href='<?=$LinkMapTo?>/'" class="button" value="Return to <?=$Domain_name?>"></td> 
				</tr> 
				</table> 
			</td> 
		</tr>
		</table> 
	</div>
	<?
}

?>
