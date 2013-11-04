{include file="header.tpl"}

<TABLE width="300">
	<TR>
		<TD colspan="2" class="header" nowrap>
			<B>{$messages.actloginheader}</B>
		</TD>
	</TR>
	{if $message != ''}
	<TR>
		<TD colspan="2" class="errormessage" nowrap>
			<h4>{$message}</h4>
		</TD>
	</TR>
	{/if}
	<FORM name="login" method="post">
	<input type="hidden" name='action' value='list'>
	<TR>
		<TD>{$messages.miscusername}</TD>
		<TD align="right">
			<INPUT name="loginname" type="text" size="25">
		</TD>
	</TR>
	<TR>
		<TD>{$messages.miscpassword}</TD>
		<TD align="right">
		<INPUT name="password" type="password" size="25">
		</TD>
	</TR>
	<TR>
		<TD colspan="2" align="right">
		<INPUT type="submit" value="{$messages.btnlogin}">
		</TD>
	</TR>
	</FORM>
</TABLE>
<BR>
<script language="JavaScript1.2" type="text/javascript">
<!--
	if (document.login)
	document.login.p_user.focus();
// -->
</script>
{include file="footer.tpl"}
