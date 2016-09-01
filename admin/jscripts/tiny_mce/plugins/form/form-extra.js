function mceformsrv(fieldname) {
 // tinymce form selected radio value
 var radiogroup = document.mainform.elements[fieldname];
 for(var j = 0 ; j < radiogroup.length ; ++j) {
 if(radiogroup[j].checked)
  return radiogroup[j].value;
 };
 return "false";
};

function mceformsrcfv(fieldname,valtofind) {
 var radiogroup = document.mainform.elements[fieldname];
 for(var j = 0 ; j < radiogroup.length ; ++j) {
  if(radiogroup[j].value == valtofind) {
   radiogroup[j].checked = true;
  } else {
   radiogroup[j].checked = false;
  };
 };
};

function mcestylesArSet() {
 var className = tinyMCE.getWindowArg('className');
 var styleSelectElm = document.mainform.styleSelect;
 var stylesAr = tinyMCE.getParam('theme_advanced_styles', false);
 if (stylesAr) {
  stylesAr = stylesAr.split(';');

  for (var i=0; i<stylesAr.length; i++) {
   var key, value;
   key = stylesAr[i].split('=')[0];
   value = stylesAr[i].split('=')[1];
   styleSelectElm.options[styleSelectElm.length] = new Option(key, value);
   if (value == className)
    styleSelectElm.options.selectedIndex = styleSelectElm.options.length-1;
  }
 } else {
  var csses = tinyMCE.getCSSClasses(tinyMCE.getWindowArg('editor_id'));
  for (var i=0; i<csses.length; i++) {
   styleSelectElm.options[styleSelectElm.length] = new Option(csses[i], csses[i]);
   if (csses[i] == className)
    styleSelectElm.options.selectedIndex = styleSelectElm.options.length-1;
  }
 }
};

function mceformbuildoptarr() {
 // loop thru all of the option elements
 var el = document.mainform.elements;     // short circuit for shorter var names
 var optarr = [];                         // the options array (numeric index)
 var liner = 0;                           // current line counter
 optarr[liner] = [];                      // initialize the line
 var j = document.mainform.counter.value;
 //alert(j);
 for(var i = 0 ; i < el.length ; ++i) {           // look thru all form elements
  //alert(el[i].name);
  if(el[i].name.indexOf("optsel") != -1) {            // is it a optsel radio button
   if(el[i].checked) {                    // if this radio is selected
    optarr[liner]['selected'] = "true";     // set it in the return array
   } else {
    optarr[liner]['selected'] = "false";    // unset it in the return
   };
  } else if (el[i].name.indexOf("optname") != -1) {   // if it is a name (visable label)
   if (el[i].value)
   optarr[liner]['optname'] = el[i].value; // set the return array
  } else if (el[i].name.indexOf("optval") != -1) {     // if it is a value (submit value)
   if (el[i].value)
   optarr[liner]['optval'] = el[i].value; // set the return array
   liner++;                               // increment the line counter
   optarr[liner] = [];                    // initialize the line
  };
  //
 };
 return optarr;
};

function mceformoptsfromoptarr(optarr) {
 var j = document.mainform.counter.value;
 var html = "";
 if (!optarr.length) { return ; };
 for (var i=0; i<optarr.length; i++) {
  if ( optarr[i]['optname'] ) {
   html += "<table width=100%>"
   + "<TR>"
   + "<TD align=center width=70><input type=radio name='optsel' onFocus='mceHelpChange(\"selected\")' onchange='mceUpdateSelectPreview()'></TD>"
   + "<TD><input type=text name=optname" + j + " value='" + optarr[i]['optname'] + "' onFocus='mceHelpChange(\"select_display\")' onchange='mceUpdateSelectPreview()'></TD>"
   + "<TD><input type=text name=optval" + j + " value='" + optarr[i]['optval'] + "' onFocus='mceHelpChange(\"select_submitted\")' onchange='mceUpdateSelectPreview()'></TD>"
   + "</TR>"
   + "</Table>";
   j++
  };
 };
 document.getElementById('dynatext').innerHTML += html;
 document.mainform.counter.value = j;
 TinyMCEPopup_autoResize();
};

function mceformSayNewOpts() {
 var i = document.mainform.counter.value;
 var html = "<table width=100%>"
  + "<TR>"
  + "<TD align=center width=70><input type=radio name='optsel' onFocus='mceHelpChange(\"selected\")' onchange='mceUpdateSelectPreview()'></TD>"
  + "<TD><input type=text name=optname" + i + " onFocus='mceHelpChange(\"select_display\")' onchange='mceUpdateSelectPreview()'></TD>"
  + "<TD><input type=text name=optval" + i + " onFocus='mceHelpChange(\"select_submitted\")' onchange='mceUpdateSelectPreview()'></TD>"
  + "</TR>"
  + "</Table>";
 document.getElementById('dynatext').innerHTML += html;
 i++;
 document.mainform.counter.value = i;
 TinyMCEPopup_autoResize();
};

function mceHelpOnOff() {
 var state = document.getElementById('helpstate').innerHTML;
 if ( state == "On") {
  var html = "<table border=1 width=400>"
   + "<tr><td align=center>"
   + tinyMCE.getLang('lang_help_desc', 'Help')
   + "</td></tr>"
   + "<tr>"
   + "<td id='helptext'>"
   + tinyMCE.getLang('lang_form_help_default', '', false)
   + "</td>"
   + "</tr>"
   + "<tr>"
   + "<td>"
   + "Most of this help provided by the awsome <a href='http://www.htmlcodetutorial.com' target='new' tabindex=101>htmlcodetutorial.com</a>"
   + "</td>"
   + "</tr>"
   + "</table>";
  document.getElementById('help').innerHTML = html;
  document.getElementById('helpstate').innerHTML = "Off";
 } else {
  document.getElementById('help').innerHTML = "";
  document.getElementById('helpstate').innerHTML = "On";
 };
 TinyMCEPopup_autoResize();
};


function mceHelpChange(fhelp,pre) {
 var state = document.getElementById('helpstate').innerHTML;
 if (pre == 1) {
  var helpvar = fhelp;
 } else {
  var helpvar = "lang_"
   + document.getElementById('helpcat').innerHTML
   + fhelp
 };
 if ( state == "Off") {
  document.getElementById('helptext').innerHTML = tinyMCE.getLang(helpvar, 'No Help Available', false);
  TinyMCEPopup_autoResize();
 };
};

function mceUpdateSelectPreview() {
  var frm = document.mainform;
  var pre = document.preform.cool;
  pre.name = frm.field_name.value;
  pre.size = frm.field_size.value;
  if (mceformsrv('field_multiple') == "true") {
   pre.multiple = true;
  } else {
   pre.multiple = false;
  };
  if (mceformsrv('field_disa') == "true") {
   pre.disabled = true;
  } else {
   pre.disabled = false;
  };
  var optarr=mceformbuildoptarr();
  // remove all the previous options
  if (pre.options.length) {
   for (var i=0; i<pre.options.length; i++) {
    pre.removeChild(pre.options[i]);
   };
  };
  if (pre.options.length) {
   pre.removeChild(pre.options[0]);
  };

  // add the new ones
  for (var i=0; i < optarr.length; i++) {
   if (optarr[i]['optname']) {
    var newOpt = document.createElement("option");
    if (optarr[i]['optval'])
     newOpt.value=optarr[i]['optval'];
    if (optarr[i]['optname'])
     newOpt.innerHTML = optarr[i]['optname'];
    if (optarr[i]['selected'] == "true")
     newOpt.selected = true;
    pre.appendChild(newOpt);
   };
  };
  
};

function mceUpdateCheckboxPreview() {
  var frm = document.mainform;
  var pre = document.preform.cool;
  pre.name = frm.field_name.value;
  pre.value = frm.field_value.value;
  if (mceformsrv('field_checked') == "true") {
   pre.checked = true;
  } else {
   pre.checked = false;
  };
  if (mceformsrv('field_disa') == "true") {
   pre.disabled = true;
  } else {
   pre.disabled = false;
  };
};

function mceUpdateTextPreview() {
  var frm = document.mainform;
  var pre = document.preform.cool;
  pre.name = frm.field_name.value;
  if (frm.field_type.value == "text")
   pre.value = frm.field_value.value;
  pre.maxlength = frm.field_maxlen.value;
  pre.size = frm.field_size.value;
  if (mceformsrv('field_auto') == "true") {
   pre.autocomplete = true;
  } else {
   pre.autocomplete = false;
  };
  if (mceformsrv('field_disa') == "true") {
   pre.disabled = true;
  } else {
   pre.disabled = false;
  };
};

function mceUpdateButtonPreview() {
  var frm = document.mainform;
  var pre = document.preform.cool;
  pre.name = frm.field_name.value;
  if (frm.field_type.value != "file")
   pre.value = frm.field_value.value;
  if (mceformsrv('field_disa') == "true") {
   pre.disabled = true;
  } else {
   pre.disabled = false;
  };
};
