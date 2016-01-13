<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
#this folder depend
$depend["ele_content"]=false;
$depend["getbrowsershtml"]=false;
$depend["getclixele"]=false;
$depend["getcathtml"]=false;
$depend["editormimemode"]=false;
if (function_exists("startfunct")){
startfunct($depend);
$depend=array();
 }
#globals depend 
$___workpath=$workpathios[0]."globals/";
$depend["gethatmpl"]=false;
$depend["file_get_contents"]=false;
$depend["dir_ls"]=false;
$depend["getlanghtml"]=false;
$depend["guilang"]=false;
if (function_exists("startfunct")){
startfunct($depend);

 $depend=array();}

if (!function_exists("htmlshifter")){ function htmlshifter($klikit, $str=false){
    global $browsers, $__lang, $tmplext;$string= gethatmpl($klikit, "index");
    if (!isset($_GET['cat'])||$_GET['cat']==''){$_GET['cat']=1;}if(!isset($_GET['ele'])){if (!isset($_GET['fn'])){$_GET['fn']='';}$_GET['ele']=$_GET['fn'];}
	

      
	$arr[0]='{langtag}';
	$arr[1]=dir_ls($GLOBALS['__the_cwd']."/".$GLOBALS['_cfg']['folders']['language']);
	$arr[1]=$arr[1]['fd'];
$langarr=getlanghtml($arr);

$strraw[0]=ele_content($klikit);
if (!isset($mmv)){$mmv='';}if (!isset($mmh)){$mmh='';}
 $strraw[1]= str_replace(array("{ext:ajaxurlvar:ension}"), array($GLOBALS['_cfg']['global']['ajax_urlvar']), guilang(str_replace(array("{ext:currentwd:ension}","{ext:wwwroot:ension}","{ext:def_request_folder:ension}","{ext:mimemodesftlog:ension}","{ext:colorshizzle:ension}", "{ext:language:ension}","{ext:browsers:ension}", "{ext:memohori:ension}", "{ext:memoverti:ension}", "{ext:cat:ension}", "{ext:rawele_name:ension}", "{ext:ele_name:ension}", "{ext:cat_loop:ension}", "{ext:ele_loop:ension}", "{ext:cat_loop_sel:ension}", "{ext:inputtags:ension}", "{ext:inputtagsext:ension}"), array($GLOBALS['currentwd'], $GLOBALS['WIMPY_BASE']['path']['www'], urlencode(htmlentities($GLOBALS['_cfg']['global']['default_request_folder'])),editormimemode($GLOBALS['_cfg']['ext_links']),gethatmpl(0, "colors"),$langarr, getbrowsershtml($browsers), $mmh, $mmv, $_GET['cat'], htmlentities($_GET['ele']), urlencode(htmlentities($_GET['ele'])), getcathtml($klikit), getclixele($klikit, htmlentities($_GET['cat'])), getcathtml($klikit, "cat_sel"), gethatmpl(0, "inputtags"), gethatmpl(0, "inputtags".$GLOBALS['current_extlink'])), $string), $__lang));
# $strraw[1]=make_object(guilang(make_object(), $__lang), $guicfg, $hex);
 return $strraw;
  }}

?>
