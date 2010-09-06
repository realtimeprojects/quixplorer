{include file=header.tpl}
	
<TABLE>
	<FORM name="searchform" method="post">
	<TR>
		<TD>
			<INPUT name="searchitem" type="text" size="25" value="{$searchitem}">
			<INPUT type="submit" value="{$messages.btnsearch}">
			<input type="button" value="{$messages.btnclose}"
				onClick="javascript:location=list.php">
		</TD>
	</TR>
	<TR>
		<TD>
			<INPUT type="checkbox" name="subdir" value="y">{$messages.miscsubdirs}
		</TD>
	</TR>
	</FORM>
</TABLE>
{include file=footer.tpl}
