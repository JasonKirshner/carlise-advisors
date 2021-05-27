<section class="error-404<?= setted($class) ? " $class" : ""; ?>" data-module="error-404">

<table class='404-grid-table'>
    <tr><td class="error"> <h1>4 0 4 </h1>
    <h3> Son You Done Fucked Up </h3> 
    <div class="404-button"> <?php the_module('button', array(
    'button' => $footer_button,
    'use_button_tag' => true, // default false - optional
    'link' => 'http://carlise-advisors.lndo.site/', // required if $tag == 'a'
    'value' => 'Home', // required 
    ));?> 
    </div>
    </td>
    <td> <div class='404-image'>
    <?php the_module('image', array('image' => $four_image)) ?> 
    </div> 
    </td>
    </tr>

  </table>



</section>
