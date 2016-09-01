<?
include("admin/include/connection.inc.php");

$tp = strtolower($_GET["letter"]);
$page = strtolower($_GET["page"]);
$limit = 10;
if($page == "")
	$offset = 0;
else
	$offset = ($page * $limit) - $limit;

$query = "select * from listing where listStatus = '1' and title like '$tp%' order by currentBid desc limit $offset, $limit";

$rs = mysql_query($query) or die(mysql_error());
if(mysql_num_rows($rs)>0){
$str = "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
$str .= "    	<channel>\n";
	
$str .= "		<title>" . htmlentities($Company) . " - " . htmlentities(strtoupper($tp)) . "</title>\n";
$str .= "    	<description>" . htmlentities(mysql_num_rows($rs)) . " websites listed for " . htmlentities(strtoupper($tp)) . ".</description>\n";
$str .= "    	<link>" . htmlentities($LinkMapTo) . "/" . htmlentities($tp) . "/</link>\n";
$str .= "		<dc:language>en-us</dc:language>\n";
	while($row = mysql_fetch_array($rs)){
		$str .= "		<item>\n";
		$str .= "		<title>" . htmlentities(stripslashes($row[title])). " ($" . htmlentities($row[currentBid]) . ")</title>\n";
		$str .= "		<description>" . htmlentities(stripslashes($row[description_1])) . htmlentities("<br>") . htmlentities(stripslashes($row[description_2])) . "</description>\n";
		$str .= "		<link>" . htmlentities($row[siteUrl]) . "</link>\n";
		$str .= "		<bid>" . htmlentities($row[currentBid]) . "</bid>\n";
		$str .= "		</item>\n";
	}
$str .= "		</channel>\n";
$str .= "</rss>\n";
echo $str;
}
?>