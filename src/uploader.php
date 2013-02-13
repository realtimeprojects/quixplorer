<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

// setup the target upload directory folder with full path name
// for security reasons.
//
// Note that the target directory folder must not be necessarely
// be visible with the quixplorer interface.
$targetFolder = "/var/local/download/data/incoming";

if (empty($_FILES))
{
    echo 'no files!';
    return 1;
}

$tempFile = $_FILES['Filedata']['tmp_name'];

// you may want to do some additional checks on the uploaded files
// here.

$targetFile = rtrim($targetFolder,'/') . "/" . $_FILES['Filedata']['name'];

move_uploaded_file($tempFile, $targetFile);
echo '1';
?>
