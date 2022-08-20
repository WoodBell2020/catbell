<?php get_header(); ?>

<div class="l-innerA">

  <?php
  echo mytheme_breadcrumb();
  ?>

  <section class="l-catDetail p-catDetail">

    <div class="p-mainView2">

      <div class="p-mainView2__swiper p-swiperBox">
        <!-- メインスライダー -->
        <div class="swiper main-sldier">
          <div class="swiper-wrapper">

            <?php $image01 = get_field('cat_info')['cat_info_img01'];
            if (!empty($image01)) :
              $url01 = $image01['url'];
            ?>
              <div class="swiper-slide main-slide">
                <img src=<?php echo $url01; ?> alt="" />
              </div>
            <?php endif; ?>

            <?php $image02 = get_field('cat_info')['cat_info_img02'];
            if (!empty($image02)) :
              $url02 = $image02['url'];
            ?>
              <div class="swiper-slide main-slide">
                <img src=<?php echo $url02; ?> alt="" />
              </div>
            <?php endif; ?>


            <?php $image03 = get_field('cat_info')['cat_info_img03'];
            if (!empty($image03)) :
              $url03 = $image03['url'];
            ?>
              <div class="swiper-slide main-slide">
                <img src=<?php echo $url03; ?> alt="" />
              </div>
            <?php endif; ?>


            <?php $image04 = get_field('cat_info')['cat_info_img04'];
            if (!empty($image04)) :
              $url04 = $image04['url'];
            ?>
              <div class="swiper-slide main-slide">
                <img src=<?php echo $url04; ?> alt="" />
              </div>
            <?php endif; ?>

          </div>
        </div>
        <!-- サムネイルスライダー -->
        <div class="swiper thumbnail-sldier">
          <div class="swiper-wrapper">

            <?php $image01 = get_field('cat_info')['cat_info_img01'];
            if (!empty($image01)) :
              $url01 = $image01['url'];
            ?>
              <div class="swiper-slide thumbnail-slide">
                <img src="<?php echo $url01; ?>" alt="" />
              </div>
            <?php endif; ?>


            <?php $image02 = get_field('cat_info')['cat_info_img02'];
            if (!empty($image02)) :
              $url02 = $image02['url'];
            ?>
              <div class="swiper-slide thumbnail-slide">
                <img src="<?php echo $url02; ?>" alt="" />
              </div>
            <?php endif; ?>


            <?php $image03 = get_field('cat_info')['cat_info_img03'];
            if (!empty($image03)) :
              $url03 = $image03['url'];
            ?>
              <div class="swiper-slide thumbnail-slide">
                <img src="<?php echo $url03; ?>" alt="" />
              </div>
            <?php endif; ?>


            <?php $image04 = get_field('cat_info')['cat_info_img04'];
            if (!empty($image04)) :
              $url04 = $image04['url'];
            ?>
              <div class="swiper-slide thumbnail-slide">
                <img src="<?php echo $url04; ?>" alt="" />
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>

      <div class="p-mainView2__info p-catinfo">
        <?php $terms = get_the_terms($catg_detail->ID, 'cat_breed');
        foreach ($terms as $term) :
          if (!empty($term->name)) :
        ?>
            <h2 class="p-catinfo__breed"><?php echo $term->name; ?></h2>
        <?php
          endif;
        endforeach; ?>
        <dl>

          <?php $birthday = get_field('cat_info')['cat_info_birthday'];
          if (!empty($birthday)) :
          ?>
            <dt>
              生年月日
            </dt>
            <dd>
              <?php echo $birthday; ?>
            </dd>
          <?php endif; ?>

          <?php $gender = get_field('cat_info')['cat_info_gender'];
          if (!empty($gender)) :
          ?>

            <dt>
              性別
            </dt>
            <dd>
              <?php echo $gender; ?>
            </dd>

          <?php endif; ?>

          <?php $price = get_field('cat_info')['cat_info_price'];
          if (!empty($price)) :
          ?>
            <dt>
              生体価格
            </dt>
            <dd>
              <span class="p-catinfo__price">
                <?php echo number_format($price, 0); ?></span>円（税抜）
            </dd>
          <?php endif; ?>


          <?php $pedigree = get_field('cat_info')['cat_info_pedigree'];
          if (!empty($pedigree)) :
          ?>
            <dt>
              血統書
            </dt>
            <dd>
              <?php echo $pedigree; ?>
            </dd>
          <?php endif; ?>


        </dl>
        <?php $terms = get_the_terms($catg_detail->ID, 'cat_breed');
        foreach ($terms as $term) :
          if (!empty($term->slug)) :
        ?>
            <a href="<?php echo esc_url(get_term_link($term->slug, 'cat_breed')); ?>" class="p-catinfo__linktolist">
              <?php echo $term->name; ?>一覧を見る
          <?php
          endif;
        endforeach;
        wp_reset_postdata();
          ?>
            </a>
      </div>


    </div>

  </section>

  <section class="p-catDetail__comment p-comment">

    <h3 class="p-comment__title">コメント</h3>

    <?php $comment = get_field('cat_info')['cat_info_comment'];
    if (!empty($comment)) :
    ?>
      <p class="p-comment__editor">
        <?php echo $comment; ?>
      </p>
    <?php endif; ?>

  </section>


  <div class="p-catDetail__shop p-shopAreaX">

    <ul class="p-shopAreaX__lists">

      <?php
      $terms = get_the_terms($cat_detail->ID, 'shop');
      if (!empty($terms)) :
        foreach ($terms as $term) :
          $term_id = esc_html($term->term_id);
          $term_idsp = 'shop_' . esc_html($term->term_id);
          // var_dump($term_idsp);
          $page_id = get_field('page_detail', $term_idsp);
          $img_id = get_field('main_image', $page_id);
      ?>
          <li>
            <div class="p-shopAreaX__wrapper">

              <div class="p-shopAreaX__imgBox">
                <div class="p-shopAreaX__imgWrapper">
                  <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="">
                </div>
              </div>

              <div class="p-shopAreaX__info">
                <p class="p-shopAreaX__name"><?php echo $term->name; ?></p>
                <dl>
                  <dt>住所</dt>
                  <dd><?php
                      echo get_field('shop_detail', $page_id)['shop_address']; ?></dd>
                  <dt>TEL</dt>
                  <dd><?php echo get_field('shop_detail', $page_id)['shop_tel']; ?></dd>
                  <dt>営業時間</dt>
                  <dd><?php echo get_field('shop_detail', $page_id)['shop_business_hours']; ?></dd>
                </dl>
                <a class="p-shopAreaX__button" href="<?php
                                                      $shop_id = get_field('page_detail', $term_idsp);
                                                      echo esc_url(get_permalink($shop_id));
                                                      ?>">この猫のお取扱い店舗を見る</a>
              </div>

            </div>
          </li>
      <?php
        endforeach;
      endif;
      ?>

    </ul>

  </div>

  <div class="p-catDetail__otherBreeds p-otherBreeds1">

    <p class="p-otherBreeds1__title">ほかにもこんな猫種が注目されています！</p>


    <div class="p-subBreed__lists1 p-breed4Col">
      <ul>
        <?php
        $terms = get_terms('cat_breed');
        $term_arrys = array();
        foreach ($terms as $term) :
          array_push($term_arrys, $term);
        endforeach;
        shuffle($term_arrys);
        for ($iii = 0; $iii < 4; $iii++) :
          if (!empty($term_arrys)) :
        ?>
            <li>
              <a href="<?php echo esc_url(get_term_link($term_arrys[$iii]->slug, 'cat_breed')); ?>" class="p-breed4Col__link">
                <div class="p-breed4Col__imgBox">
                  <img src="<?php echo esc_url(get_field('cat_breed_img', 'cat_breed' . '_' . $term_arrys[$iii]->term_id)['url']); ?>" alt="スコティッシュフォールド" />
                </div>
                <p class="p-breed4Col__typeName">
                  <?php echo $term_arrys[$iii]->name; ?>
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

<?php get_footer(); ?>