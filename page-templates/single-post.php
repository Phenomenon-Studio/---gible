<?php get_header(); 
$user_id=$post->post_author;
$user = get_userdata( $user_id );
$cats = wp_get_post_categories($post->ID);
$post_id=$post->ID;
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


    <div class="single-post-wrap">
      <div class="flex-row vstart hbetween">
        <div class="content-wrap">
          <h1 class="section-heading"><?php the_title(); ?></h1>
          <div class="subheading">Published: <b><?= date_i18n('M j, Y', strtotime(get_the_date())); ?></b></div>
          <div class="tags-wrap">
            <?php $cats=wp_get_post_categories($post->ID);?>
            <?php
              foreach ($cats as $cat){
              ?>
              <a href="<?php echo get_category_link($cat); ?>" class="main-btn gray"><?php echo get_cat_name($cat)?>

              </a>
              <?php } ?>
          </div>
          <div class="post-content">
            <?php the_content(); ?>
          </div>
        </div>
        <div class="sidebar">
          <div class="author-box">
            <a href="<?php echo get_author_posts_url($user->ID); ?>">
              <img src="<?php echo get_avatar_url($user_id); ?>" alt="<?php echo $user->first_name.' '.$user->last_name; ?>'s avatar">
              <div class="info">
                <span><?php echo $user->first_name.' '.$user->last_name; ?></span>
                <p><?php echo $user->user_title; ?></p>
              </div>
            </a>
            <div class="txt">
              <?php echo $user->description; ?>
            </div>
          </div>
          <?php $news = new WP_Query(array('post_type' => 'post','cat'=>$cats,'post__not_in'=>array($post_id), 'posts_per_page' => 3)); ?>
            <?php if ( $news->have_posts() ) {?>
            <hr>
          <div class="subheading">Other Articles You May Like</div>
          <div class="posts">
            <?php while ( $news->have_posts() ) : $news->the_post(); ?>
            <?php $cats=wp_get_post_categories($post->ID);?>
            <a href="<?php the_permalink(); ?>">
              <?php echo get_the_post_thumbnail() ?>
              <span class="right">
                <span class="name"><?php the_title(); ?></span>
                <span class="subheading">
                  Published: <b><?= date_i18n('M j, Y', strtotime(get_the_date())); ?></b>
                </span>
              </span>
            </a>
            <?php endwhile; ?>
            </div>
            <?php }
            wp_reset_postdata();
            ?>

        </div>
      </div>
    </div>


  </div>
</section>

<?php get_footer(); ?>
