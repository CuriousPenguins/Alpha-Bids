<?
session_start();
include("admin/include/connection.inc.php");
include("admin/include/common.inc.php");
$CMS_PAGES_TITLE = getFileContent("buy_link.php","title");
$CMS_PAGES_META_KEYWORDS = getFileContent("buy_link.php","meta_keywords");
$CMS_PAGES_META_DESCRIPTION = getFileContent("buy_link.php","meta_desc");
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
		<form name=pgfrm onsubmit="return chkfrm();" action=<?=$LinkMapTo?>/buy_link/ method=post>
		<tr>
			<td width=450>
			<?=getFileContent("buy_link.php","content")?>
			</td>
		</tr>
		<tr height="5"><td></td></tr>
		<tr>
			<td width=450>
			<fieldset style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-bOTTOM: 2px; PADDING-TOP: 2px">
			<table style="bORDER-COLLAPSE: collapse" cellSpacing=5 cellPadding=5 width="100%" border=0>
			<tr>
				<td colspan=2><font style="font-SIZE: 8pt">before continuing, please take a minute to read our <a href="<?=$LinkMapTo?>/terms/" target=_blank>Terms of use</a>.</font></td>
			</tr>
			<tr>
				<td width=126><font size=2><b>E-mail Address:</b></font></td>
				<td><input maxlength="255" size=37 id="email" name="email"></td>
			</tr>
			<tr>
				<td width=126><b><font size=2>Website uRL:</font></b></td>
				<td><input size=37 maxlength="255" value=http:// name="url" id="url"></td>
			</tr>
			<tr>
				<td width=126><font size=2><b>Title</b></font><b><font size=2>:</font></b></td>
				<td><input onkeyup=dodiv(); maxlength="45" onblur=dodiv(); onchange=dodiv(); id="keyword" size=37 name=keyword> </td>
			</tr>
			<tr>
				<td width=126><b><font size=2>Description line 1:</font></b></td>
				<td><input onkeyup=dodiv(); maxlength="45" onchange=dodiv(); onblur=dodiv(); id="desc1" size=37 name=desc1></td>
			</tr>
			<tr>
				<td width=126><b><font size=2>Description line 2:</font></b></td>
				<td><input onkeyup=dodiv(); maxlength="45" onchange=dodiv(); onblur=dodiv(); size=37 id="desc2" name=desc2></td>
			</tr>
			<tr>
				<td width=126><b><font size=2>bid:</font></b></td>
				<td><b><font size=2>$</font></b><input onkeypress="return chknum(event)" onblur=dodiv(); onkeyup=dodiv(); onchange=dodiv(); id="bid" size=9 name=bid><font size=2><b>.00</b></font></td>
			</tr>
			<tr>
				<td vAlign=top colspan=2>
				<span style="font-SIZE: 8pt">The more you bid, the higher your link position will be. <font color=#026AFE>Minimum of $1 is required.</font></span>
				</td>
			</tr>
			</table>
			</fieldset> 
			</td>
		</tr>
		<tr>
			<td width=450>
			<fieldset style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-bOTTOM: 2px; PADDING-TOP: 2px">
			<legend><b><font color=#026AFE>Link Preview</font></b></legend>
			<table style="bORDER-COLLAPSE: collapse" cellSpacing=5 cellPadding=5 width="100%" border=0>
			<tr>
				<td vAlign=top width=50>
				<table height=33 cellSpacing=0 cellPadding=0 width=52 border=0>
				<tr>
					<td class="cb" vAlign=top align=middle><font style="font-SIZE: 8pt" color=#ffffff><b>
					<div id=bidd>$1</div></b></font>
					</td>
				</tr>
				</table>
				</td>
				<td><u><font size=4>
					<div id=kw>Title Sample</div></font></u><font color=#808080><span style="font-SIZE: 8pt">
					<div id=d1>Description line 1 sample</div></span></font><font color=#808080><span style="font-SIZE: 8pt">
					<div id=d2>Description line 2 sample</div></span></font>
				</td>
			</tr>
			</table>
			</fieldset>
			</td>
		</tr>
		<tr>
			<td width=450>
				<input type=hidden value=1 name=fsubmit> <input class=button style="FLOAT: right" name="submit" id="submit" type=submit value="Next Step >">
			</td>
		</tr>
		</form>
		</table>
		<script language=javascript> 
			function dodiv() { var frm = document.pgfrm; var tt=frm.keyword.value; var dd1=frm.desc1.value; var dd2=frm.desc2.value; var bbd=frm.bid.value; if (tt) { document.getElementById('kw').innerHTML=tt; } else {  document.getElementById('kw').innerHTML="Title Sample"; } if (dd1) { document.getElementById('d1').innerHTML=dd1; } else {  document.getElementById('d1').innerHTML="Description line 1 sample"; } if (dd2) { document.getElementById('d2').innerHTML=dd2; } else {  document.getElementById('d2').innerHTML="Description line 2 sample"; } if (bbd) { document.getElementById('bidd').innerHTML="$"+bbd; } else {  document.getElementById('bidd').innerHTML="$1"; } } 
			function chknum(evt) { var charCode = (evt.which) ? evt.which : event.keyCode; if (charCode > 31 && (charCode < 48 || charCode > 57)) return false; return true; } function chkfrm() { var frm = document.pgfrm; if (!frm.email.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide an e-mail address."); frm.email.focus(); return false; } if (!validateEmail(frm.email.value)) { alert("Not a valid e-mail address."); frm.email.focus(); return false; } if (!frm.url.value.replace(/^\s*|\s*$/g,"") || frm.url.value.replace(/^\s*|\s*$/g,"") == "http://") { alert("You must provide a website address."); frm.url.focus(); return false; } if (!frm.keyword.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide a title."); frm.keyword.focus(); return false; } if (!frm.desc1.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide a description."); frm.desc1.focus(); return false; } if (!frm.desc2.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide a description."); frm.desc2.focus(); return false; } if (!frm.bid.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide a bid amount."); frm.bid.focus(); return false; } if (frm.bid.value.replace(/^\s*|\s*$/g,"") == 0) { alert("Your bid amount must be more than $0.00"); frm.bid.focus(); return false; } } 
		</script>
	</div>

<?
}

function saveForm(){
	global $LinkMapTo,$EMAIL_Info,$Domain_name;
	$email = $_POST["email"];
	$url = $_POST["url"];
	$title = $_POST["keyword"];
	$desc1 = $_POST["desc1"];
	$desc2 = $_POST["desc2"];
	$bid = $_POST["bid"];
	
	$title = addslashes($title);
	$desc1 = addslashes($desc1);
	$desc2 = addslashes($desc2);
	
	mysql_query("insert into listing values('','$email','$title','$desc1','$desc2','0','$url',curdate(),curdate(),'0')") or die("Query could not be executed.".mysql_error());
	
	$id = mysql_insert_id();
	
	$content = "Thank you for buying a Link!<br><br>";
	$content .= "To activate your listing you must bid a minimum of $1.00<br>To bid, please use this page:<br><br>";
	$content .= "<a href=\"$LinkMapTo/details/$id/\" target=_blank >$LinkMapTo/details/$id/</a><br><br>";
	$content .= "If you have any questions, please contact us at:<br><a href=\"$LinkMapTo/contact/\" target=_blank >$LinkMapTo/contact/</a><br><br>";
	$content .= "Thank You!<br>$Domain_name";
	$to= $email;
	$subject="Your Link Details - $url";
	$from=$EMAIL_Info;
	mail($to,$subject,$content,"From:$from\n"."Content-type: text/html");
	
	redirect($LinkMapTo."/details/".$id."/bid_$bid/");
}

?>
