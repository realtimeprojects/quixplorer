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

     The Original Code is header.php, released on 2003-02-07.

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
	Header File
	
	Have Fun...
-------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------
/**
 * header for html-page
**/
function show_header($title, $additional_header_content)
{
    global $site_name;

	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".$GLOBALS["charset"]);
	
	//echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"";
	//echo "\"http://www.w3.org/TR/REC-html40/loose.dtd\">\n";
	echo "<HTML lang=\"".$GLOBALS["language"]."\" dir=\"".$GLOBALS["text_dir"]."\">\n";
	echo "<HEAD>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$GLOBALS["charset"]."\">\n";
	echo "<title>$site_name</title>\n";
	echo "<LINK href=\"_style/style.css\" rel=\"stylesheet\" type=\"text/css\">\n";
	
	echo "<link href=\"_lib/uploadify/uploadify.css\" type=\"text/css\" rel=\"stylesheet\" />\n";
	
	echo "<script type=\"text/javascript\" src=\"_lib/edit_area/edit_area_full.js\"></script>\n";
	
	/*
	echo "<!-- Thirdparty intialization scripts, needed for the Google Gears and BrowserPlus runtimes -->\n";
	echo "<script type=\"text/javascript\" src=\"_lib/plupload/js/gears_init.js\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"http://bp.yahooapis.com/2.4.21/browserplus-min.js\"></script>\n";

	echo "<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->\n";
	echo "<script type=\"text/javascript\" src=\"_lib/plupload/js/plupload.full.min.js\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"_lib/plupload/js/jquery.plupload.queue.min.js\"></script>\n";
	*/

    if (isset($additional_header_content))
        echo $additional_header_content;
	
	echo "</HEAD>\n<BODY><center>\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\"><tbody>\n";
	echo "<tr><td class=\"title\">";
	if($GLOBALS["require_login"] && isset($GLOBALS['__SESSION']["s_user"])) echo "[".$GLOBALS['__SESSION']["s_user"]."] - ";
	echo $title."</td></tr></tbody></table>\n\n";
}
//------------------------------------------------------------------------------
?>
