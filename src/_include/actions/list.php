<?php

Qx::useModule("permissions");
Qx::useModule("Summary");
Qx::useModule("QxDirectory");
Qx::useModule("Button");

function do_list_action(Action $action)
{
    _debug("do_list_action($action->directory)");

    $qxdir = new QxDirectory($action->directory);
    $files = $qxdir->read();
    $totals = new Summary();
    foreach ($files as $file)
        $totals->add($file->fullpath);

    do_list_show($action->directory, $files, $totals);
}

function do_list_show(string $directory, $files, $totals)
{
	QxSmarty::assign('files', $files);
	QxSmarty::assign('totals', $totals);
	QxSmarty::assign('directory', $directory);
	QxSmarty::assign('buttons', _get_buttons($directory));
    QxSmarty::display('list');
}

function _get_buttons ($dir)
{
	$buttons = array
	(
		new Button('up',          "@@buttons.up@@",          new QxLink("list", Path::append($dir, "..")), true),
		new Button('home',        "@@buttons.home@@",        new QxLink("list"),                           true),
		new Button('reload',      "@@buttons.reload@@",      'javascript:location.reload()',               true),
		new Button('search',      "@@buttons.search@@",      new QxLink('search', $dir),                   true),
		new Button("separator"),
		new Button('copy',        "@@buttons.copy@@",        "javascript:Copy();",                         permissions_grant_all($dir, NULL, array("create", "read"))),
		new Button('move',        "@@buttons.move@@",        "javascript:Move();",                         permissions_grant($dir, NULL, "change")),
		new Button('delete',      "@@buttons.delete@@",      'javascript:Delete();',                       permissions_grant($dir, NULL, "delete")),
		new Button('upload',      "@@buttons.upload@@",      new QxLink("upload", $dir),                   permissions_grant($dir, NULL, "create") && get_cfg_var("file_uploads")),
	    new Button('archive',     "@@buttons.zip@@",         "javascript:Archive();",                      permissions_grant_all($dir, NULL, array("create", "read")) && ($GLOBALS["zip"] || $GLOBALS["tar"] || $GLOBALS["tgz"])),
        new Button('separator'),
        new Button('admin',       "@@buttons.admin@@",       new QxLink("admin", $dir),                    permissions_grant(NULL, NULL, "admin") || permissions_grant(NULL, NULL, "password")),
        // FIXME determine if user is logged in (session)
        new Button('logout',      "@@buttons.logout@@",      new QxLink("logout", $dir),                   false),
        new Button('create_dir',  "@@buttons.createdir@@",   new QxLink("mkitem", $dir),                   permissions_grant($dir, NULL, "create")),
        new Button('create_file', "@@buttons.createfile@@",  new QxLink("mkitem", $dir),                   permissions_grant($dir, NULL, "create")),
	);

	return $buttons;
}
?>
