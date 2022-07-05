<?php 
/*
Template name: Help
*/
get_header();
$translations = pll_the_languages(array('raw'=>1));
$tags=get_terms('help_tag');
$s=str_replace('+',' ',$_GET['search']);
?>


<section class="single-author blog-auth help-section">
  <div class="wrap">
    <div class="top-bar">
      <div class="left">
        <div class="section-heading">
          <?php the_field('heading'); ?>
        </div>
        <div class="subheading"><?php the_field('subheading'); ?></div>
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
          <a href="<?php echo get_permalink($post->ID); ?>" class="main-btn gray <?php if (!$_GET['tg']){echo 'active';} ?>">All</a>
          <?php
            foreach ($tags as $tag){
          ?>
          <a href="?tg=<?php echo get_term( $tag )->slug;?>" class="main-btn gray <?php if ($_GET['tg']==get_term( $tag )->slug){ echo 'active'; } ?>"><?php echo get_term( $tag )->name?></a>
          <?php } ?>
        </div>
        <?php
        $args = [
          'taxonomy'      => [ 'help_category' ],
          'orderby'       => 'id',
          'order'         => 'ASC',
          'hide_empty'    => true,
          'number'        => '',
          'name__like'    => $s,
          'search'        => $s,
        ];

        $terms = get_terms( $args );
        $old_terms=$terms;
        if (!$terms){
          $args = [
            'taxonomy'      => [ 'help_category' ],
            'orderby'       => 'id',
            'order'         => 'ASC',
            'hide_empty'    => true,
            'number'        => '',
          ];

          $terms = get_terms( $args );
        }
        $err=1;
        $term_array=[];
        foreach ($terms as $term){
          if ($_GET['search']){
            $qa=array('post_type' => 'help', 'posts_per_page' => 3,'s'=>$s,'help_category'=>$term->slug);
          }else{
            $qa=array('post_type' => 'help', 'posts_per_page' => 3,'help_tag'=>$_GET['tg'],'help_category'=>$term->slug);
          }
          $news = new WP_Query($qa);
          if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post();
          $err=0;
          $term_array[$term->term_id]=$term->term_id;
          endwhile;
          endif;
          wp_reset_postdata();

        }
        if ($err==1){
          $terms=$old_terms;
        }
        if ($terms && $err==0){
        ?>

        <div class="help-wrap">
          <?php foreach ($terms as $term){
          if (in_array($term->term_id,$term_array)){?>
          <div class="col">
            <div class="top">
              <?php getImage(get_field('image','help_category_'.$term->term_id)); ?>
              <a href="<?php echo get_term_link($term->term_id); ?>" class="title">
                <?php echo $term->name; ?>
              </a>
            </div>
            <div class="txt">
              <?php $news = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 3,'help_category'=>$term->slug,'help_tag'=>$_GET['tg'])); ?>
                <?php if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?>
                  <a class="<?php if ($this_post_id==$post->ID && is_single()){echo 'active';} ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php endwhile; ?>
                <?php endif;
                wp_reset_postdata();
                ?>
            </div>
            <?php if ($news->found_posts>3){ ?>
              <a href="<?php echo get_term_link($term->term_id); ?>" class="main-btn gold">View all</a>
            <?php } ?>
          </div>
          <?php }
        } ?>
        </div>
        <?php }else{ ?>
        <div class="help-wrap empty">
          <div class="nothing">
            <img src="<?php bloginfo('template_directory'); ?>/img/nothing.png" alt="">
            <div class="section-heading">
              <?php the_field('article_nothing_found_heading','options'); ?>
            </div>
            <div class="subheading"><?php the_field('article_nothing_found_text','options'); ?></div>
          </div>
        </div>
        <?php } ?>
      </div>
  </div>
</section>

<?php get_footer(); ?>
