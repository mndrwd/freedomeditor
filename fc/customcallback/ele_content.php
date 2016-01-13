<?php
// @(#) $Id$
// +-----------------------------------------------------------------------+
// | Copyright (C) 2009, http://freedomeditor.com                          |
// +-----------------------------------------------------------------------+
// | This file is free software; you can redistribute it and/or modify     |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation; either version 2 of the License, or     |
// | (at your option) any later version.                                   |
// | This file is distributed in the hope that it will be useful           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of        |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the          |
// | GNU General Public License for more details.                          |
// +-----------------------------------------------------------------------+
// | Author: Bart Bosma Oudehorne                                                          |
// +-----------------------------------------------------------------------+
//
global $klikit
#, $ele_content_cnt;
#print_r($klikit);die();
#echo html_entity_decode($klikit["Files"]["CHANGELOG"]);die();
#print_r(ele_content($klikit));die();
#if (!isset($ele_content_cnt) || $ele_content_cnt<1 || $ele_content_cnt == false){
#$ele_content_cnt=0;}
#$ele_content_cnt++;
#if ($ele_content_cnt<2 ) {
return ele_content($klikit);
#return "";
#}else{
#return "";
#}

?>

		