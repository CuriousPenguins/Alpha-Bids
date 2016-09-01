 <head>
    <title>Web Admin Panel</title>
    <link rel='stylesheet' type='text/css' href='include/default.css'>
    	<script language=javascript>
		function setheight()
		{
			var mainFrHt;
			mainFrHt = parent.document.all.main.style.height;
			if(mainFrHt.indexOf("px")>0){
				mainFrHt = mainFrHt.replace("px","");
			}
			if(mainFrHt <= document.body.scrollHeight+5){
				parent.document.all.main.style.height=document.body.scrollHeight+5;
			}
		}
	</script> 
	<Script Language='JavaScript' src='admin.js'></Script> 
  </head>
