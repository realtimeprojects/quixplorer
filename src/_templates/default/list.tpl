{include file=header.tpl}
<FORM name="selform" method="POST" action='.'>
{include file=toolbar.tpl}
<HR>
<INPUT type="hidden" name="action">
<INPUT type="hidden" name="first" value="y">
<INPUT type="hidden" name="srt" value="{$srt}">
<INPUT type="hidden" name="order" value="{$order}">
<INPUT type="hidden" name="lang" value="{$lang}">
<TABLE cellspacing=0 cellpadding=0 class='files' WIDTH="95%">
	<tr>
	<th WIDTH="2%" class="header">
		<INPUT TYPE="checkbox" name="toggleAllC" onclick="ToggleAll(this);">
	</th>
	{foreach from=$columns item=column}
	<th WIDTH="44%" class="header" id='{$column.id}'>
	<A href="{$url}?action=list?dir={$dir}&order={$column.id}&srt={if $srt != 'yes'}yes{/if}">{$column.name}
	{if $order == $column.id}
		<img src='{$themedir}/images/sort_{if $srt == 'yes'}down{else}up{/if}.png' />
	{/if}
	</a>
	</th>
	{/foreach}
	</tr>
	{foreach from=$files item=file}
	{if $file.special == "directory"}
	<tr class="rowdata" id="dirmarker">
		<TD id='name' colspan=7 nowrap>
		{$file.type}
		{if $file.link != ''}
			<A HREF="{$file.link}">
		{/if}
		{$file.name}
		{if $file.link != ''}
			</a>
		{/if}
		</TD>
	</tr>
	{else}
	<TR class="rowdata">
		<TD><INPUT TYPE="checkbox" name="selitems[]" value="{$file.name}"
			onclick="javascript:Toggle(this);">
		</TD>
		<TD id='name' nowrap>
		{if $file.link != ''}
			<A HREF="{$file.link}">
		{/if}
		<IMG class='fileicon' src='{$themedir}/images/{$file.icon}.gif' ALT="" />&nbsp;
		{$file.name}
		{if $file.link != ''}
			</a>
		{/if}
		</TD>
		<TD id='size' >{$file.size}</TD>
		<TD id='type' >{$file.type}</TD>
		<TD id='modified' >{$file.modified}</td>
		<TD id='permissions'>
		{if $file.permissions.link != ''}
			<A HREF="{$file.permissions.link}">{$file.permissions.text}</a>
		{else}
			{$file.permissions.text}
		{/if}
		</TD>
		<TD id='edit'>
			{if $file.type != 'Directory'}
				{if $file.editlink != ''}
				<a href='{$file.editlink}'>
				<img src='{$themedir}/images/buttons/enabled/edit.png' alt='edit' />
				</a>
				{else}
				<img src='{$themedir}/images/buttons/disabled/edit.png' alt='edit' />
				{/if}
				{if $file.link != ''}
				<a href='{$file.link}'>
				<img src='{$themedir}/images/buttons/enabled/download.png' alt='download' />
				</a>
				{else}
				<img src='{$themedir}/images/buttons/disabled/download.png' alt='download' />
				{/if}
			{/if}
		</TD>
	</TR>
	{/if}
	{/foreach}
</table>
</form>
<hr>
<div class='sum_info'>
	{$info.files} {$messages.miscitems} {$info.total} ({$info.free} {$messages.miscfree})
</div>
{include file=footer.tpl}

