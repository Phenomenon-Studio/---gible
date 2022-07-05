<?php 

$hash=$_SERVER["REQUEST_URI"];
if (is_single()){
	$tax=get_the_terms($post->ID,'help_category');
}else{
	$tax[0]=get_queried_object();
}
$tags=get_terms('help_tag');
$this_post_id=$post->ID;
$translations = pll_the_languages(array('raw'=>1));
get_header(); 
?>


<section class="single-author blog-auth help-section">
	<div class="wrap">
		<div class="top-bar">
			<div class="left">
				<div class="section-heading">
					<?php echo $tax[0]->name; ?>
				</div>
				<div class="subheading"><?php echo $tax[0]->description; ?></div>
			</div>
			<div class="right">
				<div class="btn-wrap" id="lang-wrap">
					<button class="main-btn gray get-langs">Language: <b><?php echo pll_current_language('name'); ?></b><img src="<?php bloginfo('template_directory'); ?>/img/down.svg" alt=""></button>
					<div class="dropdown">
						<?php foreach ($translations as $key=>$lng){ if (!$lng['no_translation']){?>
							<a href="<?php echo $lng['url']; ?>"><?php echo $lng['name']; ?></a>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
		

			<div class="article-section">
				<form class="search-form" autocomplete="off">
					<input type="text" name="search" placeholder="Search" id="search-input" value="<?php echo $_GET['search']; ?>">
					<img src="<?php bloginfo('template_directory'); ?>/img/x.svg" class="clear-form" alt="">
				</form>
				<div class="tags-wrap">
					<a href="<?php echo get_term_link($tax[0]->term_id); ?>" class="main-btn gray <?php if (!$_GET['tg']){echo 'active';} ?>">All</a>
					<?php  
						foreach ($tags as $tag){
					?>
					<a href="?tg=<?php echo get_term( $tag )->slug;?>" class="main-btn gray <?php if ($_GET['tg']==get_term( $tag )->slug){ echo 'active'; } ?>"><?php echo get_term( $tag )->name?></a>
					<?php } ?>
				</div>

				<div class="single-help-wrap">
					<div class="left">
						<?php  
						$args = [
							'taxonomy'      => [ 'help_category' ],
							'orderby'       => 'id',
							'order'         => 'ASC',
							'hide_empty'    => true,
							'number'        => '',
							'name__like'    => '',
							'search'        => '',
						];

						$terms = get_terms( $args );
						if ($terms){
						?>
						<?php foreach ($terms as $term){?>
							<div class="accordion">
								<a href="<?php echo get_term_link($term->term_id); ?>" class="title <?php if ($tax[0]->slug==$term->slug){ echo 'active'; }?>">
									<?php echo $term->name; ?>
								</a>
								<?php if ($tax[0]->slug==$term->slug){ ?>
								<div class="list">
									<ul>
										<?php $news = new WP_Query(array('post_type' => 'help', 'posts_per_page' => -1,'help_category'=>$term->slug,'help_tag'=>$_GET['tg'],'s'=>$_GET['search'])); ?>
										    <?php if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?>
										    	<li><a class="<?php if ($this_post_id==$post->ID && is_single()){echo 'active';} ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										    <?php endwhile; ?>
										    <?php endif; 
										    wp_reset_postdata();
										    ?>
									</ul>
								</div>
								<?php } ?>
							</div>
						<?php } }?>
						
					</div>

					<div class="right">
						<?php if (is_single()){ ?>
						<div class="tab1 post-content tabs" style="display: block;">
							<div class="section-heading">
								<?php the_title(); ?>
							</div>
							<?php the_content(); ?>
						</div>
						<?php } ?>
					<?php if (is_single()){ ?>
						<div class="section-heading">
							Can’t find what you’re looking for?
						</div>
						<a href="<?php echo get_permalink(157); ?>" class="main-btn active medium">Contact us</a>
					<?php } ?>
					</div>
				</div>
			</div>
	</div>
</section>

<?php include('footer.php'); ?>