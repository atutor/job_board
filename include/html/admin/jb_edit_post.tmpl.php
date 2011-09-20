<?php
$simple = true;
if ($_POST['complexeditor'] == '1') {
	$simple = false;
}
load_editor($simple, false, "none");
?>
<div class="input-form">
	<form action="" method="post" name="form">
		<div class="row">
			<label for="jb_title"><?php echo _AT('jb_title'); ?></label>
			<input type="text" id="jb_title" name="title" value="<?php echo htmlentities_utf8($this->job_post['title']); ?>" />
		</div>		
		<div class="row">
			<label><?php echo _AT('jb_categories'); ?></label><br/>
			<?php if(!empty($this->categories)): ?>
			<?php foreach($this->categories as $category): ?>
			<div class="category_box">
				<input type="checkbox" id="jb_category_<?php echo $category['id'];?>" name="jb_categories[]" value="<?php echo $category['id']; ?>" <?php echo ($this->job_post['categories'] && in_array($category['id'], $this->job_post['categories']))?'checked="checked"':''; ?> /> 
				<label for="jb_category_<?php echo $category['id'];?>"><?php echo htmlentities_utf8($category['name']); ?></label>				
			</div>
			<?php endforeach; endif; ?>
			<div style="clear:both;"></div>
		</div>
		<div class="row">
			<label for="jb_is_public"><?php echo _AT('jb_is_public'); ?></label>
			<input type="checkbox" id="jb_is_public" name="jb_is_public" <?php echo ($this->job_post['is_public']==1)?'checked="checked"':''; ?>/>
		</div>
		<div class="row">
			<label><?php echo _AT('jb_approval_state'); ?></label>						
			<label for="jb_approval_state_<?php echo AT_JB_POSTING_STATUS_CONFIRMED; ?>"><?php echo _AT('jb_approval_state_confirmed'); ?></label>
			<input type="radio" id="jb_approval_state_<?php echo AT_JB_POSTING_STATUS_CONFIRMED; ?>" name="jb_approval_state" value="<?php echo AT_JB_POSTING_STATUS_CONFIRMED; ?>" <?php echo ($this->job_post['approval_state']==AT_JB_POSTING_STATUS_CONFIRMED)?'checked="checked"':''; ?> />
			<label for="jb_approval_state_<?php echo AT_JB_POSTING_STATUS_UNCONFIRMED; ?>"><?php echo _AT('jb_approval_state_unconfirmed'); ?></label>
			<input type="radio" id="jb_approval_state_<?php echo AT_JB_POSTING_STATUS_UNCONFIRMED; ?>" name="jb_approval_state" value="<?php echo AT_JB_POSTING_STATUS_UNCONFIRMED; ?>" <?php echo ($this->job_post['approval_state']==AT_JB_POSTING_STATUS_UNCONFIRMED)?'checked="checked"':''; ?> />			
		</div>
		<div class="row">
			<label for="jb_closing_date"><?php echo _AT('jb_closing_date'); ?></label>
			<?php
			//load mysql timestamp template into the template.
			if (intval($this->job_post['closing_date'])) {
				$today_day   = substr($this->job_post['closing_date'], 8, 2);
				$today_mon   = substr($this->job_post['closing_date'], 5, 2);
				$today_year  = substr($this->job_post['closing_date'], 0, 4);

				$today_hour  = substr($this->job_post['closing_date'], 11, 2);
				$today_min   = substr($this->job_post['closing_date'], 14, 2);
			} else {
				$today_year  = date('Y');
			}

			//load the release_date template.
			$name = '_jb_closing_date';
			require(AT_INCLUDE_PATH.'html/release_date.inc.php');
			?>
		</div>
		<div class="row">
			<span class="nowrap">
				<label for="formatting_radios"><span class="required" title="<?php echo _AT('required_field'); ?>">*</span><?php echo _AT('formatting'); ?></label>
				<span id="formatting_radios">
					<input type="radio" name="formatting" value="0" id="text" <?php if ($_POST['formatting'] == 0) { echo 'checked="checked"'; } ?> />
					<label for="text"><?php echo _AT('plain_text'); ?></label>

					<input type="radio" name="formatting" value="1" id="html" <?php if ($_POST['formatting'] == 1) { echo 'checked="checked"'; } ?> />
					<label for="html"><?php echo _AT('html'); ?></label>
			   </span>
		   </span>
		</div>
		<div class="row">
			<span class="required" title="<?php echo _AT('required_field'); ?>">*</span><label for="jb_description"><?php echo _AT('jb_post_description'); ?></label><br />
			<small>&middot; <?php echo _AT('jb_post_description_note'); ?></small><br />
			<textarea name="jb_description" cols="55" rows="15" id="jb_description"><?php echo $_POST['jb_description']; ?><?php echo $this->job_post['description']; ?></textarea>
		</div>
		<div class="row">
			<input class="button" type="submit" name="submit" value="<?php echo _AT('submit'); ?>"/>
		</div>
	</form>
</div>
