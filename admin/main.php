<?
session_start();
include("include/connection.inc.php");
check_security();
?>
<html>
<?
include("include/header.php");
?>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bgcolor="#efefef">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
			<TR>
				<td width="100%" valign="top" align=center>
					<table width="100%" align="center"  cellpadding="0" cellspacing="0" border=0 height="100%">
						<tr height="50" bgcolor="#efefef"><td align="right" colspan="2"><span id="status_msg"  style="Font-size:12px;padding:15px;" >&nbsp; </span></td></tr>
					<tr valign="top"><td bgcolor="#efefef" style="padding-left:20px;padding-bottom:10px;" class="directory_link" width="20%"><br><br><span class="theader">Admin Menu</span><br>___________________________<br><br>
						     <? loadmenu();?>
						    </td>
						    <td valign=top width="100%" align="center">
									<iframe name="main" id="main" frameborder="0" width="100%" style="height:522px;" src='home.php' align='center'></iframe>
								</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</HTML>

<?
function  loadmenu(){
      			
			$sql="select * from adminmenu order by menuOrder";
			$rs = mysql_query($sql);
				
			while($row=mysql_fetch_array($rs))
			{
				echo "<div height=20><a href='$row[fileName]' target='main' class='whats_this'>$row[menuName]</a></div><br>";
			} 
		
		
         
}
?>