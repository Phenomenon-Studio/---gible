<div class="footer">
  <div class="wrap">
    <div class="flex-row vcenter hbetween">
      <?php wp_nav_menu( array('menu' => 'Secondary footer menu','menu_locations'=>'secondary_footer_menu','container'=>'' )); ?>
      <ul>
        <li><?php getLink(get_field('bot_link','options')); ?></li>
      </ul>
    </div>
  </div>
</div>
<div class="chat-btn">
  <img src="<?php bloginfo('template_directory'); ?>/img/chat.svg" alt="">
</div>
<?php wp_footer(); ?>
</body>
</html>
