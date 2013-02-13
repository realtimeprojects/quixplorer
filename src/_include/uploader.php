<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

function _debug ($data)
{
    global $FD_LOG;

    $debug = 1;

    if ($debug == 0)
      return;

    $fp = fopen("/tmp/debug.log", "a");
    fputs($fp, date("Y-m-d H:i:s") . " quixplorer: $data\n");
    fclose($fp);
}

// Define a destination
$targetFolder = $_POST['folder'];
_debug("target folder is $targetFolder");
$verifyToken = md5('unique_salt' . $_POST['timestamp']);

_debug('uploader.php: '.serialize($_FILES));

if (empty($_FILES))
{
    _debug('no files!');
}

$tempFile = $_FILES['Filedata']['tmp_name'];
_debug('file: '.$_FILES['Filedata']['name']);
_debug('tmpfile: '.$_FILES['Filedata']['tmp_name']);
$targetFile = rtrim($targetFolder,'/') . '/' . $_FILES['Filedata']['name'];

move_uploaded_file($tempFile,$targetFile);
echo '1';
?>
