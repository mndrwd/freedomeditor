<?php

#SED BGBLITE interface by B.G. Bosma Oudehorne 2008

if (!isset($_SESSION) && function_exists("session_start")){session_start();}
 if (isset($_GET['fd']) && strlen($_GET['fd'])>0){
   if (is_dir(getcwd()."/../../fc/".html_entity_decode($_GET['fd']))){
   $_SESSION['cwd']=getcwd()."/../../../fc/".html_entity_decode($_GET['fd']);
   }elseif (is_dir(html_entity_decode($_GET['fd']))){
   $_SESSION['cwd']=html_entity_decode($_GET['fd']);
   }
 }
   if (!isset($_POST['filter']) || !isset($_POST['find'])){

     echo str_replace(array("---sedform---", "---cwd---"), array(file_get_contents("form.html"),realpath($_SESSION['cwd'])), file_get_contents("index.html"));


   
   }else{
     if (!isset ($_POST['replace']) || strlen($_POST['replace'])<1){
#perform grep/find only

#windows
       if (isset($_SERVER['WINDIR'])){
#	 $urlcmd="find /N \"".$_POST['find']."\" ".$_POST['filter'];
$urlcmd="FOR /R . %v IN (\"".$_POST['filter']."\") DO find /N \"".$_POST['find']."\" \"%~fv\"";  #changed nov 9 2008
       }else{
#linux/bsd/mac? grep?
	 $urlcmd="grep -n -r -I \"".$_POST['find']."\" ".$_POST['filter'];
       }
     }else{
#not just finding now, but actually do replace with phpterm + sed

   if (isset ($_POST['sudouser']) && strlen($_POST['sudouser'])>0){
$cmdaddition1="sudo -u ".$_POST['sudouser']." ";
}else{$cmdaddition1=' ';}
       $urlcmd=$cmdaddition1."sedfolder.sh \"".$_POST['filter']."\" \"".$_POST['find']."\" \"".$_POST['replace']."\"";
       }
	#echo $urlcmd;die();   
       header("Location: ".$WIMPY_BASE['path']['www']."/?cc=phpterm&command=".urlencode($urlcmd)."&fd=".$_SESSION['cwd']);
   }


?>