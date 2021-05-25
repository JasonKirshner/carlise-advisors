<section class="copy-grid" data-module="copy-grid">
  <h2 class="module-name">Our Services</h2>

  <div class="services-icon">
    <?php 
      if(setted($services_icon)):
        the_module('image', array('image' => $services_icon));
      endif;
    ?>
  </div>
  <table class='copy-grid-table'>
    <?php
      if(setted($service)):
        if(have_rows('service')):
          $numServices = count($service);
          echo "<style>.copy-grid-table{--numServices: " . $numServices . ";}</style>";
          echo "<tr>";
          while(have_rows('service')): the_row();
            echo "<td class='subheading'><h3>" . get_sub_field('service_sub_heading') . "</h3></td>";
          endwhile;
          echo "</tr><tr>";
          while(have_rows('service')): the_row();
            echo "<td class='blurb'><p>" . get_sub_field('service_blurb') . "</p></td>";
          endwhile;
          echo "</tr>";
        endif;
      endif;
    ?>
  </table>
</section>
