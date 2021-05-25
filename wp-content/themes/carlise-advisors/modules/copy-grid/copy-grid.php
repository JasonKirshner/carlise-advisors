<section class="copy-grid" data-module="copy-grid">
  <h2 class="module-name">Our Services</h2>
  <div class="services-icon">
    <?php the_module('image', array('image' => $services_icon)) ?>
  </div>
  <table class='copy-grid-table'>
    <?php
      if(have_rows('service')):
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
    ?>
  </table>
</section>
