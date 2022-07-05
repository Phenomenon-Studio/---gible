
<div class="footer">
	<div class="footer-top">
		<div class="wrap">
			<div class="flex-row vcenter hbetween">
				<a href="/" class="logo"><?php getImage(get_field('logo_black','options')); ?></a>
				<?php wp_nav_menu( array('menu' => 'Footer menu','menu_locations'=>'footer_menu' )); ?>
				<div class="socs">
					<?php if(get_field('socs','options')): ?>
					<?php while(the_repeater_field('socs','options')): ?>
					<a href="<?php the_sub_field('link'); ?>" target="_blank">
						<?php getImage(get_sub_field('icon')); ?>
					</a>						
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="wrap">
			<div class="flex-row vcenter hbetween">
				<p><?php echo get_field('cop_text','options'); ?></p>
				<p><?php echo get_field('designed_text','options'); ?> <a href="<?php echo get_field('designed_link','options'); ?>" style="display: inline-block;"><?php getImage(get_field('designed_image','options')); ?></a></p>
			</div>
		</div>
	</div>
</div>

<div class="main-popup-wrap thanks-popup">
	<div class="popup-wrap">
		<div class="popup-closer"></div>
		<div class="popup">
			<div class="title"><?php echo get_field('homepage_success_popup','options')['title']; ?></div>
			<p><?php echo get_field('homepage_success_popup','options')['text']; ?></p>
			<div class="main-btn close-popup"><?php echo get_field('homepage_success_popup','options')['button']; ?></div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>


</body>
</html>