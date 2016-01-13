function editarwrap(){

	editAreaLoader.init({
			id: "editeleconti"	// id of the textarea to transform	
			,start_highlight: true	
			,font_size: "9"	
			,allow_resize: "both"
			,allow_toggle: false
			,language: readCookie('lang')
			,syntax: "css"	
			,toolbar: "new_document, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,load_callback: "my_load"
			,save_callback: "my_save"
			,plugins: "charmap"
			,charmap_default: "arrows"
	      ,display: "later"
				
		});
}
editarwrap();	
		// callback functions
		function my_save(content){
			alert("Here is the content of the EditArea as received by the save callback function:\n"+content);
		}
	
		function my_load(elem){
			elem.value="The content is loaded from the load_callback function into EditArea";
		}
		
		function test_setSelectionRange(id){
			editAreaLoader.setSelectionRange(id, 100, 150);
		}
		
		function test_getSelectionRange(id){
			var sel =editAreaLoader.getSelectionRange(id);
			alert("start: "+sel["start"]+"\nend: "+sel["end"]); 
		}
		
		function test_setSelectedText(id){
			text= "[REPLACED SELECTION]"; 
			editAreaLoader.setSelectedText(id, text);
		}
		
		function test_getSelectedText(id){
			alert(editAreaLoader.getSelectedText(id)); 
		}

	


	function webcss_wrap(id){
closeemall('editeleconti');




if (window.showModalDialog) {
  var sResult = window.showModalDialog("core_clients/editor/css_en/WebCSSEditor.htm",id, "dialogWidth:500px;dialogHeight:630px;status:off;help:no");
 }else{
var sResult= window.open('core_clients/editor/css_en/WebCSSEditor.htm',id,
height=630,width=500,toolbar='no',directories='no',status='no',cmenubar='no',scrollbars='no',resizable='no',modal='yes');
}

 if(sResult){
		id=sResult;
 }
	else
	  {
		id="";
	  }
	}



tinyMCE.init({
	mode : "none",
	theme : "advanced",
	entities:"160,nbsp,60,lt,62,gt",
verify_html:"false",
      cleanup: "false",
valid_elements: "*[*]",
	plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	theme_advanced_buttons1 : "undo,redo,|,cleanup,help,code",
	theme_advanced_buttons2 : "visualaid,|,charmap,|,fullscreen",
	theme_advanced_buttons3 : "insertlayer,moveforward,movebackward,|,absolute,|,styleprops,|,visualchars",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	template_external_list_url : "example_template_list.js"
});


function editarea_wrap(id){

editAreaLoader.toggle("editeleconti");
}

function tinymce_wrap(id) {
	var elm = document.getElementById(id);
	if (tinyMCE.getInstanceById(id) == null){
		tinyMCE.execCommand('mceAddControl', false, id);
	}
	else{
		tinyMCE.execCommand('mceRemoveControl', false, id);
	}
}


