// -------------------------------
// thanks to Ross Shannon, author of yourhtmlsource.com, http://yourhtmlsource.com/javascript/cookies.html

function eraseCookie(name)
{
  createCookie(name, "", -1);
}

//
function createCookie(name, value, days)
{
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
    }
  else var expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}


// thanks to http://www.quirksmode.org/js/cookies.html
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}



// --------------------------------

// thanks to catbert303
// at http://board.flashkit.com/board/archive/index.php/t-713313.html
// not sure if its actually still being used but i left it here for lazyness' sake
function get_selection(fromke) {
if (document.selection) { // for IE
var varx=document.selection.createRange().text;
}
 else if (typeof document.from.selectionStart != 'undefined') { // for FF, Opera etc...
var varx=document.from.value.substring(document.from.selectionStart, document.from.selectionEnd);
 } 

 return varx;
}

// quick ajax support wrappers by Bart Bosma (author of freedomeditor.com) using jQuery
// method not false will force a POST


function insertdatah(data, selector){
  $(selector).html(data);
}


// written by B Bosma, author of freedomeditor.com

function doform(formid, targetti){

  jQuery(formid).livequery('click', function() {
    var options1 = {
      target: targetti
    };
    jQuery(formid).ajaxForm(options1);
			     });

}

/*
function jqyformWrap(form, output){
  alert('fdsjlfhds');
  var options = {
    target: output

  };
  $(form).submit(function() {
	       $(this).ajaxSubmit(options);
	       alert('tesktjdshgkds');
	       return false;
		 });
}
*/


// only method false usable
function ajqryax(clickid, replid, withurl, method){
  if (method == '' ) var method = 'false';
  //  $(document).ready(function(){
  $(clickid).click(function() {

		     if (method == 'false') {
		       		     $(replid).load(withurl);
		     return false;
		     } 
		     else {
     
		       $.post(withurl, { clr_hex: $('#inphex').val() }, function(data){
				
				insertdatah(data, replid);
		             });
		       return false;
			      }
		   });	   
  //		    });
}




function externalLinks() {
 if (!document.getElementsByTagName) return;
 var anchors = document.getElementsByTagName("a");
 for (var i=0; i<anchors.length; i++) {
   var anchor = anchors[i];
   if (anchor.getAttribute("href") &&
       anchor.getAttribute("rel") == "external")
     anchor.target = "_blank";
 }
}




function sendText(myField, myValue) {
//IE support
if (document.selection) {
  myField.focus();
sel = document.selection.createRange();
sel.text = myValue;
myField.focus();
}
//MOZILLA/NETSCAPE support
else if (myField.selectionStart || myField.selectionStart == 0) {
startPos = myField.selectionStart;
endPos = myField.selectionEnd;
myField.value = myField.value.substring(0, startPos)
+ myValue
+ myField.value.substring(endPos, myField.value.length);
//myField.focus();
myField.selectionStart = startPos + myValue.length;
myField.selectionEnd = startPos + myValue.length;
} else {
  myField.value += myValue;
  // myField.focus();
}
}



function countclik(tag) {
  myObject.i++;
  var y=myObject.i;
  var x=tag.value;
  store_text[y]=x;
}

function undo(tag) {
  if ((myObject2.i)<(myObject.i)) {
    myObject2.i++;
  } else {
   
  }
  var z=store_text.length;
  z=z-myObject2.i;
  if (store_text[z]) {
  	tag.value=store_text[z];
  } else {
  	tag.value=store_text[0];
  }
}

function redo(tag) {
  if((myObject2.i)>1) {
    myObject2.i--;
  } else {
     }
  var z=store_text.length;
  z=z-myObject2.i;
  if (store_text[z]) {
    tag.value=store_text[z];
  } else {
  tag.value=store_text[0];
  }
}

// thx to vic phillips 
function TxtAreaToggle(tb,r1,r2){
 if (tb.rows==r1){
  tb.rows=r2;
 }
 else {
  tb.rows=r1;
 }
}


function encode() {
  var src = document.encoder.src.value;
  var dest = document.encoder.dest;
  var encodingz = document.encoder.encoding.options[ document.encoder.encoding.selectedIndex ].value;

  switch (encodingz) {

	case 'onlexp' :
		dest.value = src;
		break;
  case 'encodeURI':
    dest.value = encodeURI(src);
    break;
  case 'encodeURIComponent':
    dest.value = encodeURIComponent(src);
    break;
  case 'escape':
    dest.value = escape(src);
    break;
  case 'decodeURI':
    dest.value = decodeURI(src);
    break;
  case 'decodeURIComponent':
    dest.value = decodeURIComponent(src);
    break;
  case 'unescape':
    dest.value = unescape(src);
    break;
  case 'jsvar':
    dest.value = 'var myvar = unescape(\'' + escape(src) + '\');';
	break;
  case 'regexp':
    var regexp = prompt('Regular Expression:', '[0-9+A-Z+a-z]');

    var replacemethod = prompt('method: (g = Repeat; i = Case-insensitive, can be used combined)', 'g');
    regexp=new RegExp(regexp, replacemethod);
  var replacewith = prompt('Replace with:', '');
  dest.value= src.replace(regexp, replacewith);
    break;
  case 'replace':
   var regexp=prompt('Replace this:');
  var replacewith=prompt('Replace with:', '');
  dest.value= src.replace(regexp, replacewith);
    break;

  default:
    dest.value = '';
break;
  } // end switch

  // Select the dest contents
  dest.focus();
  dest.select();
}

	

function _____escregexp(str)
      {

      var specials = new RegExp("[.*+?|()\\[\\]{}\\\\]", "g"); // .*+?|()[]{}\
      return str.replace(specials, "\\$&");
      }
			
			
function strstr (haystack, needle, bool) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: strstr('Kevin van Zonneveld', 'van');
    // *     returns 1: 'van Zonneveld'
    // *     example 2: strstr('Kevin van Zonneveld', 'van', true);
    // *     returns 2: 'Kevin '
    // *     example 3: strstr('name@example.com', '@');
    // *     returns 3: '@example.com'
    // *     example 4: strstr('name@example.com', '@', true);
    // *     returns 4: 'name'

    var pos = 0;
    
    haystack += '';
    pos = haystack.indexOf( needle );
    if (pos == -1) {
        return false;
    } else{
        if (bool){
            return haystack.substr( 0, pos );
        } else{
            return haystack.slice( pos );
        }
    }
}		


// tx to Will Bontrager
// http://www.willmaster.com/blog/css/show-hide-floating-div.php
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
else { document.getElementById(d).style.display = "none"; }
}



// thanks to javascriptkit.com tutorial
// please note that this function makes hacking your website it's ajax/javascript very easy even for people without proper tools, so don't use on public websites unless all your essentional userinput validation (gpc, getpostcookie) works server side

function loadjscssfile(filename, filetype){
 if (filetype=="js"){ //if filename is a external JavaScript file
  var fileref=document.createElement('script')
  fileref.setAttribute("type","text/javascript")
  fileref.setAttribute("src", filename);
  
 }
 else if (filetype=="css"){ //if filename is an external CSS file
  var fileref=document.createElement("link")
  fileref.setAttribute("rel", "stylesheet")
  fileref.setAttribute("type", "text/css")
  fileref.setAttribute("href", filename)
 }
 if (typeof fileref!="undefined"){
  document.getElementsByTagName("head")[0].appendChild(fileref);}
}

function removejscssfile(filename, filetype){
 var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
 var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
 var allsuspects=document.getElementsByTagName(targetelement)
 for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
  if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
   allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
 }
}


		/*********************************************************************
		 * Get an object, this function is cross browser
		 * *** Please do not remove this header. ***
		 * This code is working on my IE7, IE6, FireFox, Opera and Safari
		 * 
		 * Usage: 
		 * var object = get_object(element_id);
		 *
		 * @Author Hamid Alipour Codehead @ webmaster-forums.code-head.com		
		**/
		function get_object(id) {
			var object = null;
			if( document.layers )	{			
				object = document.layers[id];
			} else if( document.all ) {
				object = document.all[id];
			} else if( document.getElementById ) {
				object = document.getElementById(id);
			}
			return object;
		}
		/*********************************************************************/
		
		/*********************************************************************
		 * No onMouseOut event if the mouse pointer hovers a child element 
		 * *** Please do not remove this header. ***
		 * This code is working on my IE7, IE6, FireFox, Opera and Safari
		 * 
		 * Usage: 
		 * <div onMouseOut="fixOnMouseOut(this, event, 'JavaScript Code');"> 
		 *		So many childs 
		 *	</div>
		 *
		 * @Author Hamid Alipour Codehead @ webmaster-forums.code-head.com		
		**/
		function is_child_of(parent, child) {
			if( child != null ) {			
				while( child.parentNode ) {
					if( (child = child.parentNode) == parent ) {
						return true;
					}
				}
			}
			return false;
		}
		function fixOnMouseOut(element, event, JavaScript_code) {
			var current_mouse_target = null;
			if( event.toElement ) {				
				current_mouse_target 			 = event.toElement;
			} else if( event.relatedTarget ) {				
				current_mouse_target 			 = event.relatedTarget;
			}
			if( !is_child_of(element, current_mouse_target) && element != current_mouse_target ) {
				eval(JavaScript_code);
			}
		}
		/*********************************************************************/

