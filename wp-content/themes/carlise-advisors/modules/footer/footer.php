<section class="footer" data-module="footer">
  <container class="container">
    <div class="footer-content">
      <div class="footer__image">
        <?php
        if (setted($footer_logo)) :
          the_module('image', array('image' => $footer_logo));
        endif;
        ?>
      </div>
      <div class="contact-info">
        <div class="phone p3">
          <div class="contact-heading p1">
            <?= $footer_contact_us ?>
          </div>
          <div class="sales">
            <?= $footer_contact_sales ?>
          </div>
          <div class="support">
            <?= $footer_contact_support ?>
          </div>
        </div>
        <div class="address">
          <div class="address-heading p1">
            <?= $footer_address ?>
          </div>
          <div class="address-location p3">
            <?= $footer_address_location ?><br>
            placeholdertext jkshdkjfhjk hjksdhfjks<br>
            placeholdertext sjkdhfjk hjskdhf jkhkjsd
          </div>
        </div>
      </div>
      <div class="email p3">
        <?= $footer_contact_email ?>
      </div>
    </div>
  </container>
</section>