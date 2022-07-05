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
		<a href="/" class="logo"><?php getImage(get_field('logo_black','options')); ?></a>
	</div>
</div>