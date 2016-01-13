<?php

$tempo=php_uname('s');
if (stristr($tempo, "windows")){
return "win";
}else{

 return $tempo;
}

;

?>
