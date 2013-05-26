<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php echo WP_wpis_TITLE; ?></h2>
	<h3>Widget setting</h3>
    <?php
	$wpis_title = get_option('wpis_title');
	$wpis_width = get_option('wpis_width');
	$wpis_height = get_option('wpis_height');
	$wpis_pause = get_option('wpis_pause');
	$wpis_random = get_option('wpis_random');
	$wpis_type = get_option('wpis_type');
	
	if (@$_POST['wpis_submit']) 
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('wpis_form_setting');
			
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
		
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-image-slideshow/pages/setting.js"></script>
    <form name="wpis_form" method="post" action="">
      <label for="tag-title">Enter widget title</label>
      <input name="wpis_title" id="wpis_title" type="text" value="<?php echo $wpis_title; ?>" maxlength="200" size="80" />
      <p>Enter Widget title, Only for widget.</p>
      <label for="tag-width">Enter width</label>
      <input name="wpis_width" id="wpis_width" type="text" value="<?php echo $wpis_width; ?>" maxlength="4" />
      <p>Enter widget width, only number.</p>
      <label for="tag-height">Enter height</label>
      <input name="wpis_height" id="wpis_height" type="text" value="<?php echo $wpis_height; ?>" maxlength="4" />
      <p>Enter widget height, only number.</p>
      <label for="tag-title">Enter pause duration</label>
      <input name="wpis_pause" id="wpis_pause" type="text" value="<?php echo $wpis_pause; ?>" maxlength="4" />
      <p>Only Number / Pause between content change (millisec).</p>
      <label for="tag-height">Random display option</label>
      <input name="wpis_random" id="wpis_random" type="text" value="<?php echo $wpis_random; ?>" maxlength="4" />
      <p>Enter YES or NO</p>
      <label for="tag-height">Enter gallery type (This option available in add image form)</label>
      <input name="wpis_type" id="wpis_type" type="text" value="<?php echo $wpis_type; ?>" maxlength="50" />
      <p>This field is to group the images. Enter your group name to fetch the images for widget.</p>
      <input name="wpis_submit" id="wpis_submit" class="button-primary" value="Submit" type="submit" />
	  <input name="publish" lang="publish" class="button-primary" onclick="wpis_redirect()" value="Cancel" type="button" />
        <input name="Help" lang="publish" class="button-primary" onclick="wpis_help()" value="Help" type="button" />
	  <?php wp_nonce_field('wpis_form_setting'); ?>
    </form>
  </div>
  <br /><p class="description"><?php echo WP_wpis_LINK; ?></p>
</div>
