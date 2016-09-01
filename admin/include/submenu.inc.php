<!-- Begin Sub Page Menu Section -->
<div align="center"> 
	<table border="0" cellpadding="3" cellspacing="3" width="450"> 
		<TR>
		<TD colSpan=2>
			<TABLE cellSpacing=0 cellPadding=0 class="submenuTable" border="1">
				<TR>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('09');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/09/">#</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('a');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/a/">A</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('b');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/b/">B</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('c');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/c/">C</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('d');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/d/">D</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('e');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/e/">E</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('f');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/f/">F</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('g');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/g/">G</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('h');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/h/">H</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('i');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/i/">I</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('j');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/j/">J</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('k');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/k/">K</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('l');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/l/">L</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('m');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/m/">M</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('n');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/n/">N</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('o');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/o/">O</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('p');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/p/">P</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('q');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/q/">Q</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('r');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/r/">R</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('s');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/s/">S</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('t');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/t/">T</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('u');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/u/">U</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('v');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/v/">V</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('w');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/w/">W</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('x');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/x/">X</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('y');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/y/">Y</A></TD>
					<TD class=mbgs onmouseover="this.className='mbgshover'" onclick="gurl('z');" onmouseout="this.className='mbgs'"><A class=navs href="<?=$LinkMapTo?>/z/">Z</A></TD>
				</TR>
			</TABLE>
		</TD>
		</TR>
		<TR>
		<?
			if($_GET["tp"]=="09")
				$label = "0-9";
			else
				$label = strtoupper($_GET["tp"]);
			$tempArr = split("/",$_SERVER['REQUEST_URI']);
			$tempStr = $tempArr[sizeof($tempArr)-2];

			if($tempStr== "about")
				$label = "About";
			if($tempStr== "buy_link")
				$label = "Buy A Link";	
			if($tempStr== "contact")
				$label = "Contact Us";	
			if($tempStr== "terms")
				$label = "Terms of Use";
			if($_GET["que"]!=""){
				$label = "'$_GET[que]'";
				$label = str_replace("_"," ",$label);
			}
			
		?>
		<TD width=450 colSpan=2>
			<TABLE height=30 cellSpacing=0 cellPadding=0 width="100%" class="submenuBottomTable" border=0>
				<TR>
					<TD><span class="submenuBottomTableLeftHeading">&nbsp;<?=$label?></span></TD>
					<TD class="submenuBottomLinks" align=right><A class="smallnavwhite" href="<?=$LinkMapTo?>/about/">About</A> | <A class="smallnavwhite" href="<?=$LinkMapTo?>/buy_link/">Buy a Link</A> | <A class="smallnavwhite" href="<?=$LinkMapTo?>/contact/">Contact Us</A> </TD>
					<TD>&nbsp;</TD>
				</TR>
			</TABLE>
		</TD>
		</TR>
	 </table>
</div>
<!-- End Sub Page Menu Section -->