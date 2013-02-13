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

     The Original Code is fun_up.php, released on 2003-03-31.

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
	File-Upload Functions

	Have Fun...
------------------------------------------------------------------------------*/
require_once("./_include/permissions.php");

// upload file
function upload_items($dir)
{
    _debug( "xupload_items($dir)" );
    if (!permissions_grant($dir, NULL, "create"))
    {
        show_error($GLOBALS["error_msg"]["accessfunc"]);
    }

    if (isset($GLOBALS['__POST']["confirm"]) && $GLOBALS['__POST']["confirm"] == "true")
    {
        _debug( "linking to list($dir)" );
        header("Location: ".make_link("list",$dir,NULL));
        return;
    }
    _debug( "upload_items: showing header" );
    show_header($GLOBALS["messages"]["actupload"]);

?>

<link rel="stylesheet" type="text/css" href="_lib/uploadify/uploadify.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="_lib/uploadify/jquery.uploadify.min.js"></script>

<script type="text/javascript">
$(function() {
  $('#file_upload').uploadify({
    'swf'             : '_lib/uploadify/uploadify.swf',
    'uploader'        : '_lib/uploadify/uploadify.php',
    'folder'          : '<?php global $home_dir; echo "$home_dir/$dir";?>',
    'auto'            : false,
    'multi'           : true,
    'removeCompleted' : true,
    'debug' : true
  });
});
</script>
<br><form enctype="multipart/form-data" action="<?php make_link("upload",$dir,NULL); ?>" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo get_max_file_size();?>">
        <input type="hidden" name="confirm" value="true">
        <input type="file" name="file_upload" id="file_upload" />
    <table>
            <tr>
                <td>
                    <input type="button"
                           onClick="javascript:$('#file_upload').uploadify('upload', '*')"
                           value="<?php echo $GLOBALS["messages"]["btnupload"];?>" >
                </td>
                <td>
                    <input type="button"
                           onClick="javascript:$('#file_upload').uploadify('cancel', '*')"
                           value="clear" >
                </td>
                <td>
                    <input type="submit" value="back">
                </td>
            </tr>
        </table>
    </form>
    <br>
<?php
	return;
}
?>
