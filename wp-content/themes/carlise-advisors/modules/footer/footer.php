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
    <div class="sales">
      <li class="sales-subheading"><p><?= $footer_contact_sales ?></p></li>
      <li class="sales-number"><p><?= $footer_contact_sales_number ?></p></li>
    </div>
    <div class="support">
      <li class="support-subheading"><p><?= $footer_contact_support ?></p></li>
      <li class="support-number"><p><?= $footer_contact_support_number ?></p></li>
    </div>
    <div class="email"><p><?= $footer_contact_email ?></p></div>
    <div class="address">
      <li class="address-heading"><h3><?= $footer_address ?></h3></li>
      <li class="address-location"><p><?= $footer_address_location ?></p></li>
    </div>
  </div>
</section>

