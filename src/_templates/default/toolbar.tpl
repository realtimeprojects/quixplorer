<BR>
<div id="toolbar">
<div id="search">
	<input onchange="javascript:SearchData();" type="text" value="{$search}" name="search"></input>&nbsp;<input type="button" value="{$messages.btnsearch}" name="btnsearch"></input>
</div>
<div id="buttons">
	{foreach from=$buttons item=button}
		{if $button.id != "separator"}
		{if $button.enabled}
			<A HREF="{$button.link}">
			<IMG
                class="enabled"
				border="0"
				src="{$themedir}/images/buttons/{$button.id}.png"
			alt="{$button.alt}"
			TITLE="{$button.alt}" /></A>
		{else}
			<IMG class='button'
				border="0"
                class="disabled"
				src="{$themedir}/images/buttons/{$button.id}.png"
			alt="{$button.alt}"
			TITLE="{$button.alt}" />
		{/if}
		{else}
			::
		{/if}
	{/foreach}
</div>
</div>
