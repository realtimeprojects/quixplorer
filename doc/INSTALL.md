INSTALLATION INSTRUCTIONS
=========================

This document guides you to the installation of quixplorer on your webserver.

### Installation steps

1. Download the latest version of QuiXplorer.
2. Unzip it to a folder on your website. (e.g. /home/you/htdocs/quixplorer)
   (you may want to protect this folder using .htaccess)
3. Copy the file _\_config/\_htusers.php.template_ to _config/.htusers.php_,
4. Copy the file _\_config/conf.php.template to _\_config/conf.php_,
5. Set _home_dir_ in _conf.php_ to your desired home folder (e.g. /home/you/htdocs). Don't use "/" as home_dir since it will not work properly at is very unsafe.
6. and set _home_url_ to the corresponding URL. (e.g. http://yoursite)
7. If you want, enable uploadify as upload interface by adding this line to your conf.php:
	$GLOBALS["use_uploadify"] = true;
8. ** Change the admin passwort immediatly **
9. Have Fun...

### Troubleshooting

* Some browsers (e.g. Konqueror) may want to save a download as index.php.
  To solve this, just supply the correct name when saving.
* Internet Explorer may behave strangely when downloading files.
  If you open the php-file download, the real download window should open.
* Mozilla may add the extension 'php' to a file being downloaded.
  Save as 'any file (*.*)' and remove the 'php' extension to get the proper name.
  (NOTE: for php-files, this extension is correct)
* If you are unable to perform certain operations,
  try using a FTP-chmod to set the directories to 755 and the files to 644.
* If you don\'t know the full name of a directory on your website,
  you can use a php-script containing '<?php echo getcwd(); ?>' to get it.
* The Search Function uses PCRE regex syntax to search; though wildcards like * and ?
  should work (like with 'ls' on Linux), it may show unexpected behaviour.
* User-management may logout unexpectedly or show other strange behaviour.
  This is due to a bug in PHP 4.1.2; we would advise you to upgrade to a higher version.

### Users

* user-authentication is activated by default, set "require_login" to false to
  disable user-authentication in "_config/conf.php";
  you should also set the path for the admin user in "\_config/.htusers.php".
* You can easily manage users using the "admin" section of QuiXplorer.
* Standard, there is only one user, "admin", with password "pwd_admin";
  you should change this password immediately.

### Languages:
* You can choose a default language by changing "language" in "_config/conf.php"
  (to "en", "de", "nl", "fr", "es", "ptbr", "it", "pl", "ro" or "ru").
* When using user-authentication, users can select a language on login.

