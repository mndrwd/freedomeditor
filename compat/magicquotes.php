<?


if (get_cfg_var("magic_quotes_gpc")==1){
  if (!ini_set("magic_quotes_gpc", 0)){
    $error=1;
  }}
if (get_cfg_var("magic_quotes_sybase")){
  if (!ini_set("magic_quotes_sybase", 0)){
    $error=1;
  }}
if (get_cfg_var("magic_quotes_runtime")==1){
  if (!ini_set("magic_quotes_runtime", 0)){
    $error=1;}}


if (function_exists("get_magic_quotes_gpc")){
  if (get_magic_quotes_gpc()==1){
      $error=1;
    }}

if (function_exists("get_magic_quotes_runtime")){
  if (get_magic_quotes_runtime()==1){
    if (!set_magic_quotes_runtime(0)){
      $error=1;
    }}}
    if (isset($error)){
      echo "Cannot proceed. Please put magic_quotes_gpc/runtime/sybase 0ff in php.ini or enable use of set_magic_quotes_runtime function and runtime ini_set() somehow.
# View php it's  security.magicquotes.disabling.html documentation for more info regarding getting rid of this deprecated functionality.
";
      die();
    }



 



?>
