<section class="navigation z9" data-module="navigation">
  <div class="navigation__container z9">
    <div class="header_logo">
      <?php
      if (setted($header_logo)) :
        the_module('image', array('image' => $header_logo, 'class' => 'image--relative'));
      endif;
      ?>
    </div>
    <nav class='links'>
      <?php $field = get_field_object('nav_links');
      while (have_rows('nav_links')) : the_row();
      $value = get_sub_field('section');
      $label = $field['sub_fields'][0]['choices'][$value];
      ?>
      <button class="link" value=".<?= $value ?>"><?= $label ?></button>
      <?php endwhile?>
    </nav>
  </div>
</section>
