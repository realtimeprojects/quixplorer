<?php

require "./_include/error.php";

if(isset($_SERVER)) {
	$GLOBALS['__GET']	=&$_GET;
	$GLOBALS['__POST']	=&$_POST;
	$GLOBALS['__SERVER']	=&$_SERVER;
	$GLOBALS['__FILES']	=&$_FILES;
} elseif(isset($HTTP_SERVER_VARS)) {
	$GLOBALS['__GET']	=&$HTTP_GET_VARS;
	$GLOBALS['__POST']	=&$HTTP_POST_VARS;
	$GLOBALS['__SERVER']	=&$HTTP_SERVER_VARS;
	$GLOBALS['__FILES']	=&$HTTP_POST_FILES;
} else {
	die("<B>ERROR: Your PHP version is too old</B><BR>".
	"You need at least PHP 4.0.0 to run QuiXplorer; preferably PHP 4.3.1 or higher.");
}
//------------------------------------------------------------------------------
// Get Action
if(isset($GLOBALS['__GET']["action"])) $GLOBALS["action"]=$GLOBALS['__GET']["action"];
else $GLOBALS["action"]="list";
if($GLOBALS["action"]=="post" && isset($GLOBALS['__POST']["do_action"])) {
	$GLOBALS["action"]=$GLOBALS['__POST']["do_action"];
}
if($GLOBALS["action"]=="") $GLOBALS["action"]="list";
$GLOBALS["action"]=stripslashes($GLOBALS["action"]);

// Get Item
if(isset($GLOBALS['__GET']["item"])) $GLOBALS["item"]=stripslashes($GLOBALS['__GET']["item"]);
else $GLOBALS["item"]="";
// Get Sort
if(isset($GLOBALS['__GET']["order"])) $GLOBALS["order"]=stripslashes($GLOBALS['__GET']["order"]);
else $GLOBALS["order"]="name";
if($GLOBALS["order"]=="") $GLOBALS["order"]=="name";
// Get Sortorder (yes==up)
if(isset($GLOBALS['__GET']["srt"])) $GLOBALS["srt"]=stripslashes($GLOBALS['__GET']["srt"]);
else $GLOBALS["srt"]="yes";
if($GLOBALS["srt"]=="") $GLOBALS["srt"]=="yes";
// Get Language
if(isset($GLOBALS['__GET']["lang"])) $GLOBALS["lang"]=$GLOBALS['__GET']["lang"];
elseif(isset($GLOBALS['__POST']["lang"])) $GLOBALS["lang"]=$GLOBALS['__POST']["lang"];
//------------------------------------------------------------------------------
// Necessary files
ob_start(); // prevent unwanted output

if (!is_readable("./_config/conf.php"))
    show_error("./_config/conf.php not found.. please see installation instructions");

require "./_config/conf.php";
require "./_config/configs.php";
if(isset($GLOBALS["lang"])) $GLOBALS["language"]=$GLOBALS["lang"];
require "./_lang/".$GLOBALS["language"].".php";
require "./_lang/".$GLOBALS["language"]."_mimes.php";
require "./_config/mimes.php";
require "./_include/fun_extra.php";
require_once "./_include/header.php";
require "./_include/footer.php";
ob_start(); // prevent unwanted output
require_once "./_include/login.php";
login_check();
ob_end_clean(); // get rid of cached unwanted output
$prompt = isset($GLOBALS["login_prompt"][$GLOBALS["language"]])
	? $GLOBALS["login_prompt"][$GLOBALS["language"]]
	: $GLOBALS["login_prompt"]["en"];
if (isset($prompt))
	$GLOBALS["messages"]["actloginheader"] = $prompt;

ob_end_clean(); // get rid of cached unwanted output

// Manage display directory
global $dir;
global $home_dir;

_debug( "checking post " . $_GET[ "dir" ] );
if ( isset( $_GET[ "dir" ] ) )
{
    $dir = stripslashes( $_GET["dir"] );
}
else
{
    _debug(" no directory in _GET, using home directory '$home_dir'" );
    $dir = $home_dir;
}


?>
