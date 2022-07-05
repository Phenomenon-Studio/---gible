<?php get_header(); 
$user=get_queried_object();
?>


<section class="single-author blog-auth">
	<div class="wrap">
		<div class="top-bar">
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="backlink">
				<img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/arr.svg" alt="">
				Back
			</a>
			<div class="right">
				<div class="btn-wrap" id="report-wrap">
					<button class="main-btn gray get-share"><img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/share.svg" alt=""> Share</button>
					<div class="dropdown">
						<a target="_blank" href="https://twitter.com/intent/tweet?url=<?=get_permalink();?>"><img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/twitter.svg" alt=""> Tweet</a>
						<p id="copy" data-link="<?=get_permalink();?>"><img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/copy.svg" alt=""> Copy link</p>
					</div>
				</div>
				<a href="<?php echo get_permalink(155); ?>?report=<?=$post->ID?>" class="main-btn gray"><img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/report.svg" alt=""> Report</a>
			</div>
		</div>

		<div class="single-author-wrap">
			<div class="img-wrap">
				<img src="<?php echo get_avatar_url($user->ID,array('size'=>192)); ?>" alt="<?php echo $user->first_name.' '.$user->last_name; ?>'s avatar">
			</div>
			<div class="right">
				<div class="name">
					<?php echo $user->first_name.' '.$user->last_name; ?>
				</div>
				<div class="title">
					<?php echo $user->user_title; ?>
				</div>
				<span>About Creator</span>
				<div class="bio">
					<p><?=$user->description?></p>
				</div>
			</div>
		</div>
		

			<div class="article-section" id="results">
				<div class="section-heading">
					Author articles
				</div>
				<div class="subheading">Updated <b> <?= date_i18n('M j, Y H:m', strtotime($user->user_registered)); ?></b></div>
				<form class="search-form">
					<input type="text" name="search" placeholder="Search" id="search-input" autocomplete="off" value="<?php echo $_GET['search']; ?>">
					<img src="<?php bloginfo('template_directory'); ?>/img/x.svg" class="clear-form" alt="">
					<!--<div class="drop-results">
						<p class="deleted">
							<span>Create NFT</span>
							<b>Deleted</b>
						</p>
						<p>
							<span>How To Buy</span>
						</p>
						<p>
							<span>How To Buy</span>
						</p>
					</div>-->
				</form>
				<div class="tags-wrap">
				<?php
				$cats_arr=array();
				$news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1,'author_in'=>array($user->ID),'s'=>$_GET['search'])); ?>
				<?php if ( $news->have_posts() ) {
				while ( $news->have_posts() ) : $news->the_post();
					$cats=wp_get_post_categories($post->ID);
					foreach ($cats as $cat){
						//$cats_arr[get_category_link($cat)]=get_cat_name($cat);
						$cats_arr['?tg='.$cat]=get_cat_name($cat);
					}
				endwhile; 
				}
	    		wp_reset_postdata();
	    		?>

					<a href="<?php echo get_author_posts_url($user->ID); ?>#results" class="main-btn gray <?php if (!$_GET['tg']){echo 'active';} ?>">All</a>
					<?php  
					foreach ($cats_arr as $key=>$cat){
					?>
					<a href="<?php echo $key; ?>#results" class="main-btn gray <?php if (get_cat_name($_GET['tg'])==$cat){echo 'active';} ?>"><?php echo $cat;?></a>
					<?php } ?>
				</div>
				<?php $news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1,'cat'=>$_GET['tg'],'author_in'=>array($user->ID),'s'=>$_GET['search'],'paged'=>get_query_var('paged') ?: 1)); ?>
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
							<a href="<?php echo get_category_link($cat); ?>" class="main-btn small gray"><?php echo get_cat_name($cat)?></a>
							<?php } ?>
						</div>
					</div>
				</div>
	    		<?php endwhile; ?>
	    		</div>
	    		<?php //the_posts_pagination(); 
						$big = 999999999; // need an unlikely integer
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
	    		<?php } else{?>
	    			<div class="articles-wrap empty">
						<div class="nothing">
							<img src="<?php bloginfo('template_directory'); ?>/img/nothing.png" alt="">
							<div class="section-heading">
								Sorry Nothing Found 
							</div>
							<div class="subheading">But you here is a selection of articles you may find interesting</div>
						</div>
					</div>
	    		<? }
	    		wp_reset_postdata();
	    		?>
			</div>
			
		
	</div>
</section>

<?php include('footer.php'); ?>