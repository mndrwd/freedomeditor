<?php

$phpLiveDocx = new Zend_Service_LiveDocx_MailMerge(

    array (
        'username' => 'myUsername',
        'password' => 'myPassword'
    )
);

$phpLiveDocx->setLocalTemplate($argv[0]);
 
// necessary as of LiveDocx 1.2
$phpLiveDocx->assign('dummyFieldName', 'dummyFieldValue');
 
$phpLiveDocx->createDocument();
 
 
 $current_filename= str_replace(".".end(explode('.',$argv[0])), $argv[1], $argv[0]);
$document = $phpLiveDocx->retrieveDocument($current_filename);
 
 

file_put_contents($current_filename, $document);
 
unset($phpLiveDocx);

?>

