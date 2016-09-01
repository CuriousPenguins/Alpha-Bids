<?
session_start();
include("admin/include/connection.inc.php");
include("admin/include/common.inc.php");
$CMS_PAGES_TITLE = getFileContent("terms.php","title");
$CMS_PAGES_META_KEYWORDS = getFileContent("terms.php","meta_keywords");
$CMS_PAGES_META_DESCRIPTION = getFileContent("terms.php","meta_desc");
include("admin/include/front_header.inc.php");
include("admin/include/submenu.inc.php");
?>
<div align="center" valign='top'> 
	<table border="0" class="listingMaintable" width="450" id="table1"> 
	<tr> 
		<td width="450"> 
		<?=getFileContent("terms.php","content")?>
		</td> 
	</tr>
	</table> 
</div>
<?
include("admin/include/front_footer.inc.php");
?>