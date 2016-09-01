function verify()
{
	if(confirm("Are you sure to Delete this record?"))
		return true;
	else
		return false;	
	
}
function validate_settings()
{
frm = document.settings;
if (frm.password.value==''){ alert("Password can't be blank"); frm.pass.focus(); return false }
if (frm.password.value != frm.repass.value){ alert("Passwords do not match"); frm.repass.focus();return false }
if (!validateEmail(frm.email.value)){alert("Please enter the administrator's email address like xxx@yyy.zzz");frm.email.focus();return false;}
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

function validate_frmcategory(frmName){
	var frm = frmName;
	if(frm.catName.value == ""){
		alert("Enter A Category Name");
		frm.catName.focus();
		return false;
	}
}

function validate_adminprofile(frmName){
	var frm = frmName;
	if(frm.username.value == ""){
		alert("Enter A User Name");
		frm.username.focus();
		return false;
	}
	if(frm.email.value == ""){
		alert("Enter A Administrator's Email Address");
		frm.email.focus();
		return false;
	}
	else
	{
		if(!validateEmail(frm.email.value)){
			alert("Not A Vaild Administrator's Email Address")
			frm.email.focus();
			return false;
		}
		
	}
}