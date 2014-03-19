{include file="header.tpl"}

<TABLE width="300">
	<TR>
		<TD colspan="2" class="header" nowrap>
			<B>@@login.login@@</B>
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
	<input type="hidden" name='action' value='login'>
	<input type="hidden" name='activity' value='authenticate'>
	<TR>
		<TD>@@username@@</TD>
		<TD align="right">
			<INPUT name="loginname" type="text" size="25">
		</TD>
	</TR>
	<TR>
		<TD>@@password@@</TD>
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
	document.login.loginname.focus();
// -->
</script>
{include file="footer.tpl"}
