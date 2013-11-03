<?php
/*------------------------------------------------------------------------------
     The contents of this file are subject to the Mozilla Public License
     Version 1.1 (the "License"); you may not use this file except in
     compliance with the License. You may obtain a copy of the License at
     http://www.mozilla.org/MPL/

     Software distributed under the License is distributed on an "AS IS"
     basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
     License for the specific language governing rights and limitations
     under the License.

     The Original Code is fun_down.php, released on 2003-01-25.

     The Initial Developer of the Original Code is The QuiX project.

     Alternatively, the contents of this file may be used under the terms
     of the GNU General Public License Version 2 or later (the "GPL"), in
     which case the provisions of the GPL are applicable instead of
     those above. If you wish to allow use of your version of this file only
     under the terms of the GPL and not to allow others to use
     your version of this file under the MPL, indicate your decision by
     deleting  the provisions above and replace  them with the notice and
     other provisions required by the GPL.  If you do not delete
     the provisions above, a recipient may use your version of this file
     under either the MPL or the GPL."
------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------
Author: The QuiX project
	quix@free.fr
	http://www.quix.tk
	http://quixplorer.sourceforge.net

Comment:
	QuiXplorer Version 2.3
	File-Download Functions

	Have Fun...
------------------------------------------------------------------------------*/
require_once("./_include/permissions.php");
require_once("qxpage.php");

/**
 * download_selected
 * @return void
 **/
function download_selected($dir)
{
    $dir = get_abs_dir($dir);
    global $site_name;
    require_once("_include/fun_archive.php");
    $items = qxpage_selected_items();

    // check if user selected any items to download
    switch (count($items))
    {
        case 0:
            show_error($GLOBALS["error_msg"]["miscselitems"]);
        case 1:
            if (is_file($items[0]))
            {
                download_item( $dir, $items[0] );
                break;
            }
            // nobreak, downloading a directory is done
            // with the zip file
        default:
            zip_download( $dir, $items );
    }
}

// download file
function download_item($dir, $item)
{
	// Security Fix:
	$item=basename($item);

	if (!permissions_grant($dir, $item, "read"))
		show_error($GLOBALS["error_msg"]["accessfunc"]);

	if (!get_is_file($dir,$item))
    {
        _debug("error download");
        show_error($item.": ".$GLOBALS["error_msg"]["fileexist"]);
    }
	if (!get_show_item($dir, $item))
        show_error($item.": ".$GLOBALS["error_msg"]["accessfile"]);

	$abs_item = get_abs_item($dir,$item);
    _download($abs_item, $item);
}

function _download_header($filename, $filesize = 0)
{
	$browser=id_browser();
	header('Content-Type: '.(($browser=='IE' || $browser=='OPERA')?
		'application/octetstream':'application/octet-stream'));
	header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Content-Transfer-Encoding: binary');
    if ($filesize != 0)
    {
        header('Content-Length: '.$filesize);
    }
    header('Content-Disposition: attachment; filename="'.$filename.'"');
	if($browser=='IE') {
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
	} else {
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
	}
}

function _download($file, $localname)
{
    _download_header($localname, @filesize($file));
	@readfile($file);
	exit;
}

?>
