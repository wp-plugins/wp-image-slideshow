function wpis_submit()
{
	if(document.wpis_form.wpis_path.value=="")
	{
		alert("Please enter the image path.")
		document.wpis_form.wpis_path.focus();
		return false;
	}
	else if(document.wpis_form.wpis_link.value=="")
	{
		alert("Please enter the target link.")
		document.wpis_form.wpis_link.focus();
		return false;
	}
	else if(document.wpis_form.wpis_target.value=="")
	{
		alert("Please enter the target status.")
		document.wpis_form.wpis_target.focus();
		return false;
	}
	else if(document.wpis_form.wpis_order.value=="")
	{
		alert("Please enter the display order, only number.")
		document.wpis_form.wpis_order.focus();
		return false;
	}
	else if(isNaN(document.wpis_form.wpis_order.value))
	{
		alert("Please enter the display order, only number.")
		document.wpis_form.wpis_order.focus();
		return false;
	}
	else if(document.wpis_form.wpis_status.value=="")
	{
		alert("Please select the display status.")
		document.wpis_form.wpis_status.focus();
		return false;
	}
	else if(document.wpis_form.wpis_type.value=="")
	{
		alert("Please enter the gallery type.")
		document.wpis_form.wpis_type.focus();
		return false;
	}
}

function wpis_delete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm_wpis_display.action="options-general.php?page=wp-image-slideshow&ac=del&did="+id;
		document.frm_wpis_display.submit();
	}
}	

function wpis_redirect()
{
	window.location = "options-general.php?page=wp-image-slideshow";
}

function wpis_help()
{
	window.open("http://www.gopiplus.com/work/2011/05/06/wordpress-plugin-wp-image-slideshow/");
}