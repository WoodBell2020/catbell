<div class="l-innerA p-innerColor">


  <?php
  echo mytheme_breadcrumb();
  ?>

  <div class="l-twoCol">

    <div class="l-mainCol">

      <h2 class="c-blogName"><?php echo single_term_title(); ?>のブログ</h2>

      <div class="p-lists04">

        <ul class="p-lists04__lists">
          <?php
          $term_object = get_queried_object();
          // var_dump($term_object);
          $blog_lists = get_blog('post', 'shop', $term_object->slug, null, 5);
          if ($blog_lists->have_posts()) :
            while ($blog_lists->have_posts()) :
              $blog_lists->the_post();
              // var_dump($blog_lists);
              $blog_id = get_the_id();
          ?>
              <li>

                <div class="p-lists04__imgBoxA">
                  <?php
                  $img_id = get_field('main_image', $blog_id);
                  ?>
                  <img src="
                  <?php
                  echo wp_get_attachment_image_src($img_id, 'full')[0];
                  ?>" alt="">
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
                          <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
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


        <?php
        if (subPagination($blog_lists)) {
          echo subPagination($blog_lists);
        }
        ?>

      </div>

    </div>

    <div class="l-sideCol2 p-sideCol">

      <p class="p-sideCol__title">ピックアップ</p>

      <ul class="p-sideCol__lists p-lists07">
        <?php
        $blog_lists = get_blog('post', null, null, null, -1);
        // var_dump($blog_lists);
        if ($blog_lists->have_posts()) :
          while ($blog_lists->have_posts()) :
            $blog_lists->the_post();
            $blog_id = $blog_lists->ID;
            // var_dump($blog_id);
        ?>
            <li class="p-lists07__card p-card07">
              <a href="<?php the_permalink(); ?>" class="p-lists07__link">
                <div class="p-card07__imgBox">
                  <?php $img_id = get_field('main_image', $blog_id); ?>
                  <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="">
                </div>

                <p class="p-card07__title"><?php the_title(); ?></p>

                <time class="p-card07__date"><?php the_date('Y.m.d'); ?></time>
              </a>
            </li>
        <?php
          endwhile;
        endif;
        ?>

      </ul>


      <div class="p-sideCol__hashBox">

        <p class="p-sideCol__title">キーワード</p>

        <ul class="p-sideCol__hashlists p-hashlists02">

          <?php
          $tags = get_tags();
          foreach ($tags as $tag) :
          ?>
            <li>
              <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
            </li>
          <?php
          endforeach;
          ?>

        </ul>

      </div>

    </div>

  </div>

</div>

<div class="p-shopAreaY">

  <ul class="p-shopAreaY__lists">
    <?php
    $term_id = get_queried_object_id();
    $shop_id = get_field('shop_select', 'shop' . '_' . $term_id);
    ?>
    <li>
      <div class="p-shopAreaY__wrapper">
        <div class="p-shopAreaY__imgBox">
          <div class="p-shopAreaY__imgWrapper">
            <?php $img_id = get_field('main_image', $shop_id);
            ?>
            <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0] ?>" alt="">
          </div>
        </div>
        <div class="p-shopAreaY__info">
          <p class="p-shopAreaY__name"><?php echo single_term_title(); ?></p>
          <dl>
            <dt>住所</dt>
            <dd><?php echo get_field('shop_detail', $shop_id)['shop_address']; ?></dd>
            <dt>TEL</dt>
            <dd><?php echo get_field('shop_detail', $shop_id)['shop_tel']; ?></dd>
            <dt>営業時間</dt>
            <dd><?php echo get_field('shop_detail', $shop_id)['shop_business_hours'] ?></dd>
          </dl>
          <a class="p-shopAreaY__button" href="<?php echo esc_url(get_permalink($shop_id)); ?>">お取扱い店舗を見る</a>
        </div>
      </div>
    </li>
  </ul>

</div>