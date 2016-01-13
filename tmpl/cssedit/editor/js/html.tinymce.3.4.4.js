function editarwrap(){

	editAreaLoader.init({
			id: "editeleconti"	// id of the textarea to transform	
			,start_highlight: true	
			,font_size: "9"	
			,allow_resize: "both"
			,allow_toggle: false
			,language: readCookie('lang')
			,syntax: "html"	
			,toolbar: "new_document, |, autocompletion, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, syntax_selection, |, help"
			,load_callback: "my_load"
			,save_callback: "my_save"
			,plugins: "charmap, autocompletion"
			,charmap_default: "arrows"
			,autocompletion: true
			,autocompletion_start:true
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
	
		tinyMCE.execCommand('mceAddControl', true, id);
	}
	else{
		tinyMCE.execCommand('mceRemoveControl', false, id);
	}
}

	
	function webcss_wrap(){
	  }


/*
tinyMCE.init({
  language:  readCookie('lang'),
	mode : "none",
	theme : "advanced",
	
	plugins : "style,layer,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,fullpage",
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,",
      theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons3 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,code",

      theme_advanced_buttons4 : "outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons5 : "tablecontrols,|,hr,removeformat,visualaid",
      theme_advanced_buttons6 : "sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
      theme_advanced_buttons2_add : "fullpage",
	theme_advanced_buttons7 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
      template_external_list_url : "example_template_list.js",
fullpage_fontsizes : '13px,14px,15px,18pt,xx-large',
	fullpage_default_xml_pi : "false",
	fullpage_default_langcode : 'en',


});

new init below since v3.4.4
*/
/*
tinyMCE.init({

language:  readCookie('lang'),
	// General options
	mode : "none",
	theme : "advanced",
content_css: readCookie(readCookie('tinymcecooker')),
valid_elements: "*[*]",
elements: "editeleconti",
      verify_html:"false",
      cleanup: "true",
      convert_urls:"true",
	entities:	'',
      apply_source_formatting: "true",
	plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,", 


// Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,


      //template_external_list_url : "example_template_list.js",
fullpage_fontsizes : '13px,14px,15px,18pt,xx-large',
	fullpage_default_xml_pi : "false",
	fullpage_default_langcode : 'en',

	skin : "o2k7",
skin_variant : "silver",



	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	},

	autosave_ask_before_unload : true, // Disable for example purposes




});

*/


tinyMCE.init({
        // General options
        mode : "none",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});




function ineedtocheckforhtmltag (){

if (document.getElementById('editeleconti').value.search('<html') ==-1){

close_wysiwyg_markup();
document.getElementById('inp1').checked=false;
document.getElementById('inp2').checked=false;
document.getElementById('inp3').checked=false;
removejscssfile(tmplfolder + '/js/' +current_ext + '.js', 'js');
current_ext = 'html-content';//this.options[this.selectedIndex].value;
jQuery("#cmmid").selectOptions("html-content");
//document.getElementById('cmmid').options[html-content].selected=true;
loadjscssfile(tmplfolder + '/js/html-content.js', 'js');

}
}


/*
function codemirror(){
// maybe someday when codemirror has better implementation options which makes frame keep the textarea id.
}
*/

