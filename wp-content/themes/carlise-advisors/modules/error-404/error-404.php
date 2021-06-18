<section class="error-404<?= setted($class) ? " $class" : ""; ?>" data-module="error-404">
  <div class="container four_container">
    <div class="four-wrap">
      <h1 class="h1">4 0 4 </h1>
      <h3 class="h3"><?= $four_text ?> </h3>
      <div class="four-button"> <?php the_module('button', array(
                                  'link' => home_url(), // required if $tag == 'a'
                                  'value' => 'Home', // required 
                                )); ?> </div>
    </div>
    <div class='four-image'>
      <?php the_module('image', array('image' => $four_image)) ?>
    </div>

  </div>

</section>
