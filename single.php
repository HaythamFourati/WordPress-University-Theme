<?php get_header()?>



<?php

while(have_posts()){
  the_post(); ?>
  <ul class="custom-posts-list"> 
  <li>
    
  <h2><?php the_title() ?></h2>
   <p><?php the_content() ?></p>
</li>
  </ul>
  <?php
}
?>






<?php get_footer() ?>