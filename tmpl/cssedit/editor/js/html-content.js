function editarwrap(){
	editAreaLoader.init({
			id: "editeleconti"	// id of the textarea to transform	
			,start_highlight: true	
			,font_size: "9"	
			,allow_resize: "both"
			,allow_toggle: false
			,language: readCookie('lang')
			,syntax: "html"	
			,toolbar: "new_document, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, syntax_selection, |, help"
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


function editarea_wrap(id){
  if (document.forms['bogus3'].inp3.checked==true){
   
tinyMCE.execCommand('mceRemoveControl', false, 'editeleconti');
     document.forms['bogus3'].inp3.checked=false;
editAreaLoader.toggle("editeleconti");
document.forms['bogus3'].inp1.checked=true;
  }
editAreaLoader.toggle("editeleconti");
}


function tinymce_wrap(id) {
if (document.forms['bogus3'].inp1.checked==true){
editAreaLoader.toggle("editeleconti");
 document.forms['bogus3'].inp1.checked=false;
 document.forms['bogus3'].inp3.checked=true;
  }

	var elm = document.getElementById(id);
	if (tinyMCE.getInstanceById(id) == null){
		tinyMCE.execCommand('mceAddControl', false, id);
	}
	else{
		tinyMCE.execCommand('mceRemoveControl', false, id);
	}
}

	
	function webcss_wrap(){
	  }


tinyMCE.init({
	mode : "none",
	theme : "advanced",
	content_css: readCookie(readCookie('tinymcecooker')),
valid_elements: "*[*]",
      verify_html:"true",
      cleanup: "true",
      convert_urls:"false",
      apply_source_formatting: "true",
      elements: "editeleconti",
	plugins : "style,layer,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,",
      theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons3 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,code",

      theme_advanced_buttons4 : "outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons5 : "tablecontrols,|,hr,removeformat,visualaid",
      theme_advanced_buttons6 : "sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons7 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
      template_external_list_url : "example_template_list.js",
fullpage_fontsizes : '13px,14px,15px,18pt,xx-large',
	fullpage_default_xml_pi : "false",
	fullpage_default_langcode : 'en',

      entities: '',
});


function ineedtocheckforhtmltag (){

if (document.getElementById('editeleconti').value.search('<html') !=-1){

close_wysiwyg_markup();
document.getElementById('inp1').checked=false;
document.getElementById('inp2').checked=false;
document.getElementById('inp3').checked=false;
removejscssfile(tmplfolder + '/js/' +current_ext + '.js', 'js');
current_ext = 'html';//this.options[this.selectedIndex].value;
jQuery("#cmmid").selectOptions("html");
//document.getElementById('cmmid').options[html-content].selected=true;
loadjscssfile(tmplfolder + '/js/html.js', 'js');

}
}

