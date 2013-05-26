<div class="wrap">
<?php
$wpis_errors = array();
$wpis_success = '';
$wpis_error_found = FALSE;

// Preset the form fields
$form = array(
	'wpis_path' => '',
	'wpis_link' => '',
	'wpis_target' => '',
	'wpis_title' => '',
	'wpis_order' => '',
	'wpis_status' => '',
	'wpis_type' => ''
);

// Form submitted, check the data
if (isset($_POST['wpis_form_submit']) && $_POST['wpis_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('wpis_form_add');
	
	$form['wpis_path'] = isset($_POST['wpis_path']) ? $_POST['wpis_path'] : '';
	if ($form['wpis_path'] == '')
	{
		$wpis_errors[] = __('Please enter the image path.', WP_wpis_UNIQUE_NAME);
		$wpis_error_found = TRUE;
	}

	$form['wpis_link'] = isset($_POST['wpis_link']) ? $_POST['wpis_link'] : '';
	if ($form['wpis_link'] == '')
	{
		$wpis_errors[] = __('Please enter the target link.', WP_wpis_UNIQUE_NAME);
		$wpis_error_found = TRUE;
	}
	
	$form['wpis_target'] = isset($_POST['wpis_target']) ? $_POST['wpis_target'] : '';
	$form['wpis_title'] = isset($_POST['wpis_title']) ? $_POST['wpis_title'] : '';
	$form['wpis_order'] = isset($_POST['wpis_order']) ? $_POST['wpis_order'] : '';
	$form['wpis_status'] = isset($_POST['wpis_status']) ? $_POST['wpis_status'] : '';
	$form['wpis_type'] = isset($_POST['wpis_type']) ? $_POST['wpis_type'] : '';

	//	No errors found, we can add this Group to the table
	if ($wpis_error_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".WP_wpis_TABLE."`
			(`wpis_path`, `wpis_link`, `wpis_target`, `wpis_title`, `wpis_order`, `wpis_status`, `wpis_type`)
			VALUES(%s, %s, %s, %s, %d, %s, %s)",
			array($form['wpis_path'], $form['wpis_link'], $form['wpis_target'], $form['wpis_title'], $form['wpis_order'], $form['wpis_status'], $form['wpis_type'])
		);
		$wpdb->query($sql);
		
		$wpis_success = __('New image details was successfully added.', WP_wpis_UNIQUE_NAME);
		
		// Reset the form fields
		$form = array(
			'wpis_path' => '',
			'wpis_link' => '',
			'wpis_target' => '',
			'wpis_title' => '',
			'wpis_order' => '',
			'wpis_status' => '',
			'wpis_type' => ''
		);
	}
}

if ($wpis_error_found == TRUE && isset($wpis_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $wpis_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($ltw_tes_error_found == FALSE && strlen($wpis_success) > 0)
{
	?>
	  <div class="updated fade">
		<p><strong><?php echo $wpis_success; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=wp-image-slideshow">Click here</a> to view the details</strong></p>
	  </div>
	  <?php
	}
?>
<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-image-slideshow/pages/setting.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php echo WP_wpis_TITLE; ?></h2>
	<form name="wpis_form" method="post" action="#" onsubmit="return wpis_submit()"  >
      <h3>Add new image details</h3>
      <label for="tag-image">Enter image path</label>
      <input name="wpis_path" type="text" id="wpis_path" value="" size="125" />
      <p>Where is the picture located on the internet</p>
      <label for="tag-link">Enter target link</label>
      <input name="wpis_link" type="text" id="wpis_link" value="" size="125" />
      <p>When someone clicks on the picture, where do you want to send them</p>
      <label for="tag-target">Enter target option</label>
      <select name="wpis_target" id="wpis_target">
        <option value='_blank'>_blank</option>
        <option value='_parent'>_parent</option>
        <option value='_self'>_self</option>
        <option value='_new'>_new</option>
      </select>
      <p>Do you want to open link in new window?</p>
      <label for="tag-title">Enter image reference</label>
      <input name="wpis_title" type="text" id="wpis_title" value="" size="125" />
      <p>Enter image reference. This is only for reference.</p>
      <label for="tag-select-gallery-group">Select gallery type</label>
      <select name="wpis_type" id="wpis_type">
        <option value='GROUP1'>Group1</option>
        <option value='GROUP2'>Group2</option>
        <option value='GROUP3'>Group3</option>
        <option value='GROUP4'>Group4</option>
        <option value='GROUP5'>Group5</option>
        <option value='GROUP6'>Group6</option>
        <option value='GROUP7'>Group7</option>
        <option value='GROUP8'>Group8</option>
        <option value='GROUP9'>Group9</option>
        <option value='GROUP0'>Group0</option>
		<option value='Widget'>Widget</option>
		<option value='Sample'>Sample</option>
      </select>
      <p>This is to group the images. Select your slideshow group. </p>
      <label for="tag-display-status">Display status</label>
      <select name="wpis_status" id="wpis_status">
        <option value='YES'>Yes</option>
        <option value='NO'>No</option>
      </select>
      <p>Do you want the picture to show in your galler?</p>
      <label for="tag-display-order">Display order</label>
      <input name="wpis_order" type="text" id="wpis_order" size="10" value="" maxlength="3" />
      <p>What order should the picture be played in. should it come 1st, 2nd, 3rd, etc.</p>
      <input name="wpis_id" id="wpis_id" type="hidden" value="">
      <input type="hidden" name="wpis_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button-primary" value="Insert Details" type="submit" />
        <input name="publish" lang="publish" class="button-primary" onclick="wpis_redirect()" value="Cancel" type="button" />
        <input name="Help" lang="publish" class="button-primary" onclick="wpis_help()" value="Help" type="button" />
      </p>
	  <?php wp_nonce_field('wpis_form_add'); ?>
    </form>
</div>
<p class="description"><?php echo WP_wpis_LINK; ?></p>
</div>