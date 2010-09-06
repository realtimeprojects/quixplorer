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

     The Original Code is fun_users.php, released on 2003-03-31.

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
	http://quixplorer.sourceforge.net

Comment:
	User administration
	
	Have Fun...
------------------------------------------------------------------------------*/

class User
{
	public	$name;		
	public	$password;
	public	$home;
	public	$url;
	public	$show_hidden;
	public	$no_access;
	public	$permissions;
	public	$active;

	public function	__construct ($name, $pass, $home, $url, $sh, $na, $perm, $active)
	{
		$this->name = $name;
		$this->password = $pass;
		$this->home = $home;
		$this->url = $url;
		$this->show_hidden = $sh;
		$this->no_access = $na;
		$this->permissions = $perm;
		$this->active = $active;
	}
}

?>
