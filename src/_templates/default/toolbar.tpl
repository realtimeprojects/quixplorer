<BR>
<div id="toolbar">
<div id="search">
	<input onchange="javascript:SearchData();" type="text" value="{$search}" name="search" />
    <input type="button" value="{$messages.btnsearch}" name="btnsearch" />
</div>
<div id="buttons">
	{foreach from=$buttons item=button}
            {button link=$button.link content="<i class=\"icon-{$button.id}\"></i>" title='$button.title' enabled={$button.enabled}}
	{/foreach}
</div>
</div>
