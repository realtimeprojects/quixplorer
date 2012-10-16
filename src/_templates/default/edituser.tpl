{include file=header.tpl}

<FORM name="edituser" action="?action=admin&amp;action2=edituser" method="post">

	<INPUT type="hidden" name="confirm" value="true">
	<INPUT type="hidden" name="user" value="{$user}">
	<BR>
	<TABLE width="450">
		<TR>
			<TD>{$messages.miscusername}</TD>
			<TD align="right">
				<INPUT type="text" name="nuser" size="30" value="{$user}"
					{if !$editname} disabled{/if} >
			</TD>
		</TR>
	<TR>
		<TD>{$messages.miscconfpass}</TD>
		<TD align="right">
			<INPUT type="password" name="pass1" size="30">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscconfnewpass}:</TD>
		<TD align="right">
			<INPUT type="password" name="pass2" size="30">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscchpass}</TD>
		<TD align="right">
			<INPUT type="checkbox" name="chpass" value="true"
				{if $user == NULL} checked disabled {/if} >
		</TD>
	</TR>
	<TR>
		<TD>{$messages.mischomedir}:</TD>
		<TD align="right">
			<INPUT type="text" name="home_dir" size="30" value="{$data->home}">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.mischomeurl}:</TD>
		<TD align="right">
			<INPUT type="text" name="home_url" size="30" value="{$data->url}">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscshowhidden}</TD>
		<TD align="right">
			<SELECT name="show_hidden">
				<OPTION value="1" {if $data->show_hidden}selected{/if} >
					{$messages.miscyesno.0}
				</OPTION>
				<OPTION value="0" {if !$data->show_hidden}selected{/if} >
					{$messages.miscyesno.1}
				</OPTION>
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD>{$messages.mischidepattern}:</TD>
		<TD align="right">
			<INPUT type="text" name="no_access" size="30" value="{$data->no_access}">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscperms}:</TD>
		<TD align="right">
			<TABLE>
		{foreach from=$permvalues key=name item=value}
		<TR><TD>
			<INPUT type="checkbox" title="{$messages.miscpermissions.$name.0}"
				name="permsettings[]" value="{$value.value}" 
					{if $value.checked}checked{/if} {if $value.disabled}disabled{/if} >
				{if isset($messages.miscpermissions.$name.0)}
					{$messages.miscpermissions.$name.0}
				{else}
					{$name}
				{/if}
			</INPUT>
		</td>
		</TR>
		{/foreach}
			</TABLE>
		</td>
	</TR>

	<TR>
		<TD>{$messages.miscactive}:</TD>
		<TD align="right">
			<SELECT name="active" {if $self}DISABLED{/if} >
				<OPTION value="1" {if $data->active} selected {/if}>{$messages.miscyesno.0}</OPTION>
				<OPTION value="0" {if !$data->active} selected {/if}>
					{$messages.miscyesno.1}
				</OPTION>
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD colspan="2" align="right">
			<input type="submit" value="{$messages.btnsave}" onClick="return check_pwd();" >
			<input type="button" value="{$messages.btncancel}" 
				onClick="javascript:location='?action=admin'">
		</TD>
	</TR>
</TABLE>
</FORM>
{include file=footer.tpl}

