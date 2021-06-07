<section class="copy-grid section-padding" data-module="copy-grid">
  <container class="container">
    <div class="copy-grid-container">
      <div class="copy-grid-icon">
        <?php
        if (setted($icon)) :
          the_module('image', array('image' => $icon));
        endif;
        ?>
      </div>
      <div class="module-name h2">
        <?= $title ?>
      </div>
      <div class="copy-grid-content">
        <?php
        if (setted($blurbs)) :
          $subheading = array_keys($blurbs[0])[0];
          $blurb = array_keys($blurbs[0])[1];
          foreach ($blurbs as $index => $content) :
        ?>
            <div class='content'>
              <div class='subheading h3'>
                <?= $blurbs[$index][$subheading] ?>
              </div>
              <div class='blurb p'>
                <?= $blurbs[$index][$blurb] ?>
              </div>
            </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </container>
</section>