<section class="footer" data-module="footer">
  <container class="container footer-content">
    <div class="footer__image">
      <?php
      if (setted($footer_logo)) :
        the_module('image', array('image' => $footer_logo));
      endif;
      ?>
    </div>
    <div class="contact-info">
      <?php
      if (setted($footer_wysiwyg_left)) :
        the_module('wysiwyg', array('class' => 'footer-wysiwyg', 'content' => $footer_wysiwyg_left));
      endif;
      ?>
      <?php
      if (setted($footer_wysiwyg_right)) :
        the_module('wysiwyg', array('class' => 'footer-wysiwyg', 'content' => $footer_wysiwyg_right));
      endif;
      ?>
    </div>
  </container>
</section>