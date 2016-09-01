<?
session_start();
include("admin/include/connection.inc.php");
include("admin/include/common.inc.php");
include("admin/include/front_header.inc.php");

$tp = strtolower($_GET["tp"]);

switch($tp){
	case "":
		include("admin/include/menu.inc.php");
		$query = "select * from listing where listStatus = '1' order by currentBid desc limit 5";
		showHome($query,$tp);
		break;
	case "09":
		include("admin/include/submenu.inc.php");
		$query = "select * from listing where listStatus = '1' and title like ('0%' or '1%' or '2%' or '3%' or '4%' or '5%' or '6%' or '7%' or '8%' or '9%') order by currentBid desc";
		showSubPage($query,$tp);
		break;
	case "a":
	case "b":
	case "c":
	case "d":
	case "e":
	case "f":
	case "g":
	case "h":
	case "i":
	case "j":
	case "k":
	case "l":
	case "m":
	case "n":
	case "o":
	case "p":
	case "q":
	case "r":
	case "s":
	case "t":
	case "u":
	case "v":
	case "w":
	case "x":
	case "y":
	case "z":
		include("admin/include/submenu.inc.php");
		$query = "select * from listing where listStatus = '1' and title like '$tp%' order by currentBid desc";
		//$query = "select * from listing where listStatus = '1' order by currentBid desc";
		showSubPage($query,$tp);
		break;
}

include("admin/include/front_footer.inc.php");



function showHome($query,$tp){
	global $LinkMapTo;
	$rs = mysql_query($query) or die(mysql_error());
	
?>
	<div align="center"> 
		<table border="0" class="listingMainTable" width="450" id="table1"> 
			<tr> 
				<td><span class="Top5">Top 5 Listings</span></td> 
			</tr> 
			<tr> 
				<td><hr></td> 
			</tr> 
			<tr> 
				<td>
					<?
						if(mysql_num_rows($rs)>0){
							$styleTable = "rowAlternateTable";
							while($row = mysql_fetch_array($rs)){
								if($styleTable == "rowTable")
									$styleTable = "rowAlternateTable";
								else
									$styleTable = "rowTable";
								?>
									<table border="1" cellpadding="0" cellspacing="0" width="100%" border="1" class="<?=$styleTable?>" height="70"> 
									<tr> 
										<td>
										<table border="0" cellpadding="0" width="100%" cellspacing="0"> 
										<tr> 
											<td width="50" valign="top" rowspan="2"> 
											<table border="0" cellpadding="0" cellspacing="0" width="52" height="33"> 
											<tr> 
												<td class="cb" onclick="gurl('details/<?=$row[listID]?>');" onmouseout="this.className='cb'" onmouseover="this.className='cbhover'" valign="top" align="center">
												 <a class="navs" href="<?=$LinkMapTo?>/details/<?=$row[listID]?>/"> <span class="currentBid"> $<?=$row[currentBid]?></span></a>
												</td>
											</tr> 
											</table> 
											</td> 
											<td width="10" rowspan="2">&nbsp;</td> 
											<td><a href="<?=$row[siteUrl]?>" class="link" title="<?=stripslashes($row[title])?>"><?=stripslashes($row[title])?></a><br> 
											    <span class="listingDesc"><?=stripslashes($row[description_1])?><br><?=stripslashes($row[description_2])?></span>
											</td> 
										</tr> 
										</table>
										</td> 
									</tr> 
									</table>
								<?
							}		
						}
						else
							echo "There are currently no listings available.";
					?>
				</td> 
			</tr> 
			<tr> 
				<td><hr></td> 
			</tr> 
		</table> 
	</div>

<?
}

function showSubPage($query,$tp){
	global $LinkMapTo;
	$rs = mysql_query($query) or die(mysql_error());
?>
	<div align="center"> 
		<table border="0" class="listingMainTable" width="450" id="table1"> 
		<? $str = paging($query,$tp);?>
		<tr>
		<td colspan="2">
		<?
			if($str != "")
				pagelink($str,$tp);
		?>
		</td>
		</tr>
		</table> 
	</div>
<?
}

function paging($query,$tp)
{
	global $LinkMapTo;
	$curr_page = $_GET["curr_page"];

	$limit = 10;
	
	$objrs_show = mysql_query($query);
	
	if(mysql_num_rows($objrs_show)>0)
	{
		$totRecords = mysql_num_rows($objrs_show);
		$tot_pages = ceil(mysql_num_rows($objrs_show) / $limit);
		if($curr_page == "")
		{
			$curr_page = 1;
		}
		$offset = ($curr_page * $limit) - $limit;
		
		$objrs_page_data = mysql_query($query . " limit $offset, $limit".mysql_error());
		
		if(mysql_num_rows($objrs_page_data)>0)
		{
			$displayingRecords = mysql_num_rows($objrs_page_data);
			?>
			<tr>
				<td width="450" colSpan="2">
					<table class="glow" height="25" cellSpacing="0" cellPadding="0" align="center" width="438" border="0">
						<tr>
							<td><FONT size="2">&nbsp;</FONT><span class="displayText">Showing <strong><?=$displayingRecords?></strong> from <strong><?=$totRecords?></strong> result(s) on <strong>Page <?=$curr_page?></strong>.</span></td>
							<td width="35"><A href="<?=$LinkMapTo?>/rss.php?letter=<?=$tp?>&page=<?=$curr_page?>"><IMG height=15 src="<?=$LinkMapTo?>/img/rss.gif" width=32 border=0></A></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td colspan="2"><hr></td> 
			</tr>
			<tr>
				<td colspan="2"> 
			<?
			if(mysql_num_rows($objrs_page_data)==1)
			{
				$page = $curr_page;
				$page--;
			}
			else
				$page = $curr_page;
			$styleTable = "rowAlternateTable";				
			while($row = mysql_fetch_array($objrs_page_data)){
				if($styleTable == "rowTable")
					$styleTable = "rowAlternateTable";
				else
					$styleTable = "rowTable";
				?>
					<table border="1" cellpadding="0" cellspacing="0" width="100%" border="1" class="<?=$styleTable?>" height="70"> 
					<tr> 
						<td>
						<table border="0" cellpadding="0" width="100%" cellspacing="0"> 
						<tr> 
							<td width="50" valign="top" rowspan="2"> 
							<table border="0" cellpadding="0" cellspacing="0" width="52" height="33"> 
							<tr> 
								<td class="cb" onclick="gurl('details/<?=$row[listID]?>');" onmouseout="this.className='cb'" onmouseover="this.className='cbhover'" valign="top" align="center">
								 <a class="navs" href="<?=$LinkMapTo?>/details/<?=$row[listID]?>/"> <span class="currentBid"> $<?=$row[currentBid]?></span></a>
								</td>
							</tr> 
							</table> 
							</td> 
							<td width="10" rowspan="2">&nbsp;</td> 
							<td><a href="<?=$row[siteUrl]?>" class="link" title="<?=stripslashes($row[title])?>"><?=stripslashes($row[title])?></a><br> 
							    <span class="listingDesc"><?=stripslashes($row[description_1])?><br><?=stripslashes($row[description_2])?></span>
							</td> 
						</tr> 
						</table>
						</td> 
					</tr> 
					</table>
				<?
			}
			?>
				</td>
			</tr>
			<tr> 
				<td colspan="2"><hr></td> 
			</tr> 
			<?		
		}
		$str = $tot_pages . "," .$curr_page;
		return $str;
	}
	else
	{
		echo "<tr><td colspan='2'><hr></td></tr>";
		echo "<tr><td colspan='2'><span class='error'>There are currently no listings available.</span></td></tr>";
		echo "<tr><td colspan='2'><hr></td></tr>";
	}
	
}			

function pagelink($str,$tp)
{
	global $LinkMapTo;
	$arr = split(",",$str);
	$tot_pages = $arr[0];
	$curr_page = $arr[1];
	?>
	<tr>
		<td width=213><input class=button onclick="gurl('buy_link');" type=button value="Buy a Link"></td>
		<td width=216>
		<div align=right>
			<table cellPadding=2 border=0>
				<tr>
					<td><B><FONT size=2>Page</FONT></B></td>
					<td>
						<table style="BORDER-COLLAPSE: collapse" borderColor=#ffffff cellSpacing=0 cellPadding=0 bgColor=#cc2800 border=1>
						<tr>
							<?
							for($i = 1 ; $i <= $tot_pages ; $i++)
							{
								if($i < $curr_page && $back == 0){
									$back = 1;
									?>
									<td class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('<?=$tp?>/page_<?=$curr_page - 1?>');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/<?=$tp?>/page_<?=$curr_page - 1?>/">&lt;</A></td>
									<?
								}
								if($i == $curr_page){
									?>
									<td class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('<?=$tp?>/page_<?=$i?>');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/<?=$tp?>/page_<?=$i?>/"><?=$i?></A></td>
									<?
								}
								if($i <= $tot_pages && $i > $curr_page && $next == 0){
									$next = 1;
									?>
									<td class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('<?=$tp?>/page_<?=$i?>');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/<?=$tp?>/page_<?=$i?>/">&gt;</A></td>
									<?
								}
							}
								?>
						</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
<?
}
?>