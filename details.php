<head>
	<script type="text/javascript" src="http://www.websnapr.com/js/websnapr.js"></script>
</head>

<?
session_start();
include("admin/include/connection.inc.php");
include("admin/include/common.inc.php");
if(isset($_POST["submit"]))
	saveForm();
include("admin/include/front_header.inc.php");
include("admin/include/submenu.inc.php");
include("linkcount.php");
include("indexcount.php");
if(!isset($_POST["submit"]))
showForm($_GET["link"]);

include("admin/include/front_footer.inc.php");



function showForm($listID){
	global $LinkMapTo,$Company;
	$rs = mysql_query("select * from listing where listID='$listID'") or die(mysql_error());
	if(mysql_num_rows($rs)>0){
		$row = mysql_fetch_array($rs);
	}
	else
	{
		redirect($LinkMapTo."/");
	}
?>
	<div align="center" valign='top'> 
		<table border="0" class="listingMaintable" width="450" id="table1"> 
		<? if($row[listStatus] == "0"){ ?>
		<tr>
			<td>
			<table class=glow cellSpacing=0 cellPadding=0 width="100%" border=0>
			<tr>
				<td>
				<table cellSpacing=5 cellPadding=5 width="100%" border=0>
				<tr>
					<td><font style="font-SIZE: 8pt"><b>This Listing has not been Activated<bR></b><bR>To activate this listing, please enter a bid amount and make your payment via PayPal. Once the payment has been received, your link will become active and shown to the public instantly.</font></td>
				</tr>
				</table>
				</td>
			</tr>
			</table>
			</td>
		</tr>
		<? } ?>
		<tr height="5"><td></td></tr>
		<tr>
			<td width=450>
			<fieldset style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-bOTTOM: 2px; PADDING-TOP: 2px">
			<table style="bORDER-COLLAPSE: collapse" cellSpacing=5 cellPadding=5 width="100%" border=0>
			<tr>
				<td width=126 rowspan=2>
				<table style="bORDER-COLLAPSE: collapse" borderColor=#d7d7d7 height=90 cellPadding=0 width=120 background=/details/img/pu.gif border=1>
				<tr>
					<td><script type="text/javascript">wsr_snapshot('<?=$row[siteUrl]?>', '5e14sZl9h8q3', 'S');</script></td>
				</tr>
				</table>
				</td>
				<td>
					<div style="OVERFLOW: hidden; WIDTH: 286px"><font size=4><A class=link title=<?=stripslashes($row[title])?> href="<?=$row[siteUrl]?>"><?=stripslashes($row[title])?></A><bR></font><span style="font-SIZE: 8pt"><font color=#383838><?=stripslashes($row[description_1])?><bR><?=stripslashes($row[description_2])?><bR></font><font color=#0000ff><?=$row[siteUrl]?></font></span></div>
				</td>
			</tr>
			<tr>
				<td><span style="font-WEIGHT: 700"><font size=2>Submitted:</font></span><font size=2><?=$row[createdOn]?></font></td>
			</tr>
			</table>
			</fieldset>
			</td>
		</tr>
		<tr height="5"><td></td></tr>
		<tr>
			<td width=450>
			<fieldset style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-bOTTOM: 2px; PADDING-TOP: 2px"><LEGEND><b><font color=#026AFE size=2>Site Dettails:</font></b></LEGEND>
			<table style="bORDER-COLLAPSE: collapse" cellSpacing=5 cellPadding=5 width="100%" border=0>
			<tr>
				<td width=78><font size=2><b>Total backlinks:</b></font></td>
				<td width=78><font size=2><b>
				<?
$domain="<?=$row[siteUrl]?>"; //your domain name
echo GoogleBL($domain); //get backlinks
?>
</b></font></td>
				<td width=78><font size=2><b>Google indexed pages:</b></font></td>
				<td width=78><font size=2><b>
				<?
$domain="<?=$row[siteUrl]?>"; //your domain name
echo GoogleIP($domain); //get indexed page
?>
</b></font></td>
				
				 <td width=200><font size=2> <a href="http://alexa.com/data/details/traffic_details?url=<?=$row[siteUrl]?>" target="_blank"><img src="http://traffic.alexa.com/graph?c=1&amp;f=555555&amp;u=<?=$row[siteUrl]?>&amp;r=3m&amp;y=t&amp;z=1&amp;h=125&amp;w=200" height="125" width="200" border="0"></a></td>

			</tr>
			</table>
			</fieldset> 
			</td>
		</tr>
		<tr>
			<td width=450>
			<fieldset style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-bOTTOM: 2px; PADDING-TOP: 2px"><LEGEND><b><font color=#026AFE size=2>Alpha-Bids Rank:</font></b></LEGEND>
			<FORM style="MARGIN-TOP: 0px" name="pgfrm" onsubmit="return chkfrm();" action=<?=$LinkMapTo?>/details/pay/ method=post>
			<table style="bORDER-COLLAPSE: collapse" cellSpacing=5 cellPadding=5 width=430 border=0>
						<tr>
				<td vAlign=top width=96><font size=3><b>Current bid:</b></font></td>
				<td width=299><font size=4><?=iif($row[listStatus]=="0","$0.00","$".sprintf("%01.2f",$row[currentBid]))?></font></td>
			</tr>
			<tr>
				<td width=96><font size=2><b>Last bid:</b></font></td>
				<td width=299><font size=2><?=iif($row[listStatus]=="0","Never",iif($row[lastBidOn]=="","Never",$row[lastBidOn]))?></font></td>
			</tr>
			<tr>
				<td vAlign=top width=96><b><font size=2>Add to bid:</font></b></td>
				<td width=299><b><font size=2>$</font></b><input onkeypress="return chknum(event)" name="bid" id="bid" size=9 value=<?=iif($_GET["amt"]!="",$_GET["amt"],"1")?> name=bid><font size=2><b>.00</b></font><span style="font-SIZE: 8pt"><font color=#800000><bR><bR></font>Your new bid will add onto your current bid.<font color=#026AFE><bR>Minimum of $1 is required.</font></span></td>
			</tr>
			<tr>
				<td vAlign=top width=96>&nbsp;</td>
				<td width=299><font style="font-SIZE: 8pt">before you pay, you <b>must</b> agree with the <A href="<?=$LinkMapTo?>/terms/" target=_blank>Terms of use</A>.</font></td>
			</tr>
			<tr>
				<td vAlign=top width=96>&nbsp;</td>
				<td width=299><input type=hidden value="<?=$listID?>" name="listID" id="listID"> <input name="submit" id="submit" class=button type=submit value="Pay Now"> <font style="font-SIZE: 8pt" color=#808080>(Payments by PayPal)</font></td>
			</tr>
			</table>
			</FORM>
			</fieldset>
			</td>
		</tr>
		<tr>
			<td width=450>
			<fieldset style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-bOTTOM: 2px; PADDING-TOP: 2px"><LEGEND><font color=#026AFE size=2><b>Links &amp; banners</b></font><b><font color=#800000 size=2>:</font></b></LEGEND>
			<table id=table1 style="bORDER-COLLAPSE: collapse" cellSpacing=5 cellPadding=5 width=430 border=0>
			<tr>
				<td width=395 colspan=2><font size=2>Encourage your visitors to help you bid on your listings, by adding one of the banners or links below onto your website.</font></td>
			</tr>
			<tr>
				<td vAlign=top colspan=2><font style="font-SIZE: 8pt">To add a link/banner, simply copy the HTML code into your web page.</font></td>
			</tr>
			<?
			$newRs = mysql_query("select * from ad_links") or die(mysql_error());
			If(mysql_num_rows($newRs)>0){
				?>
				<tr>
					<td vAlign=top><font size=2><b>Links:</b></font></td>
					<td><font size=2><b>HTML Code</b></font></td>
				</tr>
				<?
				$i=0;
				while($newRow = mysql_fetch_array($newRs)){
					$i++;
					?>
				<tr>
					<td vAlign=top><A title=<?=$row[siteUrl]?> style="font-SIZE: 10pt" href="<?=$LinkMapTo?>/details/<?=$row[listID]?>/" target=_blank><?=$newRow[linkTitle]?></A></td>
					<td><textarea onclick=this.select(); name=link<?=$i?> rows=3 cols=26><a href="<?=$LinkMapTo?>/details/<?=$row[listID]?>/" style="font-size:10pt;" title="<?=$row[siteUrl]?>" target="_blank"><?=$newRow[linkTitle]?></a></textarea></td>
				</tr>	
				<?
				}
			}
			?>
			<?
			$newRs1 = mysql_query("select * from ad_banner") or die(mysql_error());
			If(mysql_num_rows($newRs1)>0){
				?>
				<tr>
					<td vAlign=top><font size=2><b>banners:</b></font></td>
					<td>&nbsp;</td>
				</tr>
				<?
				$i=0;
				while($newRow1 = mysql_fetch_array($newRs1)){
					$i++;
					?>
				<tr>
					<td vAlign=top><A alt=<?=$row[siteUrl]?> href="<?=$LinkMapTo?>/details/<?=$row[listID]?>/" target=_blank><IMG alt="<?=$Company?>" src="<?=$LinkMapTo?>/img/<?=$newRow1[bannerImage]?>" border=0></A></td>
					<td><textarea onclick=this.select(); name=banner<?=$i?> rows=3 cols=26>&lt;a href="<?=$LinkMapTo?>/details/<?=$row[listID]?>/" title="<?=$row[siteUrl]?>" target="_blank"><img border="0" src="<?=$LinkMapTo?>/img/<?=$newRow1[bannerImage]?>" alt="<?=$Company?>"></a></textarea></td>
				</tr>
				<?
				}
			}
			?>
			<tr>
				<td vAlign=top>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			</table>
			</fieldset>
			</td>
		</tr>
		</table>
		<script language=javascript> 
			function chknum(evt) { var charCode = (evt.which) ? evt.which : event.keyCode; if (charCode > 31 && (charCode < 48 || charCode > 57)) return false; return true; } 
			function chkfrm() { var frm = document.pgfrm; if (!frm.bid.value.replace(/^\s*|\s*$/g,"")) { alert("You must provide a bid amount."); frm.bid.focus(); return false; } if (frm.bid.value.replace(/^\s*|\s*$/g,"") == 0) { alert("Your bid amount must be more than $0.00"); frm.bid.focus(); return false; } alert("You are now being redirected to PayPal where you can complete your payment."); } 
		</script>
	</div>


<?
}

function saveForm(){
	global $LinkMapTo,$EMAIL_Info,$Domain_name,$PayPal_ID;
	$listID = $_POST["listID"];
	$bid = $_POST["bid"];
	if($listID != ""){
		$session_id = session_id();
		$_SESSION["sessID"] = $session_id;
		$transKey = md5($session_id . $bid . $listID . "success");
		$failureKey = md5($session_id . $bid . $listID . "failure");
		$datedOn = time();
		
		$rs = mysql_query("select * from listing where listID = '$listID'") or die(mysql_error());
		$row = mysql_fetch_array($rs);
		$item = $row["siteUrl"];
		
		mysql_query("insert into tempTable values('$session_id','$transKey','$listID','$bid','$datedOn')") or die("Query could not be executed.".mysql_error());
		
	?>
	<FORM name='frm' id="frm" ACTION="https://www.paypal.com/cgi-bin/webscr" METHOD="post">
	<input type="label" style="border:1px solid #ffffff;">
	<input type = "hidden" name= "return"  value="<?=$LinkMapTo?>/thanks/key<?=$transKey?>/"> 
	<INPUT TYPE="hidden" NAME="cmd" VALUE="_ext-enter">
	<INPUT TYPE="hidden" NAME="redirect_cmd" VALUE="_xclick">
	<INPUT TYPE="hidden" NAME="business" VALUE="<?=$PayPal_ID?>">
	<input type= "hidden" name= "rm" value ="2">
	<input type= "hidden" name= "cancel_return" value="<?=$LinkMapTo?>/thanks/key<?=$failureKey?>/"> 
	<INPUT TYPE="hidden" NAME="item_name" VALUE="Bid for <?=$item?>">
	<INPUT TYPE="hidden" NAME="amount" VALUE="<?=$bid?>">	
	<INPUT TYPE="hidden" NAME="shipping" Value="">				
	<INPUT TYPE="hidden" NAME="currency_code" VALUE="USD">
	<INPUT TYPE="hidden" NAME="lc" VALUE="US">
	</form> 
	<script language="javascript">
		document.frm.submit();
	</script> 	
		<?
	}
	else
	{
		?>
		<div align="center" valign='top'> 
		<table border="0" class="listingMaintable" width="450" id="table1"> 
		<tr>
			<td>Sorry! not being able to proceess your request. <a href="<?=$LinkMapTo?>/buy_link/">Click here</a> to try again.</td>
		</tr>
		</table>
		</div>
		<?
	}
}
?>