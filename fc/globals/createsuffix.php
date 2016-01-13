<?php
if (!function_exists('createsuffix')){
function createsuffix($prefix, $ext, $sep=false, $int=0){
	if (file_exists($prefix.$int.".".$ext)){
		$int++;
		return createsuffix($prefix, $ext, $sep, $int);
		}else{
			return $prefix.$sep.$int.".".$ext;}}}
?>
