<section class="footer" data-module="footer">
  <div class="footer__image">
    <?php 
      if(setted($footer_logo)):
        the_module('image', array('image' => $footer_logo));
      endif;
    ?>
  </div>
  <div class="contact-info">
    <div class="contact-heading"><h3><?= $footer_contact_us ?></h3></div>
    <div class="address-heading"><h3><?= $footer_address ?></h3></div>
    <div class="phone">
      <div class="sales"><p><?= $footer_contact_sales ?></p></div>
      <div class="support"><p><?= $footer_contact_support ?></p></div>
    </div>
    <div class="address"><p><?= $footer_address_location ?></p></div>
    <div class="email"><p><?= $footer_contact_email ?></p></div>
  </div>
</section>
