<?php
function path_r ($path)
{
    global $home_dir;
    $base = realpath($home_dir);
    $path = preg_replace("#^\./#", "", $path);
    $path = preg_replace("#^$base/#", "", $path);
    return $path;
}

function parse_file_type($dir,$item) {		// parsed file type (d / l / -)
	$abs_item = get_abs_item($dir, $item);
	if(@is_dir($abs_item)) return "d";
	if(@is_link($abs_item)) return "l";
	return "-";
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function parse_file_perms($mode) {		// parsed file permisions
	if(strlen($mode)<3) return "????????";
	$parsed_mode="";
	for($i=0;$i<3;$i++) {
		// read
		if(($mode{$i} & 04)) $parsed_mode .= "r";
		else $parsed_mode .= "-";
		// write
		if(($mode{$i} & 02)) $parsed_mode .= "w";
		else $parsed_mode .= "-";
		// execute
		if(($mode{$i} & 01)) $parsed_mode .= "x";
		else $parsed_mode .= "-";
	}
	return $parsed_mode;
}
//------------------------------------------------------------------------------
function get_file_size($dir, $item) {		// file size
	return @filesize(get_abs_item($dir, $item));
}
//------------------------------------------------------------------------------
function parse_file_size($size) {		// parsed file size
	if($size >= 1073741824) {
		$size = round($size / 1073741824 * 100) / 100 . " GB";
	} elseif($size >= 1048576) {
		$size = round($size / 1048576 * 100) / 100 . " MB";
	} elseif($size >= 1024) {
		$size = round($size / 1024 * 100) / 100 . " KB";
	} else $size = $size . " Bytes";
	if($size==0) $size="-";

	return $size;
}
//------------------------------------------------------------------------------
function get_file_date($dir, $item) {		// file date
	return @filemtime(get_abs_item($dir, $item));
}
//------------------------------------------------------------------------------
function parse_file_date($date) {		// parsed file date
	return @date($GLOBALS["date_fmt"],$date);
}
//------------------------------------------------------------------------------
function get_is_image($dir, $item) {		// is this file an image?
	if(!get_is_file($dir, $item)) return false;
	return @eregi($GLOBALS["images_ext"], $item);
}

function get_is_editable($dir, $item) {		// is this file editable?
	if(!get_is_file($dir, $item)) return false;
	foreach($GLOBALS["editable_ext"] as $pat) if(@eregi($pat,$item)) return true;
	return false;
}

function get_is_unzipable($dir, $item) {		// is this file editable?
	if(!get_is_file($dir, $item)) return false;
	foreach($GLOBALS["unzipable_ext"] as $pat) if(@eregi($pat,$item)) return true;
	return false;
}

//------------------------------------------------------------------------------
function copy_dir($source,$dest) {		// copy dir
	$ok = true;

	if(!@mkdir($dest,0777)) return false;
	if(($handle=@opendir($source))===false) show_error(basename($source).": ".$GLOBALS["error_msg"]["opendir"]);

	while(($file=readdir($handle))!==false) {
		if(($file==".." || $file==".")) continue;

		$new_source = $source."/".$file;
		$new_dest = $dest."/".$file;
		if(@is_dir($new_source)) {
			$ok=copy_dir($new_source,$new_dest);
		} else {
			$ok=@copy($new_source,$new_dest);
		}
	}
	closedir($handle);
	return $ok;
}
//------------------------------------------------------------------------------
function remove($item) {			// remove file / dir
	$ok = true;
	if(@is_link($item) || @is_file($item)) $ok=@unlink($item);
	elseif(@is_dir($item)) {
		if(($handle=@opendir($item))===false) show_error(basename($item).": ".$GLOBALS["error_msg"]["opendir"]);

		while(($file=readdir($handle))!==false) {
			if(($file==".." || $file==".")) continue;

			$new_item = $item."/".$file;
			if(!@file_exists($new_item)) show_error(basename($item).": ".$GLOBALS["error_msg"]["readdir"]);
			//if(!get_show_item($item, $new_item)) continue;

			if(@is_dir($new_item)) {
				$ok=remove($new_item);
			} else {
				$ok=@unlink($new_item);
			}
		}

		closedir($handle);
		$ok=@rmdir($item);
	}
	return $ok;
}
//------------------------------------------------------------------------------
function get_max_file_size() {			// get php max_upload_file_size
	$max = get_cfg_var("upload_max_filesize");
	if(@eregi("G$",$max)) {
		$max = substr($max,0,-1);
		$max = round($max*1073741824);
	} elseif(@eregi("M$",$max)) {
		$max = substr($max,0,-1);
		$max = round($max*1048576);
	} elseif(@eregi("K$",$max)) {
		$max = substr($max,0,-1);
		$max = round($max*1024);
	}

	return $max;
}
//------------------------------------------------------------------------------
function id_browser() {
	$browser=$GLOBALS['__SERVER']['HTTP_USER_AGENT'];

	if(ereg('Opera(/| )([0-9].[0-9]{1,2})', $browser)) {
		return 'OPERA';
	} else if(ereg('MSIE ([0-9].[0-9]{1,2})', $browser)) {
		return 'IE';
	} else if(ereg('OmniWeb/([0-9].[0-9]{1,2})', $browser)) {
		return 'OMNIWEB';
	} else if(ereg('(Konqueror/)(.*)', $browser)) {
		return 'KONQUEROR';
	} else if(ereg('Mozilla/([0-9].[0-9]{1,2})', $browser)) {
		return 'MOZILLA';
	} else {
		return 'OTHER';
	}
}
//------------------------------------------------------------------------------
?>
