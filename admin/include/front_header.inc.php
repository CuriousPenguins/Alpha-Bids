<?
if($_GET["tp"]=="09")
	$titleExt = "0-9";
else
	$titleExt = strtoupper($_GET["tp"]);
if($_GET["que"]!=""){
	$titleExt = "'$_GET[que]'";
	$titleExt = str_replace("_"," ",$titleExt);
}
?>
<html> 
<head> 
 	<title><?=$Company?><?=" - ".iif($titleExt == "",iif($_GET["link"]=="",$CMS_PAGES_TITLE,getTitleName("select title from listing where listID='".$_GET["link"]."'")),$titleExt);?></title>
 	<meta http-equiv="Content-Language" content="en-gb"> 
 	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
 	<?
 	   if($_GET["tp"]!=""){
 	   	?>
 	   	<meta name="keywords" content="<?=$Company?>, <?=strtoupper($_GET['tp'])?>">
 		<meta name="description" content="Websites starting with <?=strtoupper($_GET['tp'])?>.  Submit your website today for only $1.">
 		<?
 	}
 	else
 	{
 		if($_GET["link"]!=""){
 		?>
 			<meta name="keywords" content=<?=getTitleName("select title from listing where listID=".$_GET["link"])?>>
 			<meta name="description" content=Page for <?=getTitleName("select title from listing where listID=".$_GET["link"])?>.  Increase this site's bid for just $1.>
 		<?
 		}
 		else
 		{
 			if($CMS_PAGES_META_KEYWORDS == "" && $CMS_PAGES_META_DESCRIPTION == ""){
 			?>
				<meta name="keywords" content="<?=$META_KEYWORDS;?>">
 				<meta name="description" content="<?=$META_DESCRIPTION;?>">
 			<?
 			}
 			else
 			{
 			?>
 				<meta name="keywords" content="<?=$CMS_PAGES_META_KEYWORDS;?>">
 				<meta name="description" content="<?=$CMS_PAGES_META_DESCRIPTION;?>">
 			<?
 			}
 		
 		}
 	}
 	?>	
    <link rel='stylesheet' type='text/css' href='<?=$HOST_URL.$HOST_Dir?>/front.css'>
    <script language="javascript"> 
    	function gurl(l){ 
    		document.location.href= '<?=$LinkMapTo?>/'+l+'/'; 
    	} 
    	function gurls(l){ 
    		if(document.getElementById("q").value == ""){
    			alert("Enter A Keyword");
    			document.getElementById("q").focus();
    			return false;
    		}
    		else
    		{
    			var keyword = document.getElementById("q").value;
    			for(i=0;i<keyword.length;i++){keyword = keyword.replace(" ","_")};
    			search.action= '<?=$LinkMapTo?>/'+l+'/'+keyword+'.html'; 
    		}
    	} 
    	function pl(){ 
    		new Image().src = "img/cb.gif"; 
    		new Image().src = "img/cbh.gif"; 
    		new Image().src = "img/mbgs.gif"; 
    		new Image().src = "img/mbgsh.gif"; 
    	} 
    	function validateEmail(email)
		{
			
			// This function is used to validate a given e-mail 
			// address for the proper syntax
			
			if (email == ""){
				return false;
			}
			badStuff = ";:/,' \"\\";
			for (i=0; i<badStuff.length; i++){
				badCheck = badStuff.charAt(i)
				if (email.indexOf(badCheck,0) != -1){
					return false;
				}
			}
			posOfAtSign = email.indexOf("@",1)
			if (posOfAtSign == -1){
				return false;
			}
			if (email.indexOf("@",posOfAtSign+1) != -1){
				return false;
			}
			posOfPeriod = email.indexOf(".", posOfAtSign)
			if (posOfPeriod == -1){
				return false;
			}
			if (posOfPeriod+2 > email.length){
				return false;
			}
			return true
		}
    </script>
</head> 
<body topmargin="50" onload="pl();"> 
 	<script language="javascript" src="http://thumbnails.iwebtool.com/src.js?border=026AFE" type="text/javascript"></script>
<!-- Begin Header Section -->
	<div align="center"> 
		<table border="0" cellpadding="3" cellspacing="3" width="450"> 
			<tr> 
				<td height="80"> 
					<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
						<tr> 
							<td> <a href="<?=$LinkMapTo?>/" style="text-decoration:none;"> <span class="headerText"><?=$Company?></span></a><br> <span class="headerTagText"><?=$TAGLINE?></span></td> 
							<td> 
								<form method="post" name="search" action="<?=$LinkMapTo?>/search/" onsubmit="return gurls('search');"> 
									<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
										<tr> 
											<td align="right"> <input type="text" id="q" name="q" onblur="if(!this.value){this.value='search here';}" onfocus="if(this.value=='search here'){this.value='';}" value="<?=iif($_GET[que]=="",'search here',str_replace('_',' ',$_GET[que]))?>" size="17" class="searchBox"></td> 
											<td>&nbsp;</td> 
										</tr> 
									</table>
								 </form>
							 </td>
						 </tr>
					 </table>
				 </td>
			 </tr>
		</table> 
	</div> 
<!-- End Header Section -->	