<div class="l-innerA">

  <?php
  echo mytheme_breadcrumb();
  ?>


  <div class="p-lists02">

    <h2 class="p-lists02__title"><?php echo single_term_title('', false); ?>の猫ちゃん一覧</h2>

    <ul class="p-lists02__lists">
      <?php
      $term_object = get_queried_object();
      // var_dump($term_object);
      $cat_lists = get_blog('cat_detail', 'shop', $term_object->slug, null, 5);
      // var_dump($cat_lists->max_num_pages);
      if ($cat_lists->have_posts()) :
        while ($cat_lists->have_posts()) : $cat_lists->the_post();
          $cat_detail_id = get_the_ID();
          // var_dump(get_the_terms($post->ID, 'cat_breed'));
      ?>
          <li>
            <div class="p-lists02__imgBox">
              <img src="<?php echo get_field('cat_info', $cat_detail_id)['cat_info_img01']['url']; ?>" alt="">
            </div>

            <div class="p-lists02__info">
              <div class="p-lists02__head">

                <?php
                $shop_lists = get_the_terms($cat_detail_id, 'shop');
                // var_dump($shop_lists);
                if (!empty($shop_lists)) :
                  foreach ($shop_lists as $shop_list) :
                    // var_dump($shop_list);
                ?>
                    <p class="p-lists02__shop"><?php echo $shop_list->name; ?></p>
                <?php
                  endforeach;
                endif;
                ?>

                <p class="p-lists02__name">
                  <?php
                  $breed = get_the_terms($post->name, 'cat_breed');
                  echo $breed[0]->name;
                  ?>
                </p>
              </div>
              <dl>
                <dt>生年月日</dt>
                <dd><?php echo get_field('cat_info', $cat_detail_id)['cat_info_birthday']; ?></dd>
                <dt>性別</dt>
                <dd><?php echo get_field('cat_info', $cat_detail_id)['cat_info_gender']; ?></dd>
                <dt>生体価格</dt>
                <dd><span><?php echo number_format(get_field('cat_info', $cat_detail_id)['cat_info_price']); ?></span>円（税抜）</dd>
              </dl>
              <div class="p-lists02__buttonBox">
                <?php

                $shop_idsp = 'shop_' . esc_html($shop_lists[0]->term_id);
                // var_dump($shop_idsp);

                $shop_id = get_field('page_detail', $shop_idsp);
                ?>
                <a href="<?php echo esc_url(get_permalink($shop_id)); ?>" class="p-lists02__button1">お取り扱い店舗を見る</a>


                <a href="<?php echo esc_url(get_permalink($cat_detail_id)); ?>" class="p-lists02__button2">この猫を詳しく見る</a>
              </div>
            </div>

          </li>
      <?php
        endwhile;
      endif;
      wp_reset_postdata();
      ?>


    </ul>


    <?php
    if (subPagination($cat_lists)) {
      echo subPagination($cat_lists);
    }
    ?>




    <div class="p-otherBreeds1">

      <p class="p-otherBreeds1__title">ほかにもこんな猫種が注目されています！</p>


      <div class="p-subBreed__lists1 p-breed4Col">
        <ul>

          <?php
          $terms = get_terms('cat_breed');
          $term_arrysA = array();
          foreach ($terms as $term) :
            array_push($term_arrysA, $term);
          endforeach;
          shuffle($term_arrysA);
          for ($iii = 0; $iii < 4; $iii++) :
            if (!empty($term_arrysA)) :
          ?>

              <li>
                <a href="<?php echo esc_url(get_term_link($term_arrysA[$iii]->slug, 'cat_breed')); ?>" class="p-breed4Col__link">
                  <div class="p-breed4Col__imgBox">
                    <img src="<?php echo esc_url(get_field('cat_breed_img', 'cat_breed' . '_' . $term_arrysA[$iii]->term_id)['url']); ?>" alt="" />
                  </div>
                  <p class="p-breed4Col__typeName">
                    <?php echo $term_arrysA[$iii]->name; ?>
                  </p>
                </a>
              </li>
          <?php
            endif;
          endfor;
          ?>

        </ul>
      </div>
    </div>

  </div>



</div>