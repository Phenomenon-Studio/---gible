<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <title><?php wp_title( '|', true, 'right' ); ?></title>
</head>
<body>

<div class="header">
  <div class="wrap">
    <div class="flex-row hbetween vcenter">
      <a href="/" class="logo">
        <img src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>" alt="">
      </a>
      <div class="main-menu-wrap">
        <?php wp_nav_menu( array('menu' => 'Main menu','menu_locations'=>'main_menu' )); ?>
      </div>
      <?php getLink(get_field('header_button','options'),'main-btn bordered');?>
      <div class="gam" id="gam"><span></span></div>
    </div>
  </div>
</div>
