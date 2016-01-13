<?php
// @(#) $Id$
// +-----------------------------------------------------------------------+
// | Copyright (C) 2008, http://yoursite                                   |
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
// | Author: pFa                                                           |
// +-----------------------------------------------------------------------+
//
               /*
	 * 	Developped by Bart Bosma 2007
	 *	Released under GPL license
	 */
#required file for loader.php and core_clients/editor/vars.php
$browsers[""]="Copy";
$browsers["suffix1"]="suffix1";
#$browsers["_ie"]="MSIE";
#$browsers["_oa"]="Opera";

#echo $_SERVER['HTTP_USER_AGENT'];die();

#if (!isset($manualbrowsersloading)){
return getbrowsershtml($browsers);
#}
?>

		