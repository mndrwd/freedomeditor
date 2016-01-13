<?php
if (version_compare(substr(phpversion(),0,strpos(phpversion(), '-')), '6.0.0', '<')) {
include "compat/magicquotes".$GLOBALS['scrext'];
 }
?>