<!--
##############################################################################################################################
###### Project   : wp image slideshow  																					######
###### File Name : image-management.php                   																######
###### Purpose   : This page is to manage the image.  																	######
###### Created   : 26-04-2011                  																			######
###### Modified  : 26-04-2011                   																		######
###### Author    : Gopi.R (http://www.gopiplus.com/work/)                        										######
###### Link      : http://www.gopiplus.com/work/2011/05/06/wordpress-plugin-wp-image-slideshow/  						######
##############################################################################################################################
-->

<div class="wrap">
  <?php
  	global $wpdb;
    $title = __('wp image slideshow');
    $mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=wp-image-slideshow/image-management.php";
    $DID=@$_GET["DID"];
    $AC=@$_GET["AC"];
    $submittext = "Insert Message";
	if($AC <> "DEL" and trim($_POST['wpis_link']) <>"")
    {
			if($_POST['wpis_id'] == "" )
			{
					$sql = "insert into ".WP_wpis_TABLE.""
					. " set `wpis_path` = '" . mysql_real_escape_string(trim($_POST['wpis_path']))
					. "', `wpis_link` = '" . mysql_real_escape_string(trim($_POST['wpis_link']))
					. "', `wpis_target` = '" . mysql_real_escape_string(trim($_POST['wpis_target']))
					. "', `wpis_title` = '" . mysql_real_escape_string(trim($_POST['wpis_title']))
					. "', `wpis_order` = '" . mysql_real_escape_string(trim($_POST['wpis_order']))
					. "', `wpis_status` = '" . mysql_real_escape_string(trim($_POST['wpis_status']))
					. "', `wpis_type` = '" . mysql_real_escape_string(trim($_POST['wpis_type']))
					. "'";	
			}
			else
			{
					$sql = "update ".WP_wpis_TABLE.""
					. " set `wpis_path` = '" . mysql_real_escape_string(trim($_POST['wpis_path']))
					. "', `wpis_link` = '" . mysql_real_escape_string(trim($_POST['wpis_link']))
					. "', `wpis_target` = '" . mysql_real_escape_string(trim($_POST['wpis_target']))
					. "', `wpis_title` = '" . mysql_real_escape_string(trim($_POST['wpis_title']))
					. "', `wpis_order` = '" . mysql_real_escape_string(trim($_POST['wpis_order']))
					. "', `wpis_status` = '" . mysql_real_escape_string(trim($_POST['wpis_status']))
					. "', `wpis_type` = '" . mysql_real_escape_string(trim($_POST['wpis_type']))
					. "' where `wpis_id` = '" . $_POST['wpis_id'] 
					. "'";	
			}
			$wpdb->get_results($sql);
    }
    
    if($AC=="DEL" && $DID > 0)
    {
        $wpdb->get_results("delete from ".WP_wpis_TABLE." where wpis_id=".$DID);
    }
    
    if($DID<>"" and $AC <> "DEL")
    {
        $data = $wpdb->get_results("select * from ".WP_wpis_TABLE." where wpis_id=$DID limit 1");
        if ( empty($data) ) 
        {
           echo "<div id='message' class='error'><p>No data available! use below form to create!</p></div>";
           return;
        }
        $data = $data[0];
        if ( !empty($data) ) $wpis_id_x = htmlspecialchars(stripslashes($data->wpis_id)); 
		if ( !empty($data) ) $wpis_path_x = htmlspecialchars(stripslashes($data->wpis_path)); 
        if ( !empty($data) ) $wpis_link_x = htmlspecialchars(stripslashes($data->wpis_link));
		if ( !empty($data) ) $wpis_target_x = htmlspecialchars(stripslashes($data->wpis_target));
        if ( !empty($data) ) $wpis_title_x = htmlspecialchars(stripslashes($data->wpis_title));
		if ( !empty($data) ) $wpis_order_x = htmlspecialchars(stripslashes($data->wpis_order));
		if ( !empty($data) ) $wpis_status_x = htmlspecialchars(stripslashes($data->wpis_status));
		if ( !empty($data) ) $wpis_type_x = htmlspecialchars(stripslashes($data->wpis_type));
        $submittext = "Update Message";
    }
    ?>
  <h2><?php echo wp_specialchars( $title ); ?></h2>
  <script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-image-slideshow/inc/setting.js"></script>
  <form name="wpis_form" method="post" action="<?php echo $mainurl; ?>" onsubmit="return wpis_submit()"  >
    <table width="100%">
      <tr>
        <td colspan="2" align="left" valign="middle">Enter image URL:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wpis_path" type="text" id="wpis_path" value="<?php echo $wpis_path_x; ?>" size="125" /></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle">Enter target link:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wpis_link" type="text" id="wpis_link" value="<?php echo $wpis_link_x; ?>" size="125" /></td>
      </tr>
	  <tr>
        <td colspan="2" align="left" valign="middle">Enter target option:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wpis_target" type="text" id="wpis_target" value="<?php echo $wpis_target_x; ?>" size="50" /> ( _blank, _parent, _self, _new )</td>
      </tr>
	  <tr>
        <td colspan="2" align="left" valign="middle">Enter image reference:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wpis_title" type="text" id="wpis_title" value="<?php echo $wpis_title_x; ?>" size="125" /></td>
      </tr>
	  <tr>
        <td colspan="2" align="left" valign="middle">Enter gallery type (This is to group the images):</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wpis_type" type="text" id="wpis_type" value="<?php echo $wpis_type_x; ?>" size="50" /></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Display Status:</td>
        <td align="left" valign="middle">Display Order:</td>
      </tr>
      <tr>
        <td width="22%" align="left" valign="middle"><select name="wpis_status" id="wpis_status">
            <option value="">Select</option>
            <option value='YES' <?php if($wpis_status_x=='YES') { echo 'selected' ; } ?>>Yes</option>
            <option value='NO' <?php if($wpis_status_x=='NO') { echo 'selected' ; } ?>>No</option>
          </select>
        </td>
        <td width="78%" align="left" valign="middle"><input name="wpis_order" type="text" id="wpis_rder" size="10" value="<?php echo $wpis_order_x; ?>" maxlength="3" /></td>
      </tr>
      <tr>
        <td height="35" colspan="2" align="left" valign="bottom"><table width="100%">
            <tr>
              <td width="50%" align="left"><input name="publish" lang="publish" class="button-primary" value="<?php echo $submittext?>" type="submit" />
                <input name="publish" lang="publish" class="button-primary" onclick="wpis_redirect()" value="Cancel" type="button" />
              </td>
              <td width="50%" align="right">
			  <input name="text_management1" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=wp-image-slideshow/image-management.php'" value="Go to - Image Management" type="button" />
        	  <input name="setting_management1" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=wp-image-slideshow/wp-image-slideshow.php'" value="Go to - Gallery Setting" type="button" />
			  </td>
            </tr>
          </table></td>
      </tr>
      <input name="wpis_id" id="wpis_id" type="hidden" value="<?php echo $wpis_id_x; ?>">
    </table>
  </form>
  <div class="tool-box">
    <?php
	$data = $wpdb->get_results("select * from ".WP_wpis_TABLE." order by wpis_type,wpis_order");
	if ( empty($data) ) 
	{ 
		echo "<div id='message' class='error'>No data available! use below form to create!</div>";
		return;
	}
	?>
    <form name="frm_wpis_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th width="10%" align="left" scope="col">Type
              </td>
            <th width="66%" align="left" scope="col">URL
              </td>
			 <th width="5%" align="left" scope="col">Target
              </td>
            <th width="5%" align="left" scope="col">Order
              </td>
            <th width="6%" align="left" scope="col">Display
              </td>
            <th width="8%" align="left" scope="col">Action
              </td>
          </tr>
        </thead>
        <?php 
        $i = 0;
        foreach ( $data as $data ) { 
		if($data->wpis_status=='YES') { $displayisthere="True"; }
        ?>
        <tbody>
          <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
            <td align="left" valign="middle"><?php echo(stripslashes($data->wpis_type)); ?></td>
            <td align="left" valign="middle"><a target="_blank" href="<?php echo(stripslashes($data->wpis_path)); ?>"><?php echo(stripslashes($data->wpis_path)); ?></a></td>
			<td align="left" valign="middle"><?php echo(stripslashes($data->wpis_target)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->wpis_order)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->wpis_status)); ?></td>
            <td align="left" valign="middle"><a href="options-general.php?page=wp-image-slideshow/image-management.php&DID=<?php echo($data->wpis_id); ?>">Edit</a> &nbsp; <a onClick="javascript:wpis_delete('<?php echo($data->wpis_id); ?>')" href="javascript:void(0);">Delete</a> </td>
          </tr>
        </tbody>
        <?php $i = $i+1; } ?>
        <?php if($displayisthere<>"True") { ?>
        <tr>
          <td colspan="6" align="center" style="color:#FF0000" valign="middle">No message available with display status 'Yes'!' </td>
        </tr>
        <?php } ?>
      </table>
    </form>
  </div>
  <table width="100%">
    <tr>
      <td align="right"><input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=wp-image-slideshow/image-management.php'" value="Go to - Image Management" type="button" />
        <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=wp-image-slideshow/wp-image-slideshow.php'" value="Go to - Gallery Setting" type="button" />
      </td>
    </tr>
  </table>
</div>
<?php include("help.php"); ?>