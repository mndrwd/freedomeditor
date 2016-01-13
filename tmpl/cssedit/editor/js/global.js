// all functions written by B Bosma (author of freedomeditor.com), except when explicitely defined.

// first var inits 

// user customizable 
cookielimit='3500'; // make smaller when opening too much tabs give 400 error
bitfluxlocation='core_clients/editor/bxe'; // allows to move around bitflux anywhere on your webserver
doublequote="\"";
keybtimeout=300; // timeout for hotkeys in ms (default 0,3sec)
preview_img='yes';
// note: more customizable vars can be found in index.html body onload including some php vars which are used by javascript


// uncustomizable code vars direct init required:
idleTime = 0;
tabtext=[];
tabray = [];
ltabmfirsttime='on';
hidethatlastelemenu='mainele_0';
amt=0;


/*
 
 // this stuff is stupid cause sometimes it breaks with backgroundimage overlapping everything, forcing need of a page refresh
 //
function timerIncrement() {
	
    idleTime = idleTime + 1;
	if (idleTime==2){
				document.getElementById('bgimage').style.opacity=1;
	document.getElementById('bgimage').style.filter='alpha(opacity=100)';	
		document.getElementById('bgimage').style.zIndex='10';}
}


jQuery(this).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval("timerIncrement()", 60000); // 1 minute
	
    //Zero the idle timer on mouse movement.
    jQuery(this).mousemove(function (e) {
	document.getElementById('bgimage').style.opacity='0.4';
	document.getElementById('bgimage').style.filter='alpha(opacity=40)';	
	document.getElementById('bgimage').style.zIndex='-10';
        idleTime = 0;
    });
    jQuery(this).keypress(function (e) {
			document.getElementById('bgimage').style.opacity='0.4';
	document.getElementById('bgimage').style.filter='alpha(opacity=40)';	
	document.getElementById('bgimage').style.zIndex='-10';
        idleTime = 0;
    });
	

});

*/

function initvars() { // body onload var inits

// backgroundcookie
 document.getElementById('bgimage').style.backgroundImage="url("+readCookie('bgimage')+")";	


// attach keyboard shortcuts
   jQuery(document).bind('keydown','ctrl+space', function(){if (amt==0){setTimeout("amt=0;",keybtimeout); document.getElementById('cmstags2').focus();amt=1;       }});
	jQuery(document).bind('keydown','ctrl+home', function(){
		if (amt==0){oldfolder=document.getElementById('folderinputter').value;jQuery('#mainmenu').load('./?'+ajaxurlvar+'=mainmenu&fd=/../');setTimeout("amt=0;",keybtimeout);amt=1;   }});
	jQuery(document).bind('keydown','ctrl+end', function(){if (amt==0){setTimeout("amt=0;",keybtimeout);amt=1; if (oldfolder!='') {jQuery('#mainmenu').load('./?'+ajaxurlvar+'=mainmenu&fd='+oldfolder);} }  });
  jQuery(document).bind('keydown','ctrl+backspace', function(){if (amt==0){jQuery('#mainmenu').load(document.getElementById('urlke').value + '&go=..');setTimeout("amt=0;",keybtimeout);amt=1;   }});
  jQuery(document).bind('keydown','ctrl+left', function(){ keyleft();setTimeout("amt=0;",keybtimeout);amt=1;   });
  jQuery(document).bind('keydown','ctrl+right', function(){ keyright();setTimeout("amt=0;",keybtimeout);amt=1;    });
  jQuery(document).bind('keydown','alt+f5', function(){if (amt==0){setTimeout("amt=0;",keybtimeout);amt=1; jQuery('#mainmenu').load(document.getElementById('urlke').value);   }});
  jQuery(document).bind('keydown','alt+f6', function(){if (amt==0){setTimeout("amt=0;",keybtimeout);amt=1; document.getElementById('folderinputter').focus();document.getElementById('folderinputter').select();}});
	jQuery(document).bind('keydown','alt+f7', function(){if (amt==0){setTimeout("amt=0;",keybtimeout);amt=1; document.getElementById('structfltr').focus();document.getElementById('structfltr').select();}});


latestfailtab=0;
reinittabs='off';
checktrlbtn= 'yes';
checktrlbtn2='yes';
currtab='';
removetab='off';
idofeditor='editeleconti';
inphex='inphex';
pastefromlocation='';
stpd=0; // default for previewer
oldfolder='';
nav =''; // tiny edit_area bug, missing a var init + no proper check
closealltabs='<span title="'+close_all_tabs+'?" onclick="var x=window.confirm(\''+ close_all_tabs + '?\');if (x){createCookie(readCookie(\'tabcooked\'), \'\', 365);tabray=[];tabtext=[]; reinittabs=\'on\';ltabmfirsttime=\'on\';latestfailtab=0;} ">Tabs</span>	:	';
oldsrch='';
// end default vars
	
initupload(); // structure > file uploader

// FUN WITH COOKIES, COOKIE REESHING AND DEFAULT VALUES 




// project cookie
document.getElementById('groupsofcookies').value="";
if (!readCookie('groupsofcookies')){

eraseCookie('groupsofcookies');
createCookie('groupsofcookies', '', 365);
}else{
document.getElementById('groupsofcookies').value=readCookie('groupsofcookies');
}
if (!readCookie('groupsofcookies')){
createCookie('groupsofcookies', '', 365);
}else{
createCookie('groupsofcookies', readCookie('groupsofcookies'), 365);
}


// color cookie
document.getElementById('clrcknm').value="colorgroup1";

if (!readCookie('ckinm')){
createCookie('ckinm', 'colorgroup1', 365);

}else{
document.getElementById('clrcknm').value=readCookie('ckinm');
}
if (!readCookie(readCookie('ckinm'))){
createCookie(document.getElementById('clrcknm').value, '', 365);
}else{
createCookie(document.getElementById('clrcknm').value, readCookie(document.getElementById('clrcknm').value), 365);
}

// tabs cookie
document.getElementById('tabcooked').value="tabgroup1";
if (!readCookie('tabcooked')){

eraseCookie('tabcooked');
createCookie('tabcooked', 'tabgroup1', 365);
}else{
document.getElementById('tabcooked').value=readCookie('tabcooked');
}
if (!readCookie(readCookie('tabcooked'))){
createCookie(document.getElementById('tabcooked').value, '', 365);
}else{
createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value), 365);
}


// previewurl cookie
document.getElementById('previewurl').value="http://";
if (!readCookie('previewurl')){

eraseCookie('previewurl');
createCookie('previewurl', 'http://', 365);
}else{
document.getElementById('previewurl').value=readCookie('previewurl');
}
if (!readCookie('previewurl')){
createCookie('previewurl', '', 365);
}else{
createCookie('previewurl', readCookie('previewurl'), 365);
}



// tinymcecooker cookie
document.getElementById('tinymcecooker').value="tinymce1";
if (!readCookie('tinymcecooker')){

eraseCookie('tinymcecooker');
createCookie('tinymcecooker', 'tinymce1', 365);
}else{
document.getElementById('tinymcecooker').value=readCookie('tinymcecooker');
}
if (!readCookie(readCookie('tinymcecooker'))){
createCookie(document.getElementById('tinymcecooker').value, '', 365);
}else{
createCookie(document.getElementById('tinymcecooker').value, readCookie(document.getElementById('tinymcecooker').value), 365);
}

// previewimg cookie
document.getElementById('previewimg').value="yes";
if (!readCookie('previewimg')){

eraseCookie('previewimg');
createCookie('previewimg', 'yes', 365);
}else{
document.getElementById('previewimg').value=readCookie('previewimg');
}
if (!readCookie('previewimg')){
createCookie('previewimg', '', 365);
}else{
createCookie('previewimg', readCookie('previewimg'), 365);
}


// previewimg cookie
document.getElementById('easynav').value="yes";
if (!readCookie('easynav')){

eraseCookie('easynav');
createCookie('easynav', 'yes', 365);
}else{
document.getElementById('easynav').value=readCookie('easynav');
}
if (!readCookie('easynav')){
createCookie('easynav', '', 365);
}else{
createCookie('easynav', readCookie('easynav'), 365);
}




	
	
// binary cookies
if (!readCookie('phpbinary')) {
	createCookie('phpbinary', '/usr/local/bin/php', 365);
	}else{
	createCookie('phpbinary', readCookie('phpbinary'), 365);
}
if (!readCookie('zipbinary')  ) {
	createCookie('zipbinary', '/usr/local/bin/zip', 365);
	}else{
	createCookie('zipbinary', readCookie('zipbinary'), 365);
}
	
if (!readCookie('fontforgebinary')) {
	createCookie('fontforgebinary', '/usr/local/bin/fontforge', 365);
	}else{
	createCookie('fontforgebinary', readCookie('fontforgebinary'), 365);
}
if (!readCookie('ttf2eotbinary')) {
	createCookie('ttf2eotbinary', '/usr/local/bin/ttf2eot', 365);
	}else{
	createCookie('ttf2eotbinary', readCookie('ttf2eotbinary'), 365);
}


if (!readCookie('ps2pdfbinary')) {
	createCookie('ps2pdfbinary', 'usr/local/bin/ps2pdf', 365);
	}else{
	createCookie('ps2pdfbinary', readCookie('ps2pdfbinary'), 365);
}

if (!readCookie('antiwordbinary')) {
	createCookie('antiwordbinary', '/usr/local/bin/antiword', 365);
	}else{
	createCookie('antiwordbinary', readCookie('antiwordbinary'), 365);
}



// other cookies

if (!readCookie('aateau')) {
	createCookie('aateau', '/bin/aateau.sh', 365);
	}else{
	createCookie('aateau', readCookie('aateau'), 365);
}

if (!readCookie('phplivedocx')) {
	createCookie('phplivedocx', '/bin/phplivedocx.php', 365);
	}else{
	createCookie('phplivedocx', readCookie('phplivedocx'), 365);
}



if (!readCookie('httproot')) {
createCookie('httproot', 'http://localhost/',  365);
	}else{
	createCookie('httproot', readCookie('httproot'), 365);
}

if (!readCookie('wwwroot')){
createCookie('wwwroot', readCookie('wwwroot'), 365);
}else{
	createCookie('wwwroot', readCookie('wwwroot'), 365);
}


if (!readCookie('previewimg')){
createCookie('previewimg', readCookie('previewimg'), 365);
}else{
	createCookie('previewimg', readCookie('previewimg'), 365);
}


document.getElementById('phpbinary').value=readCookie('phpbinary');
document.getElementById('zipbinary').value=readCookie('zipbinary');
document.getElementById('fontforgebinary').value=readCookie('fontforgebinary');
document.getElementById('ttf2eotbinary').value=readCookie('ttf2eotbinary');
document.getElementById('ps2pdfbinary').value=readCookie('ps2pdfbinary');
document.getElementById('antiwordbinary').value=readCookie('antiwordbinary');

document.getElementById('wwwroot').title=readCookie('wwwroot');
document.getElementById('httproot').value=readCookie('httproot');
document.getElementById('previewurl').value=readCookie('previewurl');
document.getElementById('aateau').value=readCookie('aateau');
document.getElementById('phplivedocx').value=readCookie('phplivedocx');
document.getElementById('previewimg').value=readCookie('previewimg');

// COOKIES ALSO IN HERE
document.getElementById('curr_folder').value=document.getElementById('folderinputter').value;	
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpdrupal', 'ch_d');
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpjoomla', 'ch_j');
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpxoops', 'ch_x');
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpcss', 'ch_css');

// ------------------



	

if ( readCookie('translate_editfield' ) == 'on' ) {
document.getElementById('trlback').checked=true;
createCookie('translate_editfield', 'on', 365);
document.getElementById('translate_editfield').checked=true;
document.getElementById('translation_icon').src=enable_translation_icon;
	} else {
	document.getElementById('trlback').checked=false;	document.getElementById('translate_editfield').checked=false;
createCookie('translate_editfield', 'off', 365);	
document.getElementById('translation_icon').src=disable_translation_icon;
}

/* load colors from cookie*/
if (readCookie(readCookie('ckinm'))){
lastcolr=readCookie(readCookie('ckinm')).split(',');
lastcolor=lastcolr[0];

for (clr in lastcolr) {
if (lastcolr[clr]!=''){
jQuery('#colorsmemory').prepend('<div class=\'memboxes\' style=\'background-color:'+lastcolr[clr]+';color:#000000\' title=\''+lastcolr[clr]+'\' onclick=\'editAreaLoader.setSelectedText(idofeditor, this.title);self.focus();document.getElementById(idofeditor).focus()\'></div>');
}}
}else{
createCookie(readCookie('ckinm'), ' ', 365);
lastcolor='';}
/* end color load
 */

 
 /* get ext_link array*/
 extlists=[];
$.getJSON('./?'+ajaxurlvar+'=jsonextlink',  function(data){

 $.each(data.items, function(i,item){
 extlists[item.ext]=item.extl;
});
});



// apply hovers
  $('.highlight').mouseover(function(){
	      $(this).addClass('hover');
	   });
	         
	   $('.highlight').mouseout(function(){
	      $(this).removeClass('hover');
	   });


}


function initmenu() {
 var temp=tcmiej(readCookie("mainmenu"));
  togglecurrent=temp;
    menuitem(tcmie);
switchMenu(temp);
}



function goleft(valu)
{
	if (valu == "tb" ) {
    return ('ta');}
	if (valu == "tc" ) {
    return ('tb');}
	if (valu == "td" ) {
    return ('tc');}
    return (valu);
}

function goright(valu)
{
	
  if (valu == "tc" ) {
    return ('td');}
	if (valu == "tb" ) {
    return ('tc');}
  if (valu == "ta" ) {
    return ('tb');}
  return (valu);
  
}
function keyleft(){
	if (amt==0){
  var tempsia = tcmie;
 tcmiej(goleft(tcmie));
 var tempsib = tcmie;
 tcmie = tempsia;
togglem(toggler);
togglemi(tempsib);
createCookie('mainmenu', tcmie, 365); 
amt=amt+1;
}}

function keyright(){
		if (amt==0){
  var tempsia = tcmie;
 tcmiej(goright(tcmie));
 var tempsib = tcmie;
 tcmie = tempsia;
togglem(toggler);
togglemi(tempsib);
createCookie('mainmenu', tcmie, 365); 
amt=amt+1;
		}
}


function tcmiej(val){
  tcmie=val;
  if (tcmie == 'ta' )
    {
      var temp = 'mainmenu';  
    }else if ( tcmie == 'tb' ) 
       {
	 var temp = 'box_content';
       }else if ( tcmie == 'tc' ) 
       {
	 var temp = 'box_right';   
        }else if ( tcmie == 'td' ) 
       {
	 var temp = 'toolbox';
       }else {
   var temp = 'mainmenu';
   tcmie='ta';
 }
  toggler = temp;
  return(temp);
}

 
function togglem(tc){
  if (tc != togglecurrent ) {
	
	
	if(typeof window.ineedtocheckforhtmltag == 'function') {
	ineedtocheckforhtmltag();}
  if (checktrlbtn == 'yes'){
  
  if (document.getElementById('current_ele_name').value != null && document.getElementById('current_ele_name').value != '' && latestfailtab==0){
	
	if (readCookie(document.getElementById('tabcooked').value).search(escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value)==-1)
	{
tabtext[escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value]=document.getElementById('editeleconti').value;
tabray[escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value]=document.getElementById('formedit').innerHTML;
createCookie(document.getElementById('tabcooked').value, escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value + '_AXC_nexttab_CXA_'+readCookie(document.getElementById('tabcooked').value).substr(0,cookielimit), 365);
}
}

jQuery(document).ready(function(){ 
  jQuery('#tabmenu').mouseenter(function() {
	 jQuery('#tabmenu').empty();
 jQuery('#tabmenu').append(closealltabs);
ltabm('#tabmenu', '#formedit', tabray);

}).mouseleave(function(){

 jQuery('#tabmenu').empty();
 jQuery('#tabmenu').append(closealltabs);
 });
 
 });

  if ( readCookie('translate_editfield' ) == 'on' ) {
document.getElementById('trlback').checked=true;
createCookie('translate_editfield', 'on', 365);
document.getElementById('translate_editfield').checked=true;
document.getElementById('translation_icon').src=enable_translation_icon;

	} else {
document.getElementById('trlback').checked=false;	
document.getElementById('translate_editfield').checked=false;
createCookie('translate_editfield', 'off', 365);	
document.getElementById('translation_icon').src=disable_translation_icon;
}
checktrlbtn='no';
}
  
    switchMenu(togglecurrent);
    switchMenu(tc);
    togglecurrent = tc;
  }
  
  
  return;
}

function togglemi(idd){
  if (tcmie != idd ) {
  menuitem(tcmie);
  menuitem(idd);
  tcmie = idd;
  }
  return;
}


function closeemall(ee){
	
	try {
tinyMCE.execCommand('mceRemoveControl', false, ee);		

}
	catch(e){
	}

	
	try {

		editAreaLoader.delete_instance(ee);
	
}
	catch(e){
	}

editarwrap();
}





	


function menuitem(obj){
  var el = document.getElementById(obj); 
 if ( el == '' ) {
    var el = parent.document.getElementById(obj);}
  if ( el.style.backgroundColor != 'rgb(204, 204, 204)' ){
    el.style.backgroundColor = '#CCCCCC';
}
  else {
    el.style.backgroundColor = '#FFFFFF';
  }
  return;
}

function switchMenu(obj) {
var el = document.getElementById(obj);
  if ( el == '' ) {
    var el = parent.document.getElementById(obj);}

//alert(el.style.display);
if ( document.getElementById(obj).style.display != 'block' ) {
document.getElementById(obj).style.display = 'block';
}
else {
document.getElementById(obj).style.display = 'none';
}

 return;
}

function sendwrap(val){
if (typeof(window['area']) != 'undefined') {
  sendText(area.textarea, unescape(val));}
	countclik(document.forms['bogus3'].editelecont);sendText2(document.getElementById('editeleconti'),  unescape(val));self.focus();document.forms['bogus3'].editelecont.focus();
  }



function sendText2(e, text)
{
   e.value += text
}


function readck(){
var x = readCookie('ckinm');
if (x) {
document.forms['clrcknm'].ckinm.value= x; 
}

}

function iObject() {
  this.i;
  return this;
}

var myObject=new iObject();
myObject.i=0;
var myObject2=new iObject();
myObject2.i=0;
store_text=new Array();

//store_text[0] store initial textarea value
store_text[0]="";


// cool jquery stuff

function inptagload(id, chid){
switched=id.split('______');
if (readCookie(id) =='on'){

switchMenu(switched[1]);
document.getElementById(chid).checked=true;
if (document.getElementById(switched[1]).style.display != 'block'){
document.getElementById(switched[1]).style.display = 'block';

}
}else{
if (document.getElementById(switched[1])){
document.getElementById(switched[1]).style.display = 'none';
}}}

function inptags(id){
switched=id.split('______');
switchMenu(switched[1]);
if (readCookie(id) !='on'){
createCookie(id, 'on', 365);
}else{
createCookie(id, 'off', 365);
}
}
 


function ltabm(location, location2)
{
if (ltabmfirsttime=='on'){

if (readCookie(document.getElementById('tabcooked').value)){

tabzz=readCookie(document.getElementById('tabcooked').value).split('_AXC_nexttab_CXA_');

for (tab in tabzz) {
if (tabzz[tab] && tabzz[tab].search(' - : _ : - ')!=-1){
folderfile=tabzz[tab].split(' - : _ : - ');

folderfile[1]=folderfile[1].replace('_AXC_nexttab_CXA_', '');
//if (readCookie(document.getElementById('tabcooked').value).search(document.getElementById('curr_folder').value +' - : _ : - '+ document.getElementById('current_ele_name').value)==-1)
//{
tabray[folderfile[0] +' - : _ : - '+ folderfile[1]]='';
}
}}}

donetabs='';
donetabs=[];
for (i in tabray) {
ltabmfirsttime='off';

 if (donetabs.toString().search(i)==-1){
 donetabs.push(i);

if (i !='null - : _ : - undefined' && i.search('_AXC_nexttab_CXA_')== -1 && i.search('undefined')== -1){
folderfile=i.split(' - : _ : - ');
if (folderfile[1]!= '_AXC_nexttab_CXA_'){ 
if (document.getElementById('current_ele_name').value == folderfile[1]){
}   
if (folderfile[1] != '' && folderfile[1] != ' '){

var appendthis ='<span title="'+folderfile[0].replace('%3A', ':').replace(/%5C/g, '/')+'/'+folderfile[1]+'"';

if (document.getElementById('curr_folder').value +' - : _ : - '+ document.getElementById('current_ele_name').value == i ) {
var appendthis = appendthis + ' style="color:blue;"';
prevtabclr="blue";
}else{
var appendthis = appendthis + ' style="color:black;"';
prevtabclr="black";
}
var appendthis= appendthis + ' class="highlight" onclick="switchtab(\'' + i + '\', \'' + location + '\',  \'' + location2 + '\');" onmouseover="this.style.color=\'green\';" onmouseout="this.style.color=\''+prevtabclr+'\';">' + folderfile[1]+	 '</span>	 <span class="highlight" onclick="delete tabray[\'' +i +'\'];delete tabtext[\'' +i +'\']; createCookie(document.getElementById(\'tabcooked\').value, readCookie(document.getElementById(\'tabcooked\').value).replace(\''+i+'_AXC_nexttab_CXA_\', \'\'), 365);" style="color:red;">X</span> <b>|||</b> ';
   jQuery(location).append
(appendthis)	 

}else{
//createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value).replace(i, ''), 365);
}
}else{
createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value).replace(i, ''), 365);
}
}else{
//createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value).replace(i, ''), 365);
}
}else{
//createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value).replace(i, ''), 365);
}
}
createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value).replace(/_AXC_nexttab_CXA_  _AXC_nexttab_CXA_/g, '_AXC_nexttab_CXA_'), 365);
createCookie(document.getElementById('tabcooked').value, readCookie(document.getElementById('tabcooked').value).replace(/_AXC_nexttab_CXA_ _AXC_nexttab_CXA_/g, '_AXC_nexttab_CXA_'), 365);
}

function switchtab(item, location, location2)
{
jQuery(location).empty();
jQuery(location).append(closealltabs);
//editarwrap();

close_wysiwyg_markup();
document.getElementById('inp1').checked=false;
document.getElementById('inp2').checked=false;
document.getElementById('inp3').checked=false;

if (latestfailtab==0){
tabtext[escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value]=document.getElementById('editeleconti').value;
tabray[escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value]=document.getElementById('formedit').innerHTML;
if (readCookie(document.getElementById('tabcooked').value).search(escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value)==-1){
if (document.getElementById('current_ele_name').value.length > 0 && document.getElementById('curr_folder').value.length > 0 ) {
createCookie(document.getElementById('tabcooked').value, escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value + '_AXC_nexttab_CXA_'+readCookie(document.getElementById('tabcooked').value).substr(0,cookielimit) , 365);
}}

var thisstuf = tabray[item];

if (!thisstuf || thisstuf.length == 0 ) {
var folderfile=item.split(' - : _ : - ');


jQuery('#formedit').load('./?'+ajaxurlvar+'=editor&fd='+escape(unescape(folderfile[0]))+'&ele='+escape(folderfile[1])+'&fn='+escape(folderfile[1]), function()
{
removejscssfile(tmplfolder + '/js/' + document.getElementById('cmmid').options[document.getElementById('cmmid').selectedIndex].value + '.js', 'js');
current_ext=item.split('.').pop().toLowerCase();
current_extlink= extlists[item.split('.').pop().toLowerCase()];
if (current_extlink=='css-leg'){
	jQuery('.css_legacy').show();
}else{
$('.css_legacy').hide();
}
loadjscssfile(tmplfolder + '/js/'+current_extlink+'.js', 'js');
//if (readCookie(document.getElementById('tabcooked').value).search(document.getElementById('curr_folder').value +' - : _ : - '+ document.getElementById('current_ele_name').value)==-1)
//{
tabray[escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value]=document.getElementById('formedit').innerHTML;
//}

  jQuery('#tabmenu').mouseenter(function() {
//	if (readCookie(document.getElementById('tabcooked').value).search(document.getElementById('curr_folder').value +' - : _ : - '+ document.getElementById('current_ele_name').value)==-1){
	tabray[escape(unescape(document.getElementById('curr_folder').value)) +' - : _ : - '+ document.getElementById('current_ele_name').value]=document.getElementById('formedit').innerHTML;
//	}



ltabm('#tabmenu', '#formedit');

}).mouseleave(function(){

 jQuery('#tabmenu').empty();
 jQuery('#tabmenu').append(closealltabs);
 
if(typeof window.ineedtocheckforhtmltag == 'function') {
 ineedtocheckforhtmltag();
 }
 });
});

}
else{
jQuery(location2).empty();
jQuery(location2).append(thisstuf);
}
}
jQuery(document).ready(function(){ 

jQuery(location).empty();
jQuery(location).append(closealltabs);
document.getElementById('source_of_js_stuff').className=document.getElementById('source_of_js_stuff').className.replace('processed', '');
document.getElementById('lookeitsdestiny').className=document.getElementById('lookeitsdestiny').className.replace('processed', '');
document.getElementById('editeleconti').className=document.getElementById('editeleconti').className.replace('processed', '');
jQuery('.grippie').detach();
  jQuery('#tabmenu').mouseenter(function() {
ltabm('#tabmenu', '#formedit');

}).mouseleave(function(){

 jQuery('#tabmenu').empty();
 jQuery('#tabmenu').append(closealltabs);
 });
 
 if (tabtext[item]){
 document.getElementById('editeleconti').value=tabtext[item]; }
 
 removejscssfile(tmplfolder + '/js/' + document.getElementById('cmmid').options[document.getElementById('cmmid').selectedIndex].value + '.js', 'js');
current_ext=item.split('.').pop().toLowerCase();
current_extlink= extlists[item.split('.').pop().toLowerCase()];
loadjscssfile(tmplfolder + '/js/'+current_extlink+'.js', 'js');
 
jQuery(document).ready(function(){ 
if (typeof current_extlink == 'undefined'){
jQuery('.css_legacy').hide();
}else{
	if (current_extlink=='css-leg'){
	jQuery('.css_legacy').show();
}else{
jQuery('.css_legacy').hide();
}
}

});
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpdrupal', 'ch_d');
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpjoomla', 'ch_j');
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpxoops', 'ch_x');
inptagload(unescape(document.getElementById('curr_folder').value) + document.getElementById('current_ele_name').value + '______inpcss', 'ch_css');
 if ( readCookie('translate_editfield' ) == 'on' ) {
document.getElementById('trlback').checked=true;
createCookie('translate_editfield', 'on', 365);
document.getElementById('translate_editfield').checked=true;
document.getElementById('translation_icon').src=enable_translation_icon;

	} else {
document.getElementById('trlback').checked=false;	
document.getElementById('translate_editfield').checked=false;
createCookie('translate_editfield', 'off', 365);	
document.getElementById('translation_icon').src=disable_translation_icon;
}
checktrlbtn='no';


// not sure yet if this can be commented out (prolly not)
doform('#bogus3', '#formedit');
 doform('#structfilter', '#mainmenu');

$('#colorpicker').farbtastic('#inphex');			
doform('#clrcknm', '#formcolor'); 

	
 });
jQuery(document).ready(function(){ 
						jQuery('textarea.resizable:not(.processed)').TextAreaResizer();
						});

					
}
jQuery(document).ready(function() {
doform('#bogus3', '#formedit');
 doform('#structfilter', '#mainmenu');

$('#colorpicker').farbtastic('#inphex');			
doform('#clrcknm', '#formcolor'); 
		jQuery('#previewer').resizable();
$('textarea.resizable:not(.processed)').TextAreaResizer();


});

jQuery(document).ready(function(){ 
jQuery('#tabmenu').mouseenter(function() {

ltabm('#tabmenu', '#formedit');

}).mouseleave(function(){

 jQuery('#tabmenu').empty();
 jQuery('#tabmenu').append(closealltabs);
 });
});



function close_wysiwyg_markup(){
document.getElementById('inp1').checked=false;
document.getElementById('inp2').checked=false;
document.getElementById('inp3').checked=false;

if (tinyMCE) { 
tinyMCE.execCommand('mceRemoveControl', false, 'editeleconti');
}
 if ( document.editAreaLoader ) {
editAreaLoader.delete_instance('editeleconti');	}

}




// structure > file uploader

function initupload(){
	// init that uh u know, file uploader thing
	
		$(document).ready(function() {
	jQuery('#uploadify').uploadify({
		'uploader'       : tmplfolderori+'../js/jquery/jquery.uploadify/uploadify.swf',
		'script'         : tmplfolderori+'../js/jquery/jquery.uploadify/uploadify.php?foldor='+unescape(document.getElementById('folderinputter').value),
		'cancelImg'      : tmplfolderori+'../js/jquery/jquery.uploadify/example/cancel.png',
		'queueID'        : 'fileQueue',
		'auto'           : true,
		'multi'          : true
	});
});	
}





//decide which options to show for which files in structure view



function initifilemenu(extl){
/*
$('.newtab').hide();
$('.newtabmd').hide();
$('.openfile').hide();
$('.downloadfile').hide();
*/
if (typeof extl == 'undefined'){

}else{
if (extl =='archive' || extl=='fonts' || extl=='livedocx'){
$('.downloadfile').show();
return 'no';
}




if (extl.search('htm')!= -1 || extl.search('css')!= -1 || extl=='js' || extl.search('php')!= -1 || extl=='fonts' || extl=='txt' || extl=='xml' || extl=='pdf'){

	if (extl != 'fonts'){
	$('.newtab').show();
$('.newtabmd').show();
$('.openfile').show();
return 'yes';
}
return 'no';
}


if (extl =='img'){
$('.openfile').show();
}}
return 'yes';
}




// CSS-legacy mode

jQuery(document).ready(function(){ 
if (typeof current_extlink == 'undefined'){
jQuery('.css_legacy').hide();
}else{
	if (current_extlink=='css-leg'){
	jQuery('.css_legacy').show();
}else{
jQuery('.css_legacy').hide();
}
}

});






// thx to phpjs.org
function rawurlencode (str) {
    // http://kevin.vanzonneveld.net
    // +   original by: Brett Zamir (http://brett-zamir.me)
    // +      input by: travc
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Michael Grier
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Ratheous
    // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Joris
    // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
    // %          note 1: This reflects PHP 5.3/6.0+ behavior
    // %        note 2: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
    // %        note 2: pages served as UTF-8
    // *     example 1: rawurlencode('Kevin van Zonneveld!');
    // *     returns 1: 'Kevin%20van%20Zonneveld%21'
    // *     example 2: rawurlencode('http://kevin.vanzonneveld.net/');
    // *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
    // *     example 3: rawurlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
    // *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
    str = (str + '').toString();

    // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
    // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
    replace(/\)/g, '%29').replace(/\*/g, '%2A');
}

