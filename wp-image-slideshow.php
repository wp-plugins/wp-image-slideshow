<?php

/*
Plugin Name: wp image slideshow
Plugin URI: http://www.gopiplus.com/work/2011/05/06/wordpress-plugin-wp-image-slideshow/
Description: This is advanced version of my drop in image slideshow gallery. In this gallery each image is dropped into view. Slideshow will pause on mouse over.
Author: Gopi.R
Version: 4.0
Author URI: http://www.gopiplus.com/work/
Donate link: http://www.gopiplus.com/work/2011/05/06/wordpress-plugin-wp-image-slideshow/
Tags: image, slideshow, gallery, dropin, drop in
*/

/**
 *     wp image slideshow
 *     Copyright (C) 2011  www.gopiplus.com
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

global $wpdb, $wp_version;
define("WP_wpis_TABLE", $wpdb->prefix . "wpis_plugin");

function wpis() 
{
	
	global $wpdb;
	
	$wpis_title = get_option('wpis_title');
	$wpis_width = get_option('wpis_width');
	$wpis_height = get_option('wpis_height');
	$wpis_pause = get_option('wpis_pause');
	$wpis_random = get_option('wpis_random');
	$wpis_type = get_option('wpis_type');
	
	if(!is_numeric(@$wpis_width)) { @$wpis_width = 200 ;}
	if(!is_numeric(@$wpis_height)) { @$wpis_height = 200; }
	if(!is_numeric(@$wpis_pause)) { @$wpis_pause = 3000; }
	
	$sSql = "select wpis_path,wpis_link,wpis_target,wpis_title from ".WP_wpis_TABLE." where 1=1";
	if($wpis_type <> ""){ $sSql = $sSql . " and wpis_type='".$wpis_type."'"; }
	if($wpis_random == "YES"){ $sSql = $sSql . " ORDER BY RAND()"; }else{ $sSql = $sSql . " ORDER BY wpis_order"; }
	
	$data = $wpdb->get_results($sSql);
	
	$wpis_count = 0;
	$wpis_returnstr = "";
	if ( ! empty($data) ) 
	{
		foreach ( $data as $data ) 
		{
			$wpis_str =  '["' . $data->wpis_path . '", "'. $data->wpis_link .'", "'. $data->wpis_target .'"]';
			$wpis_returnstr = $wpis_returnstr . "wpis_images[$wpis_count]=$wpis_str; ";
			$wpis_count++;
		}
	}	
	
	?>
    <script type="text/javascript">
	var wpis_images=new Array()
	<?php echo $wpis_returnstr; ?>
	new wpis(wpis_images, <?php echo $wpis_width; ?>, <?php echo $wpis_height; ?>, <?php echo $wpis_pause; ?>)
	</script>
    <?php

}

function wpis_install() 
{
	
	global $wpdb;
	
	if($wpdb->get_var("show tables like '". WP_wpis_TABLE . "'") != WP_wpis_TABLE) 
	{
		$sSql = "CREATE TABLE IF NOT EXISTS `". WP_wpis_TABLE . "` (";
		$sSql = $sSql . "`wpis_id` INT NOT NULL AUTO_INCREMENT ,";
		$sSql = $sSql . "`wpis_path` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,";
		$sSql = $sSql . "`wpis_link` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,";
		$sSql = $sSql . "`wpis_target` VARCHAR( 50 ) NOT NULL ,";
		$sSql = $sSql . "`wpis_title` VARCHAR( 500 ) NOT NULL ,";
		$sSql = $sSql . "`wpis_order` INT NOT NULL ,";
		$sSql = $sSql . "`wpis_status` VARCHAR( 10 ) NOT NULL ,";
		$sSql = $sSql . "`wpis_type` VARCHAR( 100 ) NOT NULL ,";
		$sSql = $sSql . "`wpis_extra1` VARCHAR( 100 ) NOT NULL ,";
		$sSql = $sSql . "`wpis_extra2` VARCHAR( 100 ) NOT NULL ,";
		$sSql = $sSql . "`wpis_date` datetime NOT NULL default '0000-00-00 00:00:00' ,";
		$sSql = $sSql . "PRIMARY KEY ( `wpis_id` )";
		$sSql = $sSql . ")";
		$wpdb->query($sSql);
		
		$IsSql = "INSERT INTO `". WP_wpis_TABLE . "` (`wpis_path`, `wpis_link`, `wpis_target` , `wpis_title` , `wpis_order` , `wpis_status` , `wpis_type` , `wpis_date`)"; 
		
		$sSql = $IsSql . " VALUES ('http://www.gopiplus.com/work/wp-content/uploads/pluginimages/250x167/250x167_1.jpg', 'http://www.gopiplus.com/work/2011/04/22/wordpress-plugin-wp-fadein-text-news/', '_blank', 'Image 1', '1', 'YES', 'widget', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		
		$sSql = $IsSql . " VALUES ('http://www.gopiplus.com/work/wp-content/uploads/pluginimages/250x167/250x167_2.jpg' ,'http://www.gopiplus.com/work/2011/04/22/wordpress-plugin-wp-fadein-text-news/', '_blank', 'Image 2', '2', 'YES', 'widget', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		
		$sSql = $IsSql . " VALUES ('http://www.gopiplus.com/work/wp-content/uploads/pluginimages/250x167/250x167_3.jpg', 'http://www.gopiplus.com/work/2011/04/25/wp-image-slideshow/', '_blank', 'Image 3', '1', 'YES', 'sample', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		
		$sSql = $IsSql . " VALUES ('http://www.gopiplus.com/work/wp-content/uploads/pluginimages/250x167/250x167_4.jpg', 'http://www.gopiplus.com/work/2010/10/10/superb-slideshow-gallery/', '_blank', 'Image 4', '2', 'YES', 'sample', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);

	}

	add_option('wpis_title', "WP image slideshow");
	add_option('wpis_width', "250");
	add_option('wpis_height', "170");
	add_option('wpis_pause', "3000");
	add_option('wpis_random', "NO");
	add_option('wpis_type', "widget");

}

function wpis_control() 
{
	echo '<p>wp image slideshow: <br><br> To change the setting goto "wp image slideshow" link under SETTING menu. ';
	echo '<a href="options-general.php?page=wp-image-slideshow/wp-image-slideshow.php">click here</a></p>';
	echo '<a target="_blank" href="http://www.gopiplus.com/work/2011/04/25/wp-image-slideshow/">Click here</a> for more help.<br>';
}

function wpis_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo get_option('wpis_Title');
	echo $after_title;
	wpis();
	echo $after_widget;
}

function wpis_admin_options() 
{
	global $wpdb;
	
	echo "<div class='wrap'>";
	echo "<h2>wp image slideshow</h2>"; 
	$wpis_title = get_option('wpis_title');
	$wpis_width = get_option('wpis_width');
	$wpis_height = get_option('wpis_height');
	$wpis_pause = get_option('wpis_pause');
	$wpis_random = get_option('wpis_random');
	$wpis_type = get_option('wpis_type');
	
	if (@$_POST['wpis_submit']) 
	{
		$wpis_title = stripslashes($_POST['wpis_title']);
		$wpis_width = stripslashes($_POST['wpis_width']);
		$wpis_height = stripslashes($_POST['wpis_height']);
		$wpis_pause = stripslashes($_POST['wpis_pause']);
		$wpis_random = stripslashes($_POST['wpis_random']);
		$wpis_type = stripslashes($_POST['wpis_type']);

		update_option('wpis_title', $wpis_title );
		update_option('wpis_width', $wpis_width );
		update_option('wpis_height', $wpis_height );
		update_option('wpis_pause', $wpis_pause );
		update_option('wpis_random', $wpis_random );
		update_option('wpis_type', $wpis_type );
	}
	
	echo '<form name="wpis_form" method="post" action="">';

	echo '<p>Title:<br><input  style="width: 450px;" maxlength="200" type="text" value="';
	echo $wpis_title . '" name="wpis_title" id="wpis_title" /> Widget title.</p>';

	echo '<p>Width:<br><input  style="width: 100px;" maxlength="200" type="text" value="';
	echo $wpis_width . '" name="wpis_width" id="wpis_width" /> Widget Width (only number).</p>';

	echo '<p>Height:<br><input  style="width: 100px;" maxlength="200" type="text" value="';
	echo $wpis_height . '" name="wpis_height" id="wpis_height" /> Widget Height (only number).</p>';

	echo '<p>Pause:<br><input  style="width: 100px;" maxlength="4" type="text" value="';
	echo $wpis_pause . '" name="wpis_pause" id="wpis_pause" /> Only Number / Pause between content change (millisec).</p>';

	echo '<p>Random :<br><input  style="width: 100px;" type="text" value="';
	echo $wpis_random . '" name="wpis_random" id="wpis_random" /> (YES/NO)</p>';

	echo '<p>Type:<br><input  style="width: 150px;" type="text" value="';
	echo $wpis_type . '" name="wpis_type" id="wpis_type" /> This field is to group the images.</p>';

	echo '<input name="wpis_submit" id="wpis_submit" class="button-primary" value="Submit" type="submit" />';

	echo '</form>';
	
	echo '</div>';
	?>
    <div style="float:right;">
	<input name="text_management1" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=wp-image-slideshow/image-management.php'" value="Go to - Image Management" type="button" />
    <input name="setting_management1" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=wp-image-slideshow/wp-image-slideshow.php'" value="Go to - Gallery Setting" type="button" />
    </div>
    <?php
	include("help.php");
}

add_filter('the_content','wpis_Show_Filter');

function wpis_Show_Filter($content)
{
	return 	preg_replace_callback('/\[WP-IMAGE-GALLERY:(.*?)\]/sim','wpis_Show_Filter_Callback',$content);
}

function wpis_Show_Filter_Callback($matches) 
{
	global $wpdb;
	
	$scode = $matches[1];
	//echo $scode;
	
	list($wpis_type_main, $wpis_width_main, $wpis_height_main, $wpis_pause_main, $wpis_random_main) = split("[:.-]", $scode);

	list($wpis_type_cap, $wpis_type) = split('[=.-]', $wpis_type_main);
	list($wpis_width_cap, $wpis_width) = split('[=.-]', $wpis_width_main);
	list($wpis_height_cap, $wpis_height) = split('[=.-]', $wpis_height_main);
	list($wpis_pause_cap, $wpis_pause) = split('[=.-]', $wpis_pause_main);
	list($wpis_random_cap, $wpis_random) = split('[=.-]', $wpis_random_main);

	if(!is_numeric(@$wpis_width)) { @$wpis_width = 250 ;}
	if(!is_numeric(@$wpis_height)) { @$wpis_height = 200; }
	if(!is_numeric(@$wpis_pause)) { @$wpis_pause = 3000; }
	
	$sSql = "select wpis_path,wpis_link,wpis_target,wpis_title from ".WP_wpis_TABLE." where 1=1";
	if($wpis_type <> ""){ $sSql = $sSql . " and wpis_type='".$wpis_type."'"; }
	if($wpis_random == "YES"){ $sSql = $sSql . " ORDER BY RAND()"; }else{ $sSql = $sSql . " ORDER BY wpis_order"; }
	
	$data = $wpdb->get_results($sSql);
	
	$wpis_count = 0;
	$wpis_returnstr  = "";
	$Lr = "";
	if ( ! empty($data) ) 
	{
		foreach ( $data as $data ) 
		{
			$wpis_str =  '["' . $data->wpis_path . '", "'. $data->wpis_link .'", "'. $data->wpis_target .'"]';
			$wpis_returnstr = $wpis_returnstr . "wpis_images[$wpis_count]=$wpis_str; ";
			$wpis_count++;
		}
	}	
	
    $Lr = $Lr .'<script type="text/javascript">';
	$Lr = $Lr .'var wpis_images=new Array();';
	$Lr = $Lr . $wpis_returnstr;
	$Lr = $Lr .'new wpis(wpis_images, '.$wpis_width.', '.$wpis_height.', '.$wpis_pause.')';
	$Lr = $Lr .'</script>';

	return $Lr;
}

function wpis_add_to_menu() 
{
	add_options_page('wp image slideshow', 'wp image slideshow', 'manage_options', __FILE__, 'wpis_admin_options' );
	add_options_page('wp image slideshow', '', 'manage_options', "wp-image-slideshow/image-management.php",'' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'wpis_add_to_menu');
}

function wpis_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('wp-image-slideshow', 'wp image slideshow', 'wpis_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('wp-image-slideshow', array('wp image slideshow', 'widgets'), 'wpis_control');
	} 
}

function wpis_deactivation() 
{

}

function wpis_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_script( 'wp-image-slideshow', get_option('siteurl').'/wp-content/plugins/wp-image-slideshow/wp-image-slideshow.js');
	}	
}

add_action('init', 'wpis_add_javascript_files');


add_action("plugins_loaded", "wpis_init");
register_activation_hook(__FILE__, 'wpis_install');
register_deactivation_hook(__FILE__, 'wpis_deactivation');
add_action('admin_menu', 'wpis_add_to_menu');


?>
