<?php 
/*
Template name: Authors
*/
get_header();
$users_last_login = get_users([
  'number'=>1,
  'orderby'=>'ID',
  'order'=>'DESC',
]);
?>
<section class="single-author">
  <div class="wrap">
    <div class="top-bar">
      <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="backlink">
        <img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/arr.svg" alt="">
        Back
      </a>
    </div>
      <div class="authors-section">
        <div class="section-heading">
          <?php the_title(); ?>
        </div>
        <div class="subheading">Updated: <b><?= date_i18n('M j, Y H:m', strtotime($users_last_login[0]->user_registered)); ?></b></div>
        <form class="search-form" autocomplete="off">
          <input type="text" name="search" placeholder="Search" id="search-input" value="<?php echo $_GET['search']; ?>">
          <img src="<?php bloginfo('template_directory'); ?>/img/x.svg" class="clear-form" alt="">
        </form>
        <?php $users = get_users([
          'number'=>20,
          'meta_query' => array(
            'relation' => 'OR',
                array(
                    'key' => 'first_name',
                    'value' => $_GET['search'],
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'last_name',
                    'value' => $_GET['search'],
                    'compare' => 'LIKE'
                )
            )
        ]);?>
        <?php if ($users){ ?>
        <div class="authors-wrap">
          <?php foreach ($users as $user) {?>
          <a href="<?php echo get_author_posts_url($user->ID); ?>">
            <img loading="lazy" src="<?php echo get_avatar_url($user->ID,array('size'=>192)); ?>" alt="<?php echo $user->first_name.' '.$user->last_name; ?>'s avatar">
            <div class="info">
              <span><?php echo $user->first_name.' '.$user->last_name; ?></span>
              <p><?php echo $user->user_title; ?></p>
              <div class="txt">
                <?php echo truncate($user->description); ?>
              </div>
            </div>
          </a>
          <?php } ?>
        </div>
        <?php }else{ ?>
          <div class="articles-wrap empty">
            <div class="nothing" style="margin-top: 0;">
              <img src="<?php bloginfo('template_directory'); ?>/img/nothing.png" alt="">
              <div class="section-heading">
                <?php the_field('author_nothing_found_heading','options'); ?>
              </div>
              <div class="subheading"><?php the_field('author_nothing_found_text','options'); ?></div>
            </div>
          </div>
        <?php } ?>
      </div>
  </div>
</section>

<?php get_footer(); ?>
