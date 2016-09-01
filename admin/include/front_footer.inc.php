<!-- Begin Footer Section -->

	<div align="center"> 
<table  cellpadding="1"  cellspacing="1"  align="center"  height="125px"  width="500px" ><tr>
<td algin="center" valign="middle"><a href="http://www.thexyz.com/pages/cloud.html"><IMG alt="Thexyz.com Secure Online Backup Storage" border="0" src="/img/thexyz-cloud-ad-125.gif"></a>
</td>
<td algin="center" valign="middle"><script type="text/javascript"><!--
google_ad_client = "ca-pub-5600424225032954";
/* scriptdorks 125 */
google_ad_slot = "8952627298";
google_ad_width = 125;
google_ad_height = 125;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td>
<td algin="center" valign="middle"><a href="http://www.scriptdorks.com/"><img class="alignnone size-full wp-image-18" title="scriptdorks" src="http://www.scriptdorks.com/wp-content/uploads/2011/05/scriptdorks_logo_125.jpg" alt="" width="125" height="125" /></a>
</td>
<td algin="center" valign="middle"><a href='http://www.dreamstime.com/res487314-free-images' target='_blank'><img src='http://thumbs.dreamstime.com/img/badges/banner_photo_125x125.gif' border='0' alt='Royalty Free Images'></a>
</td>
</tr>
</table>

	<div align="center"> 
		<table border="0" cellpadding="3" cellspacing="3" width="450">
			<tr> 
				<td align="right"> <span class="footer">Copyright <?=$Company?>. Powered by <strong><i><a href="http://www.alpha-bids.com">alpha-bids.com</a></i></strong><br /><a href="http://www.driond.com" target="_blank" title="Unlimited Hosting">Unlimited Hosting</a> | <a href="http://www.websnapr.com/" target="_blank" title="Thumbnails by Websnapr 2.0">Thumbnails by Websnapr 2.0</a></span></td> 
			</tr> 
			<tr> 
				<td>&nbsp;</td> 
			</tr> 
		</table>
	</div>

<?php
// THE FOLLOWING BLOCK IS USED TO RETRIEVE AND DISPLAY LINK INFORMATION.
// PLACE THIS ENTIRE BLOCK IN THE AREA YOU WANT THE DATA TO BE DISPLAYED.

// MODIFY THE VARIABLES BELOW:
// The following variable defines whether links are opened in a new window
// (1 = Yes, 0 = No)
$OpenInNewWindow = "1";

// # DO NOT MODIFY ANYTHING ELSE BELOW THIS LINE!
// ----------------------------------------------
$BLKey = "PI0O-C31M-L444";

if(isset($_SERVER['SCRIPT_URI']) && strlen($_SERVER['SCRIPT_URI'])){
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_URI'].((strlen($_SERVER['QUERY_STRING']))?'?'.$_SERVER['QUERY_STRING']:'');
}

if(!isset($_SERVER['REQUEST_URI']) || !strlen($_SERVER['REQUEST_URI'])){
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'].((isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']))?'?'.$_SERVER['QUERY_STRING']:'');
}

$QueryString  = "LinkUrl=".urlencode(((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$QueryString .= "&Key=" .urlencode($BLKey);
$QueryString .= "&OpenInNewWindow=" .urlencode($OpenInNewWindow);


if(intval(get_cfg_var('allow_url_fopen')) && function_exists('readfile')) {
    @readfile("http://www.backlinks.com/engine.php?".$QueryString); 
}
elseif(intval(get_cfg_var('allow_url_fopen')) && function_exists('file')) {
    if($content = @file("http://www.backlinks.com/engine.php?".$QueryString)) 
        print @join('', $content);
}
elseif(function_exists('curl_init')) {
    $ch = curl_init ("http://www.backlinks.com/engine.php?".$QueryString);
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_exec ($ch);

    if(curl_error($ch))
        print "Error processing request";

    curl_close ($ch);
}
else {
    print "It appears that your web host has disabled all functions for handling remote pages and as a result the BackLinks software will not function on your web page. Please contact your web host for more information.";
}
?>

<?php
// THE FOLLOWING BLOCK IS USED TO RETRIEVE AND DISPLAY LINK INFORMATION.
// PLACE THIS ENTIRE BLOCK IN THE AREA YOU WANT THE DATA TO BE DISPLAYED.

// MODIFY THE VARIABLES BELOW:
// The following variable defines whether links are opened in a new window
// (1 = Yes, 0 = No)
$OpenInNewWindow = "1";

// # DO NOT MODIFY ANYTHING ELSE BELOW THIS LINE!
// ----------------------------------------------
$BLKey = "1I08-128R-7129";

$QueryString  = "LinkUrl=".urlencode((($_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$QueryString .= "&Key=" .urlencode($BLKey);
$QueryString .= "&OpenInNewWindow=" .urlencode($OpenInNewWindow);


if(intval(get_cfg_var('allow_url_fopen')) && function_exists('readfile')) {
    @readfile("http://brokerage.linkadage.com/engine.php?".$QueryString); 
}
elseif(intval(get_cfg_var('allow_url_fopen')) && function_exists('file')) {
    if($content = @file("http://brokerage.linkadage.com/engine.php?".$QueryString)) 
        print @join('', $content);
}
elseif(function_exists('curl_init')) {
    $ch = curl_init ("http://brokerage.linkadage.com/engine.php?".$QueryString);
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_exec ($ch);

    if(curl_error($ch))
        print "Error processing request";

    curl_close ($ch);
}
else {
    print "It appears that your web host has disabled all functions for handling remote pages and as a result the BackLinks software will not function on your web page. Please contact your web host for more information.";
}
?>

</body>
</html>
<!-- End Footer Section -->