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

     The Original Code is fun_search.php, released on 2003-03-31.

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
	File-Search Functions
	
	Have Fun...
------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------
function find_item($dir, $pat, &$list, $recur)
{
	// find items
	$handle=@opendir($dir);
	if ($handle === false)
		return;		// unable to open dir
	
	while (($new_item = readdir($handle)) !== false)
	{
		if(!@file_exists(get_abs_item($dir, $new_item))) continue;
		if(!get_show_item($dir, $new_item)) continue;
		
		// search sub-directories
		if(get_is_dir($dir, $new_item) && $recur)
		{
			find_item(get_rel_item($dir,$new_item), $pat, $list, $recur);
		}
		// match?
		if (@eregi($pat, $new_item))
		{
			if (!is_array($list[$dir]))
			{
				$list[$dir] = array();
			}
			$list[$dir][] = $new_item;
		}
	}

	
	closedir($handle);
}

//------------------------------------------------------------------------------
function search_make_list ($dir, $item, $subdir)
{	// make list of found items
	// convert shell-wildcards to PCRE Regex Syntax
	$pat = str_replace("?",".",str_replace("*",".*",str_replace(".","\.",$item)));
	
	// search
	find_item($dir, $pat, $list, $subdir);
	if(is_array($list))
		ksort($list);
	return $list;
}
//------------------------------------------------------------------------------
function print_table($list) {			// print table of found items
	if(!is_array($list)) return;
	
	$cnt = count($list);
	for($i=0;$i<$cnt;++$i) {
		$dir = $list[$i][0];	$item = $list[$i][1];
		$s_dir=$dir;	if(strlen($s_dir)>65) $s_dir=substr($s_dir,0,62)."...";
		$s_item=$item;	if(strlen($s_item)>45) $s_item=substr($s_item,0,42)."...";
		$link = "";	$target = "";
		
		if(get_is_dir($dir,$item)) {
			$img = "dir.gif";
			$link = make_link("list",get_rel_item($dir, $item),NULL);
		} else {
			$img = get_mime_type($dir, $item, "img");
			$link = make_link("download",$dir,$item); 
		}
		
		echo "<TR><TD>" . "<IMG border=\"0\" width=\"16\" height=\"16\" ";
		echo "align=\"ABSMIDDLE\" src=\"_img/" . $img . "\" ALT=\"\">&nbsp;";
		/*if($link!="")*/ echo"<A HREF=\"".$link."\" TARGET=\"".$target."\">";
		//else echo "<A>";
		echo $s_item."</A></TD><TD><A HREF=\"" . make_link("list",$dir,NULL)."\"> /";
		echo $s_dir."</A></TD></TR>\n";
	}
}
//------------------------------------------------------------------------------
?>
