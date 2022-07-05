<?php  
/*
Template name: Home
*/
get_template_part('header-home');
?>

<div class="screen1">
  <div class="wrap">
    <div class="flex-row vcenter hbetween">
      <div class="left">
        <h1><?php the_field('heading_1'); ?></h1>
        <h3><?php the_field('subheading_1'); ?></h3>
        <p><?php the_field('text'); ?></p>
        <?php getLink(get_field('button_1'),'main-btn') ?>
      </div>
      <div class="right">
        <?php if (get_field('decor_1')){
          getImage(get_field('image_1'));
        }else{ ?>
        <video loop src="<?php echo get_field('video_1')['other'] ?>" playsinline muted autoplay></video>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<div class="screen2" id="products">
  <div class="wrap">
    <div class="section-heading">
      <?php the_field('heading_2'); ?>
    </div>
    <div class="section-subheading">
      <?php the_field('subheading_2'); ?>
    </div>
    <div class="flex-row">
      <?php if(get_field('products')): ?>
      <?php while(the_repeater_field('products')): ?>
      <div class="block">
        <div class="img-wrap">
          <?php getImage(get_sub_field('img')); ?>
        </div>
        <div class="heading">
          <?php the_sub_field('title'); ?>
        </div>
        <p><?php the_sub_field('text'); ?></p>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</div>

<div class="screen3" id="trust">
  <div class="wrap">
    <div class="block-wrap">
      <div class="block">
        <div class="section-heading">
          <?php the_field('heading_3'); ?>
        </div>
        <div class="block-row">
          <?php if(get_field('columns')): ?>
          <?php while(the_repeater_field('columns')): ?>
          <div class="col">
            <div class="img-wrap">
              <?php getImage(get_sub_field('icon')); ?>
            </div>
            <div class="heading"><?php the_sub_field('title'); ?></div>
            <p><?php the_sub_field('text'); ?></p>
          </div>
          <?php endwhile; ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="screen4" id="about">
  <div class="decor1"></div>
  <div class="decor2"></div>
  <div class="wrap">
    <div class="section-heading">
      <?php the_field('heading_4'); ?>
    </div>
    <div class="section-subheading">
      <?php the_field('subheading_4'); ?>
    </div>
    <div class="cols">
      <?php if(get_field('columns_2')): ?>
      <?php while(the_repeater_field('columns_2')): ?>
      <div class="col">
        <div class="img-wrap">
          <?php getImage(get_sub_field('icon')); ?>
        </div>
        <div class="heading"><?php the_sub_field('title'); ?></div>
        <?php the_sub_field('text'); ?>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="screen5">
  <div class="wrap">
    <div class="content-wrap text-center">
      <div class="section-heading">
        <?php the_field('heading_5'); ?>
      </div>
      <div class="subheading"><?php the_field('subheading_5'); ?></div>
      <?php getLink(get_field('button_5'),'main-btn white'); ?>
    </div>
  </div>
</div>

<div class="screen6" id="blog">
  <div class="wrap">
    <div class="section-heading">
      <?php the_field('heading_6'); ?>
    </div>
    <div class="subheading"><?php the_field('subheading_6'); ?></div>

    <div class="news-wrap">
      <?php $news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3)); ?>
        <?php if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?>
        <?php $cats=wp_get_post_categories($post->ID);?>
        <div class="new">
        <div class="tags-wrap">
          <?php
          foreach ($cats as $cat){
          ?>
          <a href="<?php echo get_category_link($cat); ?>" class="main-btn small white"><?php echo get_cat_name($cat)?>

          </a>
          <?php } ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="image-wrap">
          <?php echo get_the_post_thumbnail() ?>
        </a>
        <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
        <div class="info">Published: <?= date_i18n('M j, Y', strtotime(get_the_date())); ?> / By <?php echo get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name' ); ?></div>
        <p><?php the_truncated_post( 150 ); ?></p>
      </div>
        <?php endwhile; ?>
        <?php endif;
        wp_reset_postdata();
        ?>
    </div>

    <div class="text-center">
      <?php getLink(get_field('button_6'),'main-btn'); ?>
    </div>
  </div>
</div>

<div class="screen7" id="contact_us">
  <div class="wrap">
    <div class="section-heading">
      <?php echo get_field('home_page_form','options')['title']; ?>
    </div>
    <div class="form-wrap">
      <form action="/?form-action=main">
        <div class="input-wrap">
          <label for="inp1"><?php echo get_field('home_page_form','options')['input_1_label']; ?></label>
          <input id="inp1" type="text" name="first-name" placeholder="<?php echo get_field('home_page_form','options')['input_1_placeholder']; ?>" class="form-control required first_name max-length" data-max-length="30">
        </div>
        <div class="input-wrap">
          <label for="inp2"><?php echo get_field('home_page_form','options')['input_2_label']; ?></label>
          <input id="inp2" type="text" name="last-name" placeholder="<?php echo get_field('home_page_form','options')['input_2_placeholder']; ?>" class="form-control required last_name max-length" data-max-length="30">
        </div>
        <div class="input-wrap">
          <label for="inp3"><?php echo get_field('home_page_form','options')['input_3_label']; ?></label>
          <input id="inp3" type="text" name="email" placeholder="<?php echo get_field('home_page_form','options')['input_3_placeholder']; ?>" class="form-control required email">
        </div>
        <button class="main-btn white"><?php echo get_field('home_page_form','options')['button']; ?></button>
      </form>
    </div>
  </div>
</div>
<script src="<?php bloginfo('template_directory'); ?>/js/validation.js"></script>
<script>
    var config = {
      selectors: {
        error: 'is-invalid',
        messageError: 'invalid-feedback'
      },
      messages: {
        required: 'This field cannot be empty',
        email: 'Incorrect email address',
        maxLength: 'Maximum number of characters - 2000',
      },
      callbacks: {
          eachFieldSuccess: function(element){
            element.parentNode.classList.remove("err");
          },
          eachFieldError: function(element){
            element.parentNode.classList.add("err");
          },
        },
      onFormSubmit: function(container){
        send2(event,container)
      }
    };
    var validator = new VanillaValidator(config);
  </script>
<?php get_template_part('footer-home'); ?>
