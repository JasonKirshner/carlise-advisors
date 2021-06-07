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
      <div class='footer-wysiwyg'>
        <?php
        if (setted($footer_wysiwyg_left)) :
          echo $footer_wysiwyg_left;
        endif;
        ?>
      </div>
      <div class='footer-wysiwyg'>
        <?php
        if (setted($footer_wysiwyg_right)) :
          echo $footer_wysiwyg_right;
        endif;
        ?>
      </div>
    </div>
  </container>
</section>