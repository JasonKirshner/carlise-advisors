<section class="navigation" data-module="navigation">
  <div class="container">
    <div class="header_logo">
      <?php
      if (setted($header_logo)) :
        the_module('image', array('image' => $header_logo));
      endif;
      ?>
    </div>
    <nav class='links'>
      <button><?= $what_we_do['title'] ?></button>
      <button><?= $about_us['title'] ?></button>
      <button><?= $contact['title'] ?></button>
    </nav>
  </div>
</section>
