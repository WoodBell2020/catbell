<?php
get_header();
?>

<div class="l-innerA">

  <?php
  echo mytheme_breadcrumb();
  ?>

  <div class="p-mainView3">
    <?php echo get_main_image(); ?>
  </div>

  <div class="l-shopInfo p-shopInfo">

    <h2 class="p-shopInfo__title"><?php the_title(); ?>の基本情報</h2>

    <div class="p-shopInfo__container">

      <dl>
        <dt>住所</dt>
        <dd><?php echo get_field('shop_detail')['shop_address']; ?></dd>
        <dt>TEL</dt>
        <dd><?php echo get_field('shop_detail')['shop_tel']; ?>
        </dd>
        <dt>営業時間</dt>
        <dd><?php echo get_field('shop_detail')['shop_business_hours']; ?></dd>
        <dt>アクセス</dt>
        <dd>
          <?php echo get_field('shop_detail')['access']; ?>
        </dd>
      </dl>

      <div class="p-shopInfo__map">
        <iframe src="<?php echo get_field('shop_detail')['map_url']; ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

    </div>

  </div>

  <?php
  $store = get_the_terms($post->ID, 'shop');
  $stores_cat_lists = get_blog('cat_detail', 'shop', $store[0]->slug, null, 3);
  if ($stores_cat_lists->have_posts()) :
  ?>
    <div class="l-shopNewCat p-shopNewCat">

      <h2 class="p-shopNewCat__title"><?php the_title(); ?>の新入り猫ちゃん</h2>

      <ul class="p-shopNewCat__container">

        <?php
        $store = get_the_terms($post->ID, 'shop');
        $stores_cat_lists = get_blog('cat_detail', 'shop', $store[0]->slug, null, 3);
        // var_dump($stores_cat_lists);
        ?>
        <?php
        if ($stores_cat_lists->have_posts()) :
          while ($stores_cat_lists->have_posts()) : $stores_cat_lists->the_post();
            $post_id = $post->ID;
            // var_dump($post_id);
        ?>

            <li class="p-shopNewCat__card p-card08">
              <a href="<?php echo get_permalink($post_id); ?>" class="p-card08--link">
                <?php
                $img_obj = get_field('cat_info', $post_id)['cat_info_img01'];
                // var_dump($img_obj['url']);
                ?>
                <div class="p-card08__imgBox">
                  <img src="<?php echo esc_url($img_obj['url']); ?>" alt="">
                </div>

                <div class="p-card08__info">
                  <?php $cat_breed = get_the_terms($post_id, 'cat_breed');
                  // var_dump($cat_breed);
                  ?>
                  <p class="p-card08__breed">
                    <?php
                    echo $cat_breed[0]->name;
                    ?>
                  </p>
                  <dl>
                    <dt>性別</dt>
                    <dd><?php echo get_field('cat_info', $post_id)['cat_info_gender']; ?></dd>
                    <dt>生体価格</dt>
                    <dd><?php echo number_format(get_field('cat_info', $post_id)['cat_info_price']); ?>円(税抜)</dd>
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
      <?php
      $store = get_the_terms($post->ID, 'shop');
      ?>

      <a class="p-shopNewCat__button" href="
    <?php
    $post_slug = 'cat_detail';
    echo  add_query_arg(array('post_slug' => $post_slug), esc_url(get_term_link($store[0]->term_id)));
    ?>">この店舗の猫ちゃんを見る</a>

    </div>

  <?php
  endif;
  ?>

  <div class="l-greet p-greet">

    <h2 class="p-greet__title">店長よりごあいさつ</h2>

    <div class="p-greetContainer">

      <div class="p-greet__imgBox">
        <?php
        $manager_img = get_field('store_manager_greeting')['store_manager_image'];
        $manager_image = wp_get_attachment_image_src($manager_img, 'medium'); ?>
        <img src="<?php echo esc_url($manager_image[0]); ?>" alt="">
      </div>

      <div class="p-greet__txtBox">
        <p class="p-greet__txtHead"><?php echo get_field('store_manager_greeting')['store_manager_title']; ?></p>
        <p class="p-greet__txtContent">
          <?php echo get_field('store_manager_greeting')['store_manager_content']; ?>
        </p>
      </div>

    </div>

  </div>

  <?php
  $store = get_the_terms($post->ID, 'shop');
  $stores_blog_lists = get_blog('post', 'shop', $store[0]->slug, null, 3);
  // var_dump($stores_blog_lists);
  if ($stores_blog_lists->have_posts()) :
  ?>

    <div class="l-shopBlog p-shopBlog">

      <h2 class="p-shopBlog__title c-blogName"><?php the_title(); ?>の最新ブログ</h2>

      <div class="p-shopBlog__lists p-lists04">

        <ul class="p-lists04__lists">


          <?php
          if ($stores_blog_lists->have_posts()) :
            while ($stores_blog_lists->have_posts()) : $stores_blog_lists->the_post();
              $post_id = $post->ID;
          ?>

              <li>
                <div class="p-lists04__imgBoxB">
                  <?php $img_obj = get_field('main_image', $post_id);
                  ?>
                  <img src="<?php echo wp_get_attachment_image_src($img_obj, 'full')[0]; ?>" alt="">
                </div>

                <div class="p-lists04__info">
                  <div class="p-lists04__wrapper">

                    <time><?php echo get_the_date('Y.m.d'); ?></time>
                    <a href="<?php the_permalink(); ?>" class="p-lists04__title">
                      <?php echo get_the_title(); ?>
                    </a>
                    <p class="p-lists04__excerpt">
                      <?php echo get_the_excerpt(); ?>
                    </p>
                  </div>

                  <ul class="p-lists04__hash p-hashLists01">
                    <?php
                    $tags = get_the_tags();
                    if (!empty($tags)) :
                      foreach ($tags as $tag) :
                    ?>
                        <li>
                          <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo $tag->name;  ?></a>
                        </li>

                    <?php
                      endforeach;
                    endif;
                    ?>

                  </ul>
                </div>
              </li>

          <?php
            endwhile;
          endif;
          wp_reset_postdata();
          ?>

        </ul>

      </div>

      <a class="p-shopNewCat__button" href="
         <?php
          $post_slug = 'post';
          echo  add_query_arg(array('post_slug' => $post_slug), esc_url(get_term_link($store[0]->term_id)));
          ?>">この店舗のブログを見る</a>

    </div>

  <?php
  endif;
  ?>

</div>

<?php get_footer(); ?>