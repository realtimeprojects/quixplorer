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

     The Original Code is fun_list.php, released on 2003-03-31.

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
	Directory-Listing Functions
	
	Have Fun...
------------------------------------------------------------------------------*/
require_once("./_include/permissions.php");

//------------------------------------------------------------------------------
// HELPER FUNCTIONS (USED BY MAIN FUNCTION 'list_dir', SEE BOTTOM)
function make_list($_list1, $_list2) {		// make list of files
	$list = array();

	if($GLOBALS["srt"]=="yes") {
		$list1 = $_list1;
		$list2 = $_list2;
	} else {
		$list1 = $_list2;
		$list2 = $_list1;
	}
	
	if(is_array($list1)) {
		while (list($key, $val) = each($list1)) {
			$list[$key] = $val;
		}
	}
	
	if(is_array($list2)) {
		while (list($key, $val) = each($list2)) {
			$list[$key] = $val;
		}
	}
	
	return $list;
}
//------------------------------------------------------------------------------
/**
	make table of files in dir
	make tables & place results in reference-variables passed to function
	also 'return' total filesize & total number of items
	*/
function _search ($search, $dir, &$file_list, &$tot_file_size, &$num_items)
{						
	
	$tot_file_size = $num_items = 0;
	$dir = get_abs_dir($dir);
	
	require "_include/search.php";
	$directories = search_make_list($dir, $search, true);

	if (!isset($directories))
		return;
	// Read directory
	foreach ($directories as $directory => $items)
	{
		$file_list[$directory] = "DIRECTORY";

		foreach ($items as $new_item)
		{
			// ck
			if ($new_item == '..')
				continue;
			// ck
			$abs_new_item = "$directory/$new_item";
			
			if(!@file_exists($abs_new_item))
				show_error($abs_new_item . ":: ".$GLOBALS["error_msg"]["readdir"]);
			if(!get_show_item($dir, $new_item))
				continue;
			
			$new_file_size = filesize($abs_new_item);
			$tot_file_size += $new_file_size;
			$num_items++;
			
			$file_list[$new_item] = $new_item;
		}
	}
}

function make_tables($dir, &$dir_list, &$file_list, &$tot_file_size, &$num_items)
{						// make table of files in dir
	// make tables & place results in reference-variables passed to function
	// also 'return' total filesize & total number of items
	
	$tot_file_size = $num_items = 0;
	
	// Open directory
	$absdir = get_abs_dir($dir);
	$handle = @opendir($absdir);
	if ($handle===false)
		show_error($absdir . ": " . $GLOBALS["error_msg"]["opendir"]);
	
	// Read directory
	while (($new_item = readdir($handle)) !== false)
	{
		// ck
		if ($new_item == '..')
			continue;
		// ck
		$abs_new_item = get_abs_item($dir, $new_item);
		
		if(!@file_exists($abs_new_item))
			show_error($abs_new_item . ":: ".$GLOBALS["error_msg"]["readdir"]);
		if(!get_show_item($dir, $new_item))
			continue;
		
		$new_file_size = filesize($abs_new_item);
		$tot_file_size += $new_file_size;
		$num_items++;
		
		if(get_is_dir($dir, $new_item)) {
			if($GLOBALS["order"]=="modified") {
				$dir_list[$new_item] =
					@filemtime($abs_new_item);
			} else {	// order == "size", "type" or "name"
				$dir_list[$new_item] = $new_item;
			}
		} else {
			if($GLOBALS["order"]=="size") {
				$file_list[$new_item] = $new_file_size;
			} elseif($GLOBALS["order"]=="modified") {
				$file_list[$new_item] =
					@filemtime($abs_new_item);
			} elseif($GLOBALS["order"]=="type") {
				$file_list[$new_item] =
					get_mime_type($dir, $new_item, "type");
			} else {	// order == "name"
				$file_list[$new_item] = $new_item;
			}
		}
	}
	closedir($handle);
	
	
	// sort
	if(is_array($dir_list)) {
		if($GLOBALS["order"]=="modified") {
			if($GLOBALS["srt"]=="yes") arsort($dir_list);
			else asort($dir_list);
		} else {	// order == "size", "type" or "name"
			if($GLOBALS["srt"]=="yes") ksort($dir_list);
			else krsort($dir_list);
		}
	}
	
	// sort
	if(is_array($file_list)) {
		if($GLOBALS["order"]=="modified") {
			if($GLOBALS["srt"]=="yes") arsort($file_list);
			else asort($file_list);
		} elseif($GLOBALS["order"]=="size" || $GLOBALS["order"]=="type") {
			if($GLOBALS["srt"]=="yes") asort($file_list);
			else arsort($file_list);
		} else {	// order == "name"
			if($GLOBALS["srt"]=="yes") ksort($file_list);
			else krsort($file_list);
		}
	}
}
//------------------------------------------------------------------------------
// print table of files
function _get_files($dir, $list)
{
	$files = array ();

	if (!is_array($list))
		return $files;
	
	while(list($item,$srt) = each($list))
	{
		$current = array ();

		// link to dir / file
		$abs_item=get_abs_item($dir,$item);
		if ($srt == "DIRECTORY")
			$current['special'] = "directory";
		$target="";
		if(is_dir($abs_item))
		{
			$current['link'] = make_link("list",get_rel_item($dir, $item),NULL);
		} else
		{ 
			if (permissions_grant($dir, $item, "read"))
				$current['link'] = make_link("download", $dir, $item);
			else
				$current['link'] = NULL;
		} 
		
		// Icon + Link
		$current['icon'] = get_mime_type($dir, $item, "img");
		$s_item=$item;
		if(strlen($s_item)>50)
			$s_item=substr($s_item,0,47) . "...";
		$current['name'] = htmlspecialchars($s_item);
		$current['size'] = parse_file_size(get_file_size($dir,$item));
		$current['type'] = get_mime_type($dir, $item, "type");
		$current['modified'] = parse_file_date(get_file_date($dir,$item));
		$current['permissions'] = array ();
		if (permissions_grant($dir, NULL, "change"))
		{
			$current['permissions']['link'] = make_link("chmod", $dir, $item);
			$current['permissions']['alt'] = $GLOBALS["messages"]["permlink"];
		}
		$current['permissions']['text'] = parse_file_type($dir,$item) . 
			parse_file_perms(get_file_perms($dir,$item));
		$current['editlink'] = _get_link("edit", 
					permissions_grant($dir, $item, "change"), $dir, $item);
		if(get_is_file($dir,$item))
			$current['downloadlink'] = _get_link("download", permissions_grant($dir, $item, "read"), $dir, $item);
		array_push($files, $current);
	}

	return $files;
}
//------------------------------------------------------------------------------

// MAIN FUNCTION
function list_dir ($dir)
{
	global $smarty;

	debug("list_dir($dir)");
	if ($dir == ".")
		$dir = "";
	
	if (isset($_REQUEST["search"]) && $_REQUEST["search"] != "")
	{
		_search($_REQUEST["search"], $dir, $file_list, $tot_file_size, $num_items);
	}
	else
	{
		// make file & dir tables, & get total filesize & number of items
		make_tables($dir, $dir_list, $file_list, $tot_file_size, $num_items);
	}

	$smarty->assign('javascript', 'list.js.php');
	$smarty->assign("site_name", $GLOBALS['config']['site']['name']);
	$smarty->assign('order', $GLOBALS['order']);
	$smarty->assign('status', $GLOBALS['messages']['actdir'] . ": /$dir");
	$smarty->assign('search', $_REQUEST["search"]);
	$smarty->assign('srt', $GLOBALS['srt']);
	$smarty->assign('buttons', _get_buttons($dir_up));
	$smarty->assign('columns', _get_columns());
	$smarty->assign('files', _get_files($dir, make_list($dir_list, $file_list)));
	
	if(function_exists("disk_free_space")) {
		$free=parse_file_size(disk_free_space(get_abs_dir($dir)));
	} elseif(function_exists("diskfreespace")) {
		$free=parse_file_size(diskfreespace(get_abs_dir($dir)));
	} else $free="?";
	$smarty->assign('info', array('free' => $free,
					'items' => $num_items,
					'total' => parse_file_size($tot_file_size)));

	$smarty->display('list.tpl');
	
}
//------------------------------------------------------------------------------
/**
  print out an button link in the toolbar.

  if $allow is set, make this button active and work, otherwise print
  an inactive button.
*/
function _get_link ($function, $allow, $dir, $item)
{
	if (! $allow)
		return NULL;

	return  make_link($function, $dir, $item);
}
			
function _get_buttons ($dir_up)
{
	$buttons = array
	(
		array
		(
			'id' => 'up',
			'link' => make_link("list", $dir_up, NULL),
			'enabled' => true,
			'alt' => $GLOBALS["messages"]["uplink"]
		),
		array
		(
			'id' => 'home',
			'link' => make_link("list", NULL, NULL),
			'enabled' => true,
			'alt' => $GLOBALS["messages"]["homelink"]
		),
		array
		(
			'id' => 'reload',
			'link' => 'javascript:location.reload()',
			'enabled' => true,
			'alt' => $GLOBALS["messages"]["reloadlink"]
		),
		array
		(
			'id' => 'search',
			'link' => make_link('search', $dir, NULL),
			'enabled' => true,
			'alt' => $GLOBALS["messages"]["searchlink"]
		),
		array ( 'id' => "separator" ),
		array
		(
			'id' => 'copy',
			"link" => "javascript:Copy();",
			'alt' => $GLOBALS["messages"]["copylink"],
			'enabled' => permissions_grant_all($dir, NULL, array("create", "read"))
		),
		array
		(
			'id' => 'move',
		 	'enabled' => permissions_grant($dir, NULL, "change"),
			'link' => "javascript:Move();",
			'alt' => $GLOBALS["messages"]["movelink"]
		),
		array
		(
			'id' => 'delete',
		 	'enabled' => permissions_grant($dir, NULL, "delete"),
			'link' => 'javascript:Delete();',
			'alt' => $GLOBALS["messages"]["dellink"],
		),
		array
		(
			'id' => 'upload',
		 	'enabled' => permissions_grant($dir, NULL, "create") && get_cfg_var("file_uploads"),
			'link' => make_link("upload", $dir, NULL),
			"alt" => $GLOBALS["messages"]["uploadlink"],
		),
		array
		(
			'id' => 'archive',
			'link' => "javascript:Archive();",
			'alt' => $GLOBALS["messages"]["comprlink"],
			'enabled' => permissions_grant_all($dir, NULL, array("create", "read"))
				&& ($GLOBALS["zip"] || $GLOBALS["tar"] || $GLOBALS["tgz"])
		)
	);


	// ADMIN & LOGOUT
	array_push($buttons,
			array ( 'id' => 'separator' ));
	array_push($buttons,
			array
			(
			 	'id' => 'admin',
				'link' => make_link("admin", $dir, NULL),
				"alt" => $GLOBALS["messages"]["adminlink"],
				'enabled' => permissions_grant(NULL, NULL, "admin")
						|| permissions_grant(NULL, NULL, "password"),
			));
	array_push($buttons,
			array
			(
			 	'id' => 'logout',
				'link' => make_link("logout", $dir, NULL),
				"alt" => $GLOBALS["messages"]["logoutlink"],
				'enabled' => login_ok(),
			));

	// Create File / Dir
	if (permissions_grant($dir, NULL, "create"))
	{
		array_push($buttons,
				array
				(
				 	'id' => 'createdir',
					'link' => make_link("mkitem", $dir, NULL),
					"alt" => $GLOBALS["messages"]["createfile"],
					'enabled' => true,
				));
		array_push($buttons,
				array
				(
				 	'id' => 'createfile',
					'link' => make_link("mkitem", $dir, NULL),
					"alt" => $GLOBALS["messages"]["createdir"],
					'enabled' => true,
				));
	}

	return $buttons;
}	

function _get_columns ()
{
	$columns = array
	(
	 	array (
			'id' => 'name',
			'name' => $GLOBALS["messages"]["nameheader"],
		      ),
		array (
			'id' => 'size',
			'name' => $GLOBALS["messages"]["sizeheader"],
			),
		array (
			'id' => 'type',
			'name' => $GLOBALS["messages"]["typeheader"],
		      ),
		array (
			'id' => 'modified',
			'name' => $GLOBALS["messages"]["modifheader"],
		      ),
		array (
			'id' => 'permissions',
			'name' => $GLOBALS["messages"]["permheader"],
		      ),
		array (
			'id' => 'action',
			'name' => $GLOBALS["messages"]["actionheader"],
		      ),
	);

	return $columns;
}

?>
