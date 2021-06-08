<section class="section-padding footer-cta<?= setted($class) ? " $class" : ""; ?> placeholder" data-module="footer-cta">
  <h2 class="footer-cta-name h2"><?= $footer_cta_title ?> </h2>
  <div class="footer-button"> <?php the_module('button', array(
                                'use_button_tag' => true,
                                'value' => $footer_button_title, // required
                                'link' => '#top',
                                'class' => 'footer-cta-button'
                              )); ?> </div>
</section>
