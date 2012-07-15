/**
 *     wp image slideshow
 *     Copyright (C) 2012  www.gopipulse.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


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
		document.frm_wpis_display.action="options-general.php?page=wp-image-slideshow/image-management.php&AC=DEL&DID="+id;
		document.frm_wpis_display.submit();
	}
}	

function wpis_redirect()
{
	window.location = "options-general.php?page=wp-image-slideshow/image-management.php";
}

function wpis_help()
{
	window.open("http://www.gopipulse.com/work/2011/05/06/wordpress-plugin-wp-image-slideshow/");
}
