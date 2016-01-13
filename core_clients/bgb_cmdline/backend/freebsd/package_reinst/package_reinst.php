<?php

#version 1.0
#written by Bart Bosma
#Oudehorne, Netherlands
#inf +_at_+ freedomeditor.com
  /*

Copyright (c) 2008, B.G. Bosma
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
    * Neither the name of bosma-autos.nl nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
  */


# SETTINGS
$portslocation="/usr/ports/";
$PKG_DB="/var/db/pkg";
$lang="en";
# use %location% and %name% (does not contain version number), so can be used like "portupgrade -rRf %name%*"
#$outputtemplate="
#cd %location%\nmake deinstall clean\nmake clean\nmake install\n";
$outputtemplate=#"pkg_deinstall -f %name%* \\\n
 "pkg_add -r %name% \n";

#LANGUAGE
$__lang['en']["dont_run_as_root"]="don't run as root\n";
#$__lang['en']["enter_input_filename"]="Input (file must contain raw output from command pkg_validate -r)\nFilename: ";
$__lang['en']["enter_output_filename"]="output\nfilename: ";
$__lang['en']["filenotexists"]="input file doesn't exists, creation will be attempted now..\n";
$__lang['en']['no packages found']="no packages found in /var/db/pkg";
$__lang['en']["input_incorrect"]="Input is not in correct format (mustbe output from pkg_validate -r)";
$__lang['en']["noproblems"]="Nothing to be done meaning also no output file written.";
#$__lang&=$array;



# SCRIPT
fwrite(STDOUT, "".$__lang[$lang]["dont_run_as_root"]);
#if (!isset($argv[2]) && !isset($argv[1])){
#fwrite(STDOUT, "".$__lang[$lang]['enter_input_filename']);

// Read the input
#$input_fn = trim(str_replace(array("\n", "\r"), "", (fgets(STDIN)))); 
 #}else{$input_fn=$argv[2];}
#$input_fn='';
#if (strlen($input_fn)=0){
#  fwrite(STDOUT,$__lang["paste_pkg_val_output"]); 
#  $input=fgets(STDIN);
# }


if (!isset($argv[1])){
  fwrite(STDOUT, $__lang[$lang]['enter_output_filename']);

// Read the input
$output_fn =  trim(str_replace(array("\n", "\r"), "", fgets(STDIN))); 
}else{$output_fn=$argv[1];}

/*
if (file_exists($input_fn)){
$input=file($input_fn);

 }else{
  fwrite(STDOUT, $__lang[$lang]['filenotexists']);
  #exit(0);

#input file not found check if software to create wanted input is available

  $strlen=exec("ls ".$PKG_DB." |grep bsdadminscripts");
 if (strlen($strlen)<10){
fwrite(STDOUT, $__lang[$lang]['please_install_bsdadminscripts']."\n");
exit(0);
// Exit correctly
 }
*/

#create input if input file doesnt exists
 exec('ls /var/db/pkg', $input);
/*
if (is_array($input)){
  $aha='';
foreach ($input as $a){
  $aha.=$a."\n";
 }
  file_put_contents($input_fn, $aha);
 }else{
  fwrite(STDOUT, $__lang[$lang]["noproblems"]);
  exit(0);
 }
#get input from file
#$input=file_get_contents($input_fn);
 #}
#make array from input string
#$a_array=explode($input, $line_seperator);
  */


#create output
if (is_array($input)){
  $outputscript="pkg_delete -a \n";
  
  foreach ($input as  $ah){
    $words=  explode (" ", $ah);
 if (count($words)>4){
       fwrite(STDOUT, $__lang[$lang]["input_incorrect"]);
       exit(0);}
 
#   fwrite(STDOUT, $word);exit(0);
     #fwrite(STDOUT, $ah."\n");
	$wordz=explode("-", $ah); 
unset($wordz[(count($wordz)-1)]);    
$wordx=implode("-", $wordz);


if (strlen($wordx)>1){
$outputscript.=str_replace(
 "%name%", 
 $wordx ,
 $outputtemplate);
}
 }

#fwrite(STDOUT, print_r($wordz));
#write output
  if (strlen($output_fn)>0){
	fwrite(STDOUT, $outputscript);#exit(0);  
    file_put_contents($output_fn, $outputscript);
}
 }else{
#echo $outputscript; 
}
exit(0);
?>