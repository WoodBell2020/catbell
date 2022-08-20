<?php get_header(); ?>


<div class="l-innerA">

  <?php
  echo mytheme_breadcrumb();
  ?>


  <div class="l-innerA">
    <section class="l-subBreed p-subBreed">
      <h2 class="c-sectionTitle p-subBreed__title">ペットを探す</h2>



      <p class="c-sectionSubTitle p-subBreed__subTitle">Find a pet</p>

      <div class="p-subBreed__lists1 p-breed4Col">
        <ul>
          <?php
          $terms = get_terms('cat_breed');
          $terms_arrysB = array();
          foreach ($terms as $term) :
            // var_dump($term);
            array_push($terms_arrysB, $term);
          endforeach;
          shuffle($terms_arrysB);
          if (!empty($terms_arrysB)) :
            for ($iii = 0; $iii < 8; $iii++) :
          ?>
              <li>
                <a href="<?php echo esc_url(get_term_link($terms_arrysB[$iii]->slug, 'cat_breed')); ?>" class="p-breed4Col__link">
                  <div class="p-breed4Col__imgBox">
                    <img src="<?php echo esc_url(get_field('cat_breed_img', 'cat_breed' . '_' . $terms_arrysB[$iii]->term_id)['url']); ?>" alt="<?php echo $terms_arrysB[$iii]->name; ?>" />
                  </div>
                  <p class="p-breed4Col__typeName">
                    <?php echo $terms_arrysB[$iii]->name; ?>
                  </p>
                </a>
              </li>
          <?php
            endfor;
          endif;
          ?>

        </ul>
      </div>



      <div class="p-subBreed__lists2 p-breed3Col">

        <ul>
          <?php
          // var_dump($terms_arrysB);
          // var_dump(count($terms_arrysB));
          if (count($terms_arrysB) >= 9) :
            for ($iii = 8; $iii < count($terms_arrysB); $iii++) :
          ?>
              <li>
                <a href="<?php echo esc_url(get_term_link($terms_arrysB[$iii]->slug, 'cat_breed')); ?>">
                  <div class="p-breed3Col__imgBox">
                    <img src="<?php echo esc_url(get_field('cat_breed_img', 'cat_breed' . '_' . $terms_arrysB[$iii]->term_id)['url']); ?>" alt="<?php echo $terms_arrys[$iii]->name; ?>" />
                  </div>
                  <p class="p-breed3Col__typeName">
                    <?php echo $terms_arrysB[$iii]->name; ?>
                  </p>
                </a>
              </li>
          <?php
            endfor;
          endif;
          wp_reset_postdata();
          ?>


        </ul>

      </div>


    </section>
  </div>

</div>

<?php get_footer(); ?>