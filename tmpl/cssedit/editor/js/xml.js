function editarwrap(){

	editAreaLoader.init({
			id: "editeleconti"	// id of the textarea to transform	
			,start_highlight: true	
			,font_size: "9"	
			,allow_resize: "both"
			,allow_toggle: false
			,language: readCookie('lang')
			,syntax: "xml"	
			,toolbar: "new_document, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,load_callback: "my_load"
			,save_callback: "my_save"
			,plugins: "charmap, autocompletion"
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
}

	
	function webcss_wrap(){
	  }


