<section class="footer-cta<?= setted($class) ? " $class" : ""; ?> placeholder" data-module="footer-cta">
  <h2 class = "footer-cta-name"><?= $footer_cta_title ?> </h2>
 <div class="footer-button"> <?php the_module('button', array(
    'use_button_tag' => true, // default false - optional
    'value' => $footer_button_title, // required
    'data' => 'data-attr="example"' // optional
)); ?> </div>
  <!-- <h2 class="module-name">footer-cta</h2> -->
</section>
