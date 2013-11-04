<BR>
<div id="toolbar">
<div id="search">
	<input onchange="javascript:SearchData();" type="text" value="{$search}" name="search" />
    <input type="button" value="{$messages.btnsearch}" name="btnsearch" />
</div>
<div id="buttons">
	{foreach from=$buttons item=button}
            <i class="icon-{$button.id}" style="{if $button.enabled != "1" }color:lightgrey{/if}"></i>
	{/foreach}
</div>
</div>
