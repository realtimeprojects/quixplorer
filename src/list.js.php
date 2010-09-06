<?php
require "_config/conf.php";
require '_include/lang.php';
?>
// Checkboxes
function Toggle(e)
{
	Highlight(e, e.checked);
	document.selform.toggleAllC.checked = AllChecked();
}

function SearchData()
{
	document.selform.action.value = "search";
	document.selform.submit();
}

function ToggleAll(e)
{
	CheckAll(e.checked);
}

function CheckAll(checked)
{
	var ml = document.selform;
	var len = ml.elements.length;
	for(var i=0; i<len; ++i)
	{
		var e = ml.elements[i];
		if(e.name == "selitems[]")
		{
			e.checked = checked;
			Highlight(e, checked);
		}
	}
	ml.toggleAllC.checked = checked;
}

function AllChecked()
{
	ml = document.selform;
	len = ml.elements.length;
	for(var i=0; i<len; ++i)
	{
		if(ml.elements[i].name == "selitems[]" && !ml.elements[i].checked)
			return false;
	}
	return true;
}

function NumChecked() {
	ml = document.selform;
	len = ml.elements.length;
	num = 0;
	for(var i=0; i<len; ++i) {
		if(ml.elements[i].name == "selitems[]" && ml.elements[i].checked) ++num;
	}
	return num;
}


// Row highlight

function Highlight(e, highlight)
{
	var r = null;
	if(e.parentNode && e.parentNode.parentNode)
	{
		r = e.parentNode.parentNode;
	} else if(e.parentElement && e.parentElement.parentElement)
	{
		r = e.parentElement.parentElement;
	}
	r.className = "rowdata" + (highlight ? "sel" : "");
}

// Copy / Move / Delete

function Copy() {
	if(NumChecked()==0) {
		alert(messages[0]);
		return;
	}
	document.selform.action.value = "copy";
	document.selform.submit();
}

function Move() {
	if(NumChecked()==0) {
		alert("<?php echo $GLOBALS["error_msg"]["miscselitems"]; ?>");
		return;
	}
	document.selform.action.value = "move";
	document.selform.submit();
}

function Delete() {
	num=NumChecked();
	if(num==0) {
		alert("<?php echo $GLOBALS["error_msg"]["miscselitems"]; ?>");
		return;
	}
	if(confirm("<?php echo $GLOBALS["error_msg"]["miscdelitems"]; ?>")) {
		document.selform.action.value = "delete";
		document.selform.submit();
	}
}

function Archive() {
	if(NumChecked()==0) {
		alert("<?php echo $GLOBALS["error_msg"]["miscselitems"]; ?>");
		return;
	}
	document.selform.action.value = "arch";
	document.selform.submit();
}
