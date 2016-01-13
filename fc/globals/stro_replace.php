<?php
# by michael dot moussa at gmail dot com
# found at http://php.net/manual/en/function.str-replace.php
# str_replace (without the inner loop, str-once_replace)
#CURRENTLY NOT USED IN FREEDOMEDITOR

function stro_replace($search, $replace, $subject)
{
    return strtr( $subject, array_combine($search, $replace) );
}

?>