// Edit / Delete
function Edit()
{
	document.userform.action2.value = "edituser";
	document.userform.submit();
}

function Delete(msg)
{
	var ml = document.userform;
	var len = ml.elements.length;
	var user;
	for (var i=0; i<len; ++i)
	{
		var e = ml.elements[i];
		if(e.name == "user" && e.checked)
		{
			user=e.value;
			break;
		}
	}

	if(confirm(msg.replace(/%s/, user)))
	{
		document.userform.action2.value = "rmuser";
		document.userform.submit();
	}
}
