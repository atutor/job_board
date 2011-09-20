<div class="jb_view_container">
	<h4><?php echo $this->job_post['title'];?></h4>
	
	<?php 
		include(AT_JB_INCLUDE.'jb_add_to_cart.inc.php');
	?>

	<div>
		<label><?php echo _AT('categories'); ?></label>
		<?php if(is_array($this->job_post['categories'])):
				        $category_str = '';
						foreach($this->job_post['categories'] as $category){
						    $category_str .= $this->job_obj->getCategoryNameById($category).', ';
                        }
                        $category_str = substr($category_str, 0, -2);
				?>
				<span><?php echo $category_str;?></span>
		<?php else: ?>
		<span><?php echo $this->job_obj->getCategoryNameById($this->job_post['categories']);?></span>
		<?php endif; ?>
	</div>

	<div>
		<label><?php echo _AT('company'); ?></label>
		<span><?php echo $this->job_post['company']; ?></span>
	</div>

	<div>
		<label><?php echo _AT('jb_closing_date'); ?></label>
		<span><?php echo $this->job_post['closing_date']; ?></span>
	</div>

	<div>
		<label><?php echo _AT('jb_post_description'); ?></label>
		<p><?php echo $this->job_post['description']; ?></p>
	</div>

</div>
