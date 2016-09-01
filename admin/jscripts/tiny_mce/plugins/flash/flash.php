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
			$loadscript="selflash('$file_name');";
		}
		
		break;
}

?>
<HTML>
  <HEAD>
		<title>Insert / edit Flash Movie</title>
		<script>
	function selflash(fla)
	{
		
		/*elem=document.forms[0].link_list;
		for(i=0;i<elem.length;i++)
		{
			if(elem.options[i].value.indexOf(fla)>=0)
			{
				//alert(fla);
				elem.options[i].selected=true;
				document.forms[0].file.value="../cmtimages/"+fla;
				//getImageData();
				insertFlash();
				//window.preview.location.reload();
				break;
			}
		}*/
		if(fla != "")
		{
			document.forms[0].file.value="../cmtimages/"+fla;
			insertFlash();
		}
	}
</script>
<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
<script language="javascript">
var url = tinyMCE.getParam("flash_external_list_url");
/*if (url != null)
	document.write('<sc'+'ript language="javascript" type="text/javascript" src="' + tinyMCE.documentBasePath + "/" + url + '"></sc'+'ript>');
*/
</script>
<script language="javascript" type="text/javascript">
<!--
    function init() {
    // modified 2004-11-10 by Michael Keck (me@michaelkeck.de)
    // supporting onclick event to open pop windows
        var formObj = document.forms[0];
        var swffile   = tinyMCE.getWindowArg('swffile');
        var swfwidth  = '' + tinyMCE.getWindowArg('swfwidth');
        var swfheight = '' + tinyMCE.getWindowArg('swfheight');
        if (swfwidth.indexOf('%')!=-1) {
            formObj.width2.value = "%";
            formObj.width.value  = swfwidth.substring(0,swfwidth.length-1);
        } else {
            formObj.width2.value = "px";
            formObj.width.value  = swfwidth;
        }
        if (swfheight.indexOf('%')!=-1) {
            formObj.height2.value = "%";
            formObj.height.value  = swfheight.substring(0,swfheight.length-1);
        } else {
            formObj.height2.value = "px";
            formObj.height.value  = swfheight;
        }
        formObj.file.value = swffile;
        formObj.insert.value = tinyMCE.getLang('lang_' + tinyMCE.getWindowArg('action'), 'Insert', true);

		// Handle file browser
		if (tinyMCE.getParam("file_browser_callback") != null) {
			document.getElementById('file').style.width = '230px';

			var html = '';

			html += '<img id="browserBtn" src="../../themes/advanced/images/browse.gif"';
			html += ' onmouseover="tinyMCE.switchClass(this,\'mceButtonOver\');"';
			html += ' onmouseout="tinyMCE.restoreClass(this);"';
			html += ' onmousedown="tinyMCE.restoreAndSwitchClass(this,\'mceButtonDown\');"';
			html += ' onclick="javascript:tinyMCE.openFileBrowser(\'file\',document.forms[0].file.value,\'flash\',window);"';
			html += ' width="20" height="18" border="0" title="' + tinyMCE.getLang('lang_browse') + '"';
			html += ' class="mceButtonNormal" alt="' + tinyMCE.getLang('lang_browse') + '" />';

			document.getElementById('browser').innerHTML = html;
		}

		// Auto select flash in list
		if (typeof(tinyMCEFlashList) != "undefined" && tinyMCEFlashList.length > 0) {
			for (var i=0; i<formObj.link_list.length; i++) {
				if (formObj.link_list.options[i].value == tinyMCE.getWindowArg('swffile'))
					formObj.link_list.options[i].selected = true;
			}
		}

        window.focus();
    }

    function insertFlash() {
        var formObj = document.forms[0];
        if (window.opener) {
            var html      = '';
            var file      = formObj.file.value;
            //alert(file);
            var width     = formObj.width.value;
            var height    = formObj.height.value;
            if (formObj.width2.value=='%') {
                width = width + '%';
            }
            if (formObj.height2.value=='%') {
                height = height + '%';
            }

			if (width == "")
				width = 100;

			if (height == "")
				height = 100;

            html += ''
                + '<img src="' + (tinyMCE.getParam("theme_href") + "/images/spacer.gif") + '" '
                + 'width="' + width + '" height="' + height + '" '
                + 'border="0" alt="' + file + '" title="' + file + '" class="mce_plugin_flash" name="mce_plugin_flash" />';
            tinyMCE.execCommand("mceInsertContent",true,html);
            top.close();
        }
    }

    function cancelAction() {
        top.close();
    }

//-->
</script>
</HEAD>
	<body onload="<?=$loadscript;?>">
		<form id="Form1" action="<?=$php_self?>?call=upload" method="post" runat="server" enctype="multipart/form-data">
			<input type=hidden name='file' id="file" runat="server">
        <table border="0" cellpadding="0" cellspacing="4" width="100%">
            <tr>
                <td class="title">Insert / edit Flash Movie</td>
            </tr>
            <tr>
                <td><hr size="1" noshade ></td>
            </tr>
            <tr>
                <td align="center" valign="middle"><table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td align="right">Flash-File (.swf):</td>
                      <td nowrap >
                            <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><input name="src" type="file" id="src" onfocus="this.select();" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 250px" ></td>
                                <td id="browser"></td>
                              </tr>
                            </table>
                        </td>
                    </tr>
		    <tr>
		        <td  align="right">Flash files:</td>
			<td><select name="link_list" style="WIDTH: 250px" id="link_list" runat="server" onchange="this.form.file.value=this.options[this.selectedIndex].value;">
			<option value="" selected>---</option>
			<?=show_files();?>
			</select>
			</td>
		    </tr>

				  <!-- /Link list -->
                    <tr>
                        <td align="right">Size:</td>
                        <td nowrap >
                            <input name="width" type="text" id="width" onfocus="this.select();" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 50px" >
                            <select name="width2" id="width2" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 50px">
                                <option value="" selected>px</option> <OPTION value="%">%</OPTION>
                            </select>&nbsp;x&nbsp;<input name="height" type="text" id="height" onfocus="this.select();" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 50px" >
                            <select name="height2" id="height2" runat="server" style="VERTICAL-ALIGN: middle; WIDTH: 50px">
                                <option value="" selected>px</option> <OPTION value="%">%</OPTION>
                            </select>
                        </td>
                    </tr>
                </table></td>
            <tr>
                <td><hr size="1" noshade ></td>
            </tr>
            <tr>
                <td nowrap align="left">
                    <input style="FLOAT:left" type="button" name="insert" value="Insert" runat="server" onclick="insertFlash();" id="insert"><input type=submit value="Upload" id="Upload" runat="server" style='FONT-WEIGHT:bold' NAME="Upload">&nbsp;<input type="button" name="cancel" value="Cancel" id="cancel" runat="server" onclick="cancelAction();">
                </td>
            </tr>
        </table>
		</form>
	</body>
</HTML>

<?
function show_files()
{
	global $path,$folder_name,$cmtimages;
	print $cmtimages;
	$root = "../../../../../$cmtimages";
		
	
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
			  	if (strpos($file,".swf"))
			  		echo "<option value='../$cmtimages/$file'>$file</option>";
			}
		}
    closedir($handle); 
   }
	
}?>