<?
include("../../../../include/connection.inc.php");
include("../../../../include/common.inc.php");
$path="../../../../../$cmtimages";

switch ($call)
{
	case "upload":
		
		$file_name=$_FILES['src']['name'];
		if(copy($src,"$path/$file_name"))
		{
			//$loadscript="<script> onload=selimage('$file_name'); </script>";
			$loadscript="selimage('$file_name');";
		}
		
		break;
}

?>

<HTML>
	<HEAD>
		<title>Upload Image</title>
		<script language="javascript">
		function selimage(img)
		{
			//alert(img);
			elem=document.forms[0].image_list;
			for(i=0;i<elem.length;i++)
			{
				//alert(elem.options[i].value.indexOf(img));
				if(elem.options[i].value.indexOf(img)<0)
				{
					elem.options[i].selected=true;
					document.forms[0].hsrc.value="../cmtimages/"+img;
					getImageData();
					insertImage();
					//window.preview.location.reload();
					break;
				}
			}
		}
		</script>
		<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
		<script language="javascript">
var url = tinyMCE.getParam("external_image_list_url");
if (url != null)
	//document.write('<script language="javascript" type="text/javascript" src="' + tinyMCE.documentBasePath + "/" + url + '"></sc'+'ript>');
		</script>
		<script language="javascript" type="text/javascript">
<!--
    function myRegexpReplace(in_str, reg_exp, replace_str, opts) {
        if (typeof opts == "undefined")
            opts = 'g';
        var re = new RegExp(reg_exp, opts);
        return in_str.replace(re, replace_str);
    }

    function insertImage() {
        if (window.opener) {
            var src         = document.forms[0].hsrc.value;
            var alt         = document.forms[0].alt.value;
            var title       = document.forms[0].title.value;
            var border      = document.forms[0].border.value;
            var vspace      = document.forms[0].vspace.value;
            var hspace      = document.forms[0].hspace.value;
            var width       = document.forms[0].width.value;
            var height      = document.forms[0].height.value;
            var align       = document.forms[0].align.options[document.forms[0].align.selectedIndex].value;
           

        // added 2004-11-10 by Michael Keck (me@michaelkeck.de)
        // supporting onmouse over / out for image swap ...
            // only support the onmouse over/out if both values are given
            window.opener.tinyMCE.insertImage(src, alt, border, hspace, vspace, width, height, align, title, "", "");
            top.close();
        }
    }

	function init() {
		if (tinyMCE.getParam("file_browser_callback") != null) {
			document.getElementById('src').style.width = '260px';

			var html = '';

			document.getElementById('browser').innerHTML = html;
		}
	        var htmlprev = ''; 

		var src = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings['base_href'], document.forms[0].hsrc.value);
		if (src == "")
		src = "about:blank";
	
	        htmlprev += ' <iframe id="preview" name="preview" scrolling="auto" ' 
	        htmlprev += ' marginwidth="0" marginheight="0" frameborder="0" src="' + src + '"' 
	        htmlprev += ' style="margin:0px;border: 1px solid black;width:135px;height:135px"></iframe>'; 
	
	        document.getElementById('prev').innerHTML = htmlprev; 
	        
	}
	
	function selectByValue(form_obj, field_name, value) {
		if (!form_obj || !form_obj.elements[field_name])
			return;

		for (var i=0; i<form_obj.elements[field_name].options.length; i++) {
			var option = form_obj.elements[field_name].options[i];
			if (option.value == value)
				option.selected = true;
		}
	}

    function setOnMouseInput(stat){
        var formObj = document.forms[0];
        if (stat=='enabled') {
            formObj.onmouseover.disabled = false;
            formObj.onmouseout.disabled  = false;
            if (document.getElementById) {
                document.getElementById('showInput1').style.color="#000000";
                document.getElementById('showInput2').style.color="#000000";
            }
            formObj.onmouseout.value = formObj.src.value;
        } else {
            formObj.onmouseover.disabled = true;
            formObj.onmouseout.disabled  = true;
            if (document.getElementById) {
                document.getElementById('showInput1').style.color="#666666";
                document.getElementById('showInput2').style.color="#666666";
            }
        }
    }

    function cancelAction() {
        top.close();
    }

	var preloadImg = new Image();

	function resetImageData() {
		var formObj = document.forms[0];
		formObj.width.value = formObj.height.value = "";	
	}

	function updateImageData() {
		var formObj = document.forms[0];

		if (formObj.width.value == "")
			formObj.width.value = preloadImg.width;

		if (formObj.height.value == "")
			formObj.height.value = preloadImg.height;
	}

	function getImageData() {
		preloadImg = new Image();
		tinyMCE.addEvent(preloadImg, "load", updateImageData);
		tinyMCE.addEvent(preloadImg, "error", function () {var formObj = document.forms[0];formObj.width.value = formObj.height.value = "";});
		preloadImg.src = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings['base_href'], document.forms[0].hsrc.value);

		var src = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings['base_href'], document.forms[0].hsrc.value);
		
		if (src == "")
			src = "about:blank";
		
		//self.preview.location = src; 
		//alert(src);
		window.preview.location = src; 
		//alert(window.preview.location);
		
	}
//-->
		</script>
	</HEAD>
	<body onload="init();<?=$loadscript;?>">
		<form id="Form1" method="post" runat="server" target="_self" enctype="multipart/form-data">
			<input type="hidden" name="call" value="upload" id="call" runat="server">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="center" valign="middle"><table border="0" cellpadding="4" cellspacing="0">
							<tr>
								<td colspan="3" class="title">Insert/edit image</td>
							</tr>
							<tr>
								<td align="right" nowrap>Image URL:</td>
								<td colspan="2">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><input name="hsrc" type="hidden" id="hsrc" runat="server" style="WIDTH: 280px" onchange="getImageData();"></td>
											<td><input type="file" name="src" id="src" runat="server" style="WIDTH: 280px" onchange="this.form.hsrc.value=this.value;getImageData();"></td>
											<td id="browser"></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- Image list -->
							<tr>
								<td align="right" nowrap>Image list:</td>
								<td colspan="2"><select id="image_list" name="image_list" runat="server" style="WIDTH: 280px" onchange="this.form.hsrc.value=this.options[this.selectedIndex].value;resetImageData();getImageData();">
										<option value="" selected>---</option>
										<?=show_files();?>
									</select></td>
							</tr>
							<!-- /Image list -->
							<tr>
								<td align="right" nowrap>Image description:</td>
								<td colspan="2"><input name="alt" type="text" id="alt" runat="server" style="WIDTH: 280px" onblur="if(document.forms[0].title.value==''){ document.forms[0].title.value=this.value; }"
										onfocus="if(document.forms[0].title.value==''){ document.forms[0].title.value=this.value; }"></td>
							</tr>
							<tr>
								<td align="right" nowrap>Image title:</td>
								<td colspan="2"><input name="title" type="text" id="title" runat="server" style="WIDTH: 280px"></td>
							</tr>
							<tr>
								<td align="right" nowrap>Dimensions:</td>
								<td nowrap>
									<input name="width" type="text" id="width" size="5" maxlength="5" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 50px; TEXT-ALIGN: center">
									x <input name="height" type="text" id="height" size="5" maxlength="5" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 50px; TEXT-ALIGN: center">
									px
								</td>
								<td rowspan="6" valign="top"><div id="prev" name="prev" runat="server" style="BORDER-RIGHT:medium none; BORDER-TOP:medium none; MARGIN:0px; BORDER-LEFT:medium none; WIDTH:135px; BORDER-BOTTOM:medium none; HEIGHT:135px"></div>
								</td>
							</tr>
							<tr>
								<td align="right" nowrap>Border:</td>
								<td colspan="2"><input name="border" type="text" id="border" size="3" maxlength="3" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 30px; TEXT-ALIGN: center"></td>
							</tr>
							<tr>
								<td align="right" nowrap>Alignment:</td>
								<td><select name="align" id="align" runat="server">
										<option value="" selected>Default</option>
										<option value="baseline">Baseline</option>
										<option value="top">Top</option>
										<option value="middle">Middle</option>
										<option value="bottom">Bottom</option>
										<option value="texttop">TextTop</option>
										<option value="absmiddle">Absolute Middle</option>
										<option value="absbottom">Absolute Bottom</option>
										<option value="left">Left</option>
										<option value="right">Right</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right" nowrap>VSpace:</td>
								<td><input name="vspace" type="text" id="vspace" size="3" maxlength="3" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 30px; TEXT-ALIGN: center"></td>
							</tr>
							<tr>
								<td align="right" nowrap>HSpace:</td>
								<td><input name="hspace" type="text" id="hspace" size="3" maxlength="3" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 30px; TEXT-ALIGN: center"></td>
							</tr>
							<tr>
								<td colspan="3" align="center" height="40" valign="bottom"><input type="button" name="insert" value="Insert" runat="server" onclick="insertImage();"
										id="insert">&nbsp;<input type="submit" name="upload" value="upload" id="Upload" runat="server" style="FONT-WEIGHT:bold">&nbsp;<input type="button" name="cancel" value="Cancel" runat="server" onclick="cancelAction();"
										id="cancel"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</body>
</HTML>

<?

function delete()
{
	global $file,$cmtimages;
	$root = "../cmtimages";
	unlink($root."/".$file);
	show_files();
}
function show_files()
{
	global $path,$folder_name,$cmtimages;
	//$root = "../../../../../cmtimages";
	$root = $path;;
		
	
	if (false !==($handle = opendir($root))) {
	
		$x=0;
	    while (false !== ($file = readdir($handle)))  
		{
			$ext=explode(".",$file);
		 	if ($file <> "." && $file <> "..")
		 	{
		 		if(! is_dir($root."/".$file))
		 		
		 		{	 					
					$filearray[$x]=$file;
		
		 		
		 		}
		  		
			}
			$x++;
		}
		if($filearray<>"")
		{
			sort($filearray);
			reset($filearray);
			foreach($filearray as $key=>$value)
			{
				$file=$value;
				if (strpos($file,".jpg") || strpos($file,".gif") || strpos($file,".bmp") || strpos($file,".tif") || strpos($file,".png") || strpos($file,".bmp"))
			  		echo "<option value='../$cmtimages/$file'>$file</option>";
			}
		}
    closedir($handle); 
   }
	
}
?>
