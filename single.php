<?php get_header(); ?>

<div class="l-innerA p-innerColor">
  <?php
  echo mytheme_breadcrumb();
  ?>

  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();
  ?>
      <div class="p-mainView4">
        <?php echo get_main_image(); ?>
      </div>
  <?php
    endwhile;
  endif;
  ?>

  <div class="l-twoCol">

    <div class="l-mainCol">

      <?php if (have_posts()) :
        while (have_posts()) : the_post();
      ?>

          <div class="p-blogDetail">
            <time class="c-date01"><?php the_time('Y.m.d'); ?></time>
            <p class="p-blogDetail__title">
              <?php the_title(); ?>
            </p>

            <div class="p-blogDetail__contents">
              <?php the_content(); ?>
            </div>

        <?php
        endwhile;
      endif;
        ?>

        <ul class="p-blogDetail__hash p-hashLists01">
          <?php
          $tags = get_the_tags();
          if (!empty($tags)) :
            foreach ($tags as $tag) :
              include 'tag-lists.php';
            endforeach;
          endif;
          ?>

        </ul>
          </div>

          <div class="p-catDetail__shop p-shopAreaX">

            <ul class="p-shopAreaX__lists">

              <?php
              $terms = get_the_terms($post->ID, 'shop');
              if (!empty($terms)) :
                foreach ($terms as $term) :
                  $term_id = esc_html($term->term_id);

                  $term_idsp = 'shop_' . esc_html($term->term_id);

                  $page_slug = get_field('page_detail', $term_idsp);
                  $shop_img = get_field('main_image', $page_slug);
              ?>
                  <li>
                    <div class="p-shopAreaX__wrapper">
                      <div class="p-shopAreaX__imgBox">
                        <div class="p-shopAreaX__imgWrapper">
                          <img src="<?php echo wp_get_attachment_image_src($shop_img, 'full')[0]; ?>" alt="">
                        </div>
                      </div>

                      <div class="p-shopAreaX__info">
                        <p class="p-shopAreaX__name"><?php echo $term->name; ?></p>
                        <dl>
                          <dt>住所</dt>
                          <dd><?php
                              echo get_field('shop_detail', $page_slug)['shop_address']; ?></dd>
                          <dt>TEL</dt>
                          <dd><?php echo get_field('shop_detail', $page_slug)['shop_tel']; ?></dd>
                          <dt>営業時間</dt>
                          <dd><?php echo get_field('shop_detail', $page_slug)['shop_business_hours']; ?></dd>
                        </dl>
                      </div>
                    </div>
                    <a class="p-shopAreaX__button" href="
                  <?php
                  $detail_id = get_field('page_detail', $term_idsp);

                  echo esc_url(get_permalink($detail_id));
                  ?>">
                      お取り扱い店舗を見る</a>
                  </li>
              <?php
                endforeach;
              endif;
              ?>

            </ul>

          </div>

          <div class="p-blogDetail__others p-blogOthers">
            <h3 class="p-blogOthers__title">
              <?php
              $terms_obj = get_the_terms($post->ID, 'shop');
              $term = wp_list_pluck($terms_obj, 'slug');
              if (!empty($terms_obj)) {
                $temp = $terms;
                foreach ($terms_obj as $term_obj) : next($temp);
                  echo $term_obj->name;
                  echo (current($temp) !== false) ? 'と' : 'の';
                endforeach;
              }
              ?>最新ブログ</h3>

            <ul class="p-blogOthers__lists p-lists06">

              <?php
              $term_blog_lists = get_blog('post', 'shop', $term, null, 4);

              if ($term_blog_lists->have_posts()) :
                while ($term_blog_lists->have_posts()) : $term_blog_lists->the_post();
                  $blog_id = $term_blog_lists->ID;
              ?>
                  <li class="p-lists06__card p-card06">
                    <a href="<?php the_permalink(); ?>" class="p-card06__wrapper">
                      <div class="p-card06__imgBox">
                        <?php
                        $img_id = get_field('main_image', $blog_id);
                        ?>
                        <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="">
                      </div>

                      <p class="p-card06__title"><?php echo get_flexible_excerpt(26); ?></p>

                      <time class="p-card06__date"><?php the_time('Y.m.d'); ?></time>

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

    <div class="l-sideCol1 p-sideCol">

      <p class="p-sideCol__title">ピックアップ</p>

      <ul class="p-sideCol__lists p-lists07">
        <?php
        $blog_lists = get_blog('post', null, null, null, 5);
        // var_dump($term_blog_lists);
        if ($blog_lists->have_posts()) :
          while ($blog_lists->have_posts()) : $blog_lists->the_post();
            $blog_id = $blog_lists->ID;
        ?>
            <li class="p-lists07__card p-card07">
              <a href="<?php the_permalink(); ?>" class="p-card07__link">
                <div class="p-card07__imgBox">
                  <?php
                  $img_id = get_field('main_image', $blog_id);
                  ?>
                  <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="">
                </div>

                <p class="p-card07__title"><?php echo get_flexible_excerpt(30); ?></p>

                <time class="p-card07__date"><?php the_time('Y.m.d'); ?></time>
              </a>
            </li>
        <?php
          endwhile;
        endif;
        wp_reset_postdata();
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

<?php get_footer(); ?>