<?
session_start();
include("admin/include/connection.inc.php");
if(isset($_SESSION["sessID"])){
	$sessID = $_SESSION["sessID"];
	$key = $_GET["key"];
	
	$rs = mysql_query("select * from tempTable where session_id='$sessID' and transactionKey='$key'") or die(mysql_error());
	if(mysql_num_rows($rs)>0){
		$row = mysql_fetch_array($rs);
		
		$newRs = mysql_query("select * from listing where listID='$row[listID]'") or die(mysql_error());
		$newRow = mysql_fetch_array($newRs);
		
		$bid = $newRow[currentBid]+$row[bidToadd];
		mysql_query("update listing set currentBid='".$bid."',listStatus='1',lastBidOn=curdate() where listID='$row[listID]'") or die(mysql_error());
		
		$content = "Thanks, for successfully making a bid at <a href='$LinkMapTo'>$LinkMapTo</a> for <a href='$newRow[siteUrl]'>$newRow[siteUrl]</a>. <br>Your bid is confirmed and updated. <br><br><a href='$LinkMapTo/details/$row[listID]/'>Click here</a> to view the <a href='$newRow[siteUrl]'>$newRow[siteUrl]</a> status at $Domain_name <br><br> Thanks,<br>$EMAIL_Info";
		$to= $newRow[email];
		$subject="Your Bid Details - $Domain_name";
		$from= "$EMAIL_Info";
		mail($to,$subject,$content,"From:$from\n"."Content-type: text/html");
		
		$email = $newRow[email];
		$content = "A new bid is submitted for <a href='$newRow[siteUrl]'>$newRow[siteUrl]</a>. <br>Please review this bid by using the Web Admin Panel at $Domain_name <br><br> Thanks,<br>$EMAIL_Info";
		$to= $EMAIL_Sales;
		$subject="New Bid Details - $newRow[siteUrl]";
		$from=$email;
		mail($to,$subject,$content,"From:$from\n"."Content-type: text/html");
		
		mysql_query("delete from tempTable where session_id='$sessID' and transactionKey='$key'") or die(mysql_error());
		
		$_SESSION["sessID"] = "";
		$redirect = "$LinkMapTo/thanks/";
	}
	else
	{
		$redirect = "$LinkMapTo/cancel/";
	}
}
else
{
	$redirect = "$LinkMapTo/cancel/";
}
?>
<script language="javascript">
	document.location.href="<?=$redirect?>";
</script> 	
