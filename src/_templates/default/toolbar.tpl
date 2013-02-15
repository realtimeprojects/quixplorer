<BR>
<div id="toolbar">
<div id="search">
	<input onchange="javascript:SearchData();" type="text" value="{$search}" name="search" />
    <input type="button" value="{$messages.btnsearch}" name="btnsearch" />
</div>
<div id="buttons">
	{foreach from=$buttons item=button}
		{if $button.id != "separator"}
            {button link=$button.link img="$themedir/images/buttons/{$button.id}.png" title=$button.alt enabled=$button.enabled }
		{else}
			::
		{/if}
	{/foreach}
</div>
</div>
