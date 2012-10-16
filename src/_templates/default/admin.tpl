{include file=header.tpl}
<BR>
<HR width="95%">
	<div align="center">
	<h3>{$messages.actchpwd}</h3>
	<FORM action="." method="post">
	<input type="hidden" name="action" value="admin">
	<INPUT type="hidden" name="action2" value="chpwd">
<TABLE width="350" id="change_password">
	<TR>
		<TD>{$messages.miscoldpass}</TD>
		<TD align="right">
			<INPUT type="password" name="oldpwd" size="25">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscnewpass}</TD>
		<TD align="right">
			<INPUT type="password" name="newpwd1" size="25">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscconfnewpass}</TD>
		<TD align="right">
		<INPUT type="password" name="newpwd2" size="25"></TD>
	</TR>
	<TR>
		<TD colspan="2" align="right">
		<INPUT type="submit" value="{$messages.btnchange}">
		</TD>
	</TR>
</TABLE>
</FORM>
</div>

<!-- admin dialog -->
{if $admin == true}
<HR width="95%">
<div align="center">
<h3>{$messages.actusers}</h3>
</div>
		<FORM name="userform" action="." method="post">
		<INPUT type="hidden" name="action" value="admin">
		<INPUT type="hidden" name="action2" value="edituser">
	<TABLE width="750" id="admin_dialog">
		<TR>
			<TD colspan="5">{$messages.miscuseritems}</TD>
		</TR>
		{foreach from=$users key=name item=user}
			<TR>
				<TD width="1%">
					<INPUT TYPE="radio" name="user" value="{$name}">
				</TD>
				<TD width="30%">{$name|truncate:15:"..."}</TD>
				<TD width="60%">
						{$user->home|truncate:30:"..."}
				</TD>
				<TD width="3%">
					{if $user->show_hidden == true}
						{$messages.miscyesno.2}
					{else}
						{$messages.miscyesno.3}
					{/if}
				</TD>
				<TD width="3%">{$user->permissions}</TD>
				<TD width="3%">
					{if $user->active == true}
						{$messages.miscyesno.2}
					{else}
						{$messages.miscyesno.3}
					{/if}
				</TD>
			</TR>
		{/foreach}
		<TR>
			<TD colspan="6" align="right">
				<input type="button" value="{$messages.btnadd}"
					onClick="javascript:location='?action=admin&amp;action2=adduser'">
				<input type="button" value="{$messages.btnedit}"
					onClick="javascript:Edit();">
				<input type="button" value="{$messages.btnremove}"
					onClick="javascript:Delete('{$error_msg.miscdeluser}')">
			</TD>
		</TR>
	</TABLE>
		</FORM>
	
	<HR width="95%">
		<input type="button" value="{$messages.btnclose}"
			onClick="javascript:location='?action=list'">
	<br><br>
{/if} <!-- admin dialog -->
	<script language="JavaScript1.2" type="text/javascript">
<!--
	if(document.chpwd) document.chpwd.oldpwd.focus();
// -->
	</script>

{include file=footer.tpl}
