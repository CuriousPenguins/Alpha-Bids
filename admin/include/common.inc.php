<?
$cmtimages = "cmtimages";
$cmtdoc = "cmtdoc"; 

function FindInArray($ElementArray,$ElementToFind){
	if($ElementArray!=""){
		foreach($ElementArray as $val){
			if($val==$ElementToFind)
				return true;
		}
	}
	return false;
}

function getTitleName($sql){
	$rs=mysql_query($sql) or die(mysql_error());
	$a_row=mysql_fetch_array($rs);
	return stripslashes($a_row[0]);
}


function getFileContent($filename,$parameter){
	global $LinkMapTo;
	$rs = mysql_query("select $parameter from cmsfiles where filename='$filename'") or die(mysql_error());
	if(mysql_num_rows($rs)>0){
		$row = mysql_fetch_array($rs);
		$content = str_replace("../cmtimages/","$LinkMapTo/cmtimages/",stripslashes($row[$parameter]));
		$content = str_replace("../cmtdoc/","$LinkMapTo/cmtdoc/",$content);
		return $content;
	}
}

?>
