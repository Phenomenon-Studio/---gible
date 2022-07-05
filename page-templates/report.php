<?php 
/*
Template name: Report
*/
$report_post=$_GET['report'];
get_header(); ?>


<section class="single-author blog-auth report-section">
  <div class="wrap">
    <div class="top-bar">
      <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="backlink">
        <img loading="lazy" src="<?php bloginfo('template_directory'); ?>/img/arr.svg" alt="">
        Back
      </a>
    </div>
    <div class="report-form-wrap">
      <div class="section-heading">
        <?php the_title(); ?>
      </div>
      <div class="subheading">
        <?php the_content(); ?>
      </div>
      <form action="?form-action=report" class="report-form">
        <input type="hidden" name="report" value="<?php echo $report_post; ?>">
        <input type="hidden" name="url" value="<?php echo get_permalink($report_post); ?>">
        <div class="input-wrap">
          <span><?php echo get_field('report_form','options')['input_1_label']; ?></span>
          <input name="email" type="text" placeholder="<?php echo get_field('report_form','options')['input_1_placeholder']; ?>" required="" class="form-control required email">
        </div>
        <div class="input-wrap">
          <span><?php echo get_field('report_form','options')['input_2_label']; ?></span>
          <textarea name="text" placeholder="<?php echo get_field('report_form','options')['input_2_placeholder']; ?>" data-max-length="2000" class="required"></textarea>
        </div>
        <button class="main-btn send-form-btn black"><?php echo get_field('report_form','options')['button']; ?></button>
      </form>
    </div>
    <div class="succ">
      <?php getImage(get_field('report_success_popup','options')['image']); ?>
      <p><?php echo get_field('report_success_popup','options')['text']; ?></p>
      <a href="<?php echo get_field('report_success_popup','options')['button']['url']; ?>" class="main-btn active"><?php echo get_field('report_success_popup','options')['button']['title']; ?></a>
    </div>
  </div>
</section>


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
      onFormSubmit: function(container){
        send(event,container)
      }
    };
    var validator = new VanillaValidator(config);
  </script>

<?php get_footer(); ?>
