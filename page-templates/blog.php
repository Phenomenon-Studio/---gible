<?php 
/*
Template name: Blog
*/
get_header(); 
if (is_archive()){
	$term=get_queried_object();
}
?>

<section>
	<div class="wrap">
		<div class="section-heading">
			<?php if (!is_archive()){
				the_field('heading'); 
			}else{
				echo $term->name;
			}?>
		</div>
		<div class="subheading">
			<?php if (!is_archive()){
				the_field('subheading'); 
			}else{
				echo $term->description;
			}?>
		</div>
		<div class="articles-wrap">
			<?php $news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2)); ?>
    		<?php if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?>
    		<?php $cats=wp_get_post_categories($post->ID);?>
			<div class="article">
				<a href="<?php the_permalink(); ?>" class="left">
					<?php echo get_the_post_thumbnail() ?>
				</a>
				<div class="right">
					<a href="<?php the_permalink(); ?>" class="name"><?php the_title(); ?></a>
					<div class="details">Published: <?= date_i18n('M j, Y', strtotime(get_the_date())); ?> / By <?php echo get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name' ); ?></div>
					<div class="tags-wrap">
						<?php  
					foreach ($cats as $cat){
					?>
					<a href="<?php echo get_category_link($cat); ?>" class="main-btn small gray"><?php echo get_cat_name($cat)?>
						
					</a>
					<?php } ?>
					</div>
					<p><?php the_truncated_post( 150 ); ?></p>
				</div>
			</div>
    		<?php endwhile; ?>
    		<?php endif; 
    		wp_reset_postdata();
    		?>
		</div>
	</div>
</section>

<section class="blog-auth">
	<div class="wrap">
		<div class="flex-row">
			<div class="autors-wrap">
				<div class="heading-wrap">
					<div class="left">
						<div class="section-heading">
							Authors
						</div>
						<div class="subheading">
							Total creators: 
							<b><?php echo $users_count = count( get_users( array( 'fields' => array( 'ID' )) ) );?></b>
						</div>
					</div>
					<a href="<?php echo get_permalink(159); ?>" class="main-btn gold" style="text-transform: none;">View all</a>
				</div>
				<div class="autors-list">
					<?php $users = get_users([
						'number'=>20
					]);
					foreach ($users as $user) {?>
					<a href="<?php echo get_author_posts_url($user->ID); ?>">
						<img loading="lazy" src="<?php echo get_avatar_url($user->ID); ?>" alt="<?php echo $user->first_name.' '.$user->last_name; ?>'s avatar">
						<div class="info">
							<span><?php echo $user->first_name.' '.$user->last_name; ?></span>
							<p><?php echo $user->user_title; ?></p>
						</div>
					</a>   
					<?php } ?>
				</div>
			</div>

			<div class="article-section" id="results">
				<div class="section-heading">
					All articles
				</div>
				<div class="subheading">Total artworks <b><?php echo wp_count_posts()->publish; ?></b></div>
				<form class="search-form">
					<input type="text" name="search" placeholder="Search" id="search-input" autocomplete="off" value="<?php echo $_GET['search']; ?>">
					<img src="<?php bloginfo('template_directory'); ?>/img/x.svg" class="clear-form" alt="">
				</form>
				<div class="tags-wrap">
					<?php $cats=get_categories();?>
					<a href="<?php echo get_permalink(146); ?>#results" class="main-btn gray <?php if (!$term){echo 'active';} ?>">All</a>
					<?php  
					foreach ($cats as $cat){
					?>
					<a href="<?php echo get_category_link($cat); ?>#results" class="main-btn small gray <?php if ($term->slug==$cat->slug){echo 'active';} ?>"><?php echo $cat->name;?></a>
					<?php } ?>
				</div>
					<?php $news = new WP_Query(array('post_type' => 'post','cat'=>$term->term_id, 'posts_per_page' => 12,'s'=>$_GET['search'],'paged'=>get_query_var('paged') ?: 1)); ?>
		    		<?php if ( $news->have_posts() ) {?> 
		    		<div class="articles-wrap">	
		    		<?php while ( $news->have_posts() ) : $news->the_post(); ?>
		    		<?php $cats=wp_get_post_categories($post->ID);?>
					<div class="article">
						<a href="<?php the_permalink(); ?>" class="left">
							<?php echo get_the_post_thumbnail() ?>
						</a>
						<div class="right">
							<a href="<?php the_permalink(); ?>" class="name"><?php the_title(); ?></a>
							<div class="details">Published: <?= date_i18n('M j, Y', strtotime(get_the_date())); ?> / By <?php echo get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name' ); ?></div>
							<p><?php the_truncated_post( 150 ); ?></p>
							<div class="tags-wrap">
							<?php  
							foreach ($cats as $cat){
							?>
							<a href="<?php echo get_category_link($cat); ?>" class="main-btn small gray"><?php echo get_cat_name($cat)?>
								
							</a>
							<?php } ?>
							</div>
						</div>
					</div>
		    		<?php endwhile; ?>
		    		</div>
		    		<?php 
						$big = 999999999;
						 echo paginate_links( array(
						    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						    'format' => '?paged=%#%',
						    'current' => max( 1, get_query_var('paged') ),
						    'prev_text'    => __('&lsaquo;'),
							'next_text'    => __('&#155;'),
						    'total' => $news->max_num_pages,
						    'type'=>'list'
						) );
					?>
		    		<?php }else{?>
		    		<div class="articles-wrap empty">
						<div class="nothing">
							<img src="<?php bloginfo('template_directory'); ?>/img/nothing.png" alt="">
							<div class="section-heading">
								<?php the_field('article_nothing_found_heading','options'); ?>
							</div>
							<div class="subheading"><?php the_field('article_nothing_found_text','options'); ?></div>
						</div>
					</div>
		    		<?php } 
		    			wp_reset_postdata();
		    		?>
			</div>
			
		</div>
	</div>
</section>

<?php get_footer(); ?>