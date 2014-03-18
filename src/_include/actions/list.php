<?php

require_once("./_include/permissions.php");
require_once("./_include/Summary.php");
require_once "_include/QxDirectory.php";

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
		array
		(
			'id' => 'up',
			'link' => new QxLink("list", Path::append($dir, "..")),
			'enabled' => true,
			'title' => "@@buttons.up@@"
		),
		array
		(
			'id' => 'home',
			'link' => new QxLink("list"),
			'enabled' => true,
			'title' => "@@buttons.home@@"
		),
		array
		(
			'id' => 'reload',
			'link' => 'javascript:location.reload()',
			'enabled' => true,
			'title' => "@@buttons.reload@@"
		),
		array
		(
			'id' => 'search',
			'link' => new QxLink('search', $dir),
			'enabled' => true,
			'title' => "@@buttons.search@@"
		),
		array ( 'id' => "separator" ),
		array
		(
			'id' => 'copy',
			"link" => "javascript:Copy();",
			'enabled' => permissions_grant_all($dir, NULL, array("create", "read")),
			'title' => "@@buttons.copy@@"
		),
		array
		(
			'id' => 'move',
		 	'enabled' => permissions_grant($dir, NULL, "change"),
			'link' => "javascript:Move();",
			'title' => "@@buttons.move@@"
		),
		array
		(
			'id' => 'delete',
		 	'enabled' => permissions_grant($dir, NULL, "delete"),
			'link' => 'javascript:Delete();',
			'title' => "@@buttons.delete@@"
		),
		array
		(
			'id' => 'upload',
		 	'enabled' => permissions_grant($dir, NULL, "create") && get_cfg_var("file_uploads"),
			'link' => new QxLink("upload", $dir),
			"title" => "@@buttons.upload@@"
		),
		array
		(
			'id' => 'archive',
			'link' => "javascript:Archive();",
			'enabled' => permissions_grant_all($dir, NULL, array("create", "read"))
				&& ($GLOBALS["zip"] || $GLOBALS["tar"] || $GLOBALS["tgz"]),
			'title' => "@@buttons.zip@@",
		)
	);


	// ADMIN & LOGOUT
	array_push($buttons,
			array ( 'id' => 'separator' ));
	array_push($buttons,
			array
			(
			 	'id' => 'admin',
				'link' => new QxLink("admin", $dir),
				'enabled' => permissions_grant(NULL, NULL, "admin")
						|| permissions_grant(NULL, NULL, "password"),
				"title" => "@@buttons.admin@@"
			));
	array_push($buttons,
			array
			(
			 	'id' => 'logout',
				'link' => new QxLink("logout", $dir),
                // FIXME determine if user is logged in (session)
				'enabled' => false,
				"title" => "@@buttons.logout@@",
			));

	// Create File / Dir
	if (permissions_grant($dir, NULL, "create"))
	{
		array_push($buttons,
				array
				(
				 	'id' => 'create_dir',
					'link' => new QxLink("mkitem", $dir),
					'enabled' => true,
					"title" => "@@buttons.createdir@@"
				));
		array_push($buttons,
				array
				(
				 	'id' => 'create_file',
					'link' => new QxLink("mkitem", $dir),
					'enabled' => true,
					"title" => "@@buttons.createfile@@",
				));
	}

	return $buttons;
}
?>
