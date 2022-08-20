<?php get_header(); ?>

<div class="l-innerA">
  <?php
  echo mytheme_breadcrumb();
  ?>

  <div class="p-findStore">

    <h2 class="p-findStore__title">お店を探す</h2>
    <p class="p-findStore__subtitle">Find a store</p>


    <ul class="p-findStore__lists p-lists05">
      <?php
      $args = array(
        'post_type' => 'page_store_detail',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order',
      );
      $lists = new WP_Query($args);
      if ($lists->have_posts()) :
        while ($lists->have_posts()) : $lists->the_post();
          $post_id = $lists->ID;
      ?>
          <li class="p-lists05__item p-card05">
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="p-card05--link">
              <div class="p-card05__imgBox">
                <?php $image = get_field('main_image', $post_id);
                ?>
                <img src="<?php echo wp_get_attachment_image_src($image, 'large')[0]; ?>" alt="">
              </div>
              <div class="p-card05__info">
                <div class="p-card05__head">
                  <p class="p-card05__name">
                    <?php the_title(); ?>
                  </p>
                </div>
                <dl>
                  <dt>住所</dt>
                  <dd><?php echo get_field('shop_detail', $post_id)['shop_address']; ?></dd>
                  <dt>TEL</dt>
                  <dd><?php echo get_field('shop_detail', $post_id)['shop_tel']; ?></dd>
                  <dt>営業時間</dt>
                  <dd><?php echo get_field('shop_detail', $post_id)['shop_business_hours']; ?></dd>
                </dl>

              </div>
            </a>
          </li>
      <?php
        endwhile;
      endif;
      wp_reset_postdata();
      ?>

    </ul>

  </div>

</div>











<?php get_footer(); ?>