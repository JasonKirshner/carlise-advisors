<section class="copy-grid" data-module="copy-grid">
  <container class="container">
    <div class="services-icon">
      <?php
      if (setted($services_icon)) :
        the_module('image', array('image' => $services_icon));
      endif;
      ?>
    </div>
    <h2 class="module-name h2"><?= $services_title ?></h2>
    <div class="copy-grid-content">
      <?php
      if (setted($service)) :
        if (have_rows('service')) :
          while (have_rows('service')) : the_row();
      ?>
            <div class='content'>
              <div class='subheading h3'>
                <?= get_sub_field('service_sub_heading') ?>
              </div>
              <div class='blurb p'>
                <?= get_sub_field('service_blurb') ?>
              </div>
            </div>
      <?php
          endwhile;
        endif;
      endif;
      ?>
    </div>
  </container>
</section>