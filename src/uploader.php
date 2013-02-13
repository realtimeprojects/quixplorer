<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

// Define a destination
$targetFolder = $_POST['folder'];
$verifyToken = md5('unique_salt' . $_POST['timestamp']);


if (empty($_FILES))
{
    echo 'no files!';
    return 1;
}

$tempFile = $_FILES['Filedata']['tmp_name'];
$targetFile = rtrim($targetFolder,'/') . '/' . $_FILES['Filedata']['name'];

move_uploaded_file($tempFile,$targetFile);
echo '1';
?>
