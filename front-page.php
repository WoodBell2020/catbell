<?php get_header(); ?>

<section class="l-mainView1 p-mainView1">
  <div class="p-mainView1__img">
    <?php $img_id = get_field('main_image'); ?>
    <img src="<?php echo wp_get_attachment_image_src($img_id, 'large')[0]; ?>" alt="">
  </div>


  <div class="p-mainView1__contents">
    <p class="p-mainView1__mainTitle">猫と暮らそう</p>
    <p class="p-mainView1__subTitle">安心・安全な<br class="pc-none">猫専門ペットショップ</p>

    <div class="p-mainView1__buttonBox">
      <a href="<?php echo get_post_type_archive_link('cat_detail'); ?>" class="c-catBreedButton p-mainView1__catBreedButton">
        猫種一覧を見る
      </a>

      <a href="<?php echo get_post_type_archive_link('page_store_detail'); ?>" class="c-shopButton p-mainView1__shopButton"> お店を見る </a>
    </div>
  </div>

</section>

<section class="l-topNews p-topNews">
  <div class="l-innerA">
    <div class="p-topNews__inner p-topNews__container">
      <h2 class="p-topNews__title">お知らせ</h2>

      <ul class="p-topNews__lists p-news">
        <?php
        $news_lists = get_blog('post', null, null, null, 4);
        if ($news_lists->have_posts()) :
          while ($news_lists->have_posts()) : $news_lists->the_post();
        ?>
            <li class="p-news__wrapper">
              <dt class="p-news__date">
                <time datetime="<?php echo get_the_date('Y.m.d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
              </dt>
              <dd class="p-news__content">
                <a href="<?php echo get_permalink($blog_lists->ID); ?>"><?php the_title(); ?></a>
              </dd>
            </li>
        <?php
          endwhile;
        endif;
        wp_reset_postdata();
        ?>

      </ul>
    </div>
  </div>
</section>

<section class="l-topBreed p-topBreed">
  <div class="l-innerA">
    <h2 class="c-sectionTitle p-topBreed__title">ペットを探す</h2>

    <p class="c-sectionSubTitle p-topBreed__subTitle">Find a pet</p>


    <div class="p-topBreed__lists1 p-breed4Col">
      <ul>
        <?php
        $terms = get_terms('cat_breed');
        $terms_arryC = array();
        foreach ($terms as $term) :
          array_push($terms_arryC, $term);
        endforeach;
        shuffle($terms_arryC);
        if (!empty($terms_arryC)) :
          for ($iii = 0; $iii < 8; $iii++) :
        ?>
            <li>
              <a href="<?php echo esc_url(get_term_link($terms_arryC[$iii]->slug, 'cat_breed')); ?>" class="p-breed4Col__link">
                <div class="p-breed4Col__imgBox">
                  <img src=<?php echo esc_url(get_field('cat_breed_img', 'cat_breed' . '_' . $terms_arryC[$iii]->term_id)['url']); ?> alt="<?php echo $terms_arryC[$iii]->name; ?>" />
                </div>
                <p class="p-breed4Col__typeName">
                  <?php echo $terms_arryC[$iii]->name; ?>
                </p>
              </a>
            </li>
        <?php
          endfor;
        endif;
        ?>


      </ul>
    </div>

    <div class="c-button01">
      <a href="<?php echo get_post_type_archive_link('cat_detail'); ?>" class="c-button01__link p-topBreed__button">
        猫種一覧を見る
      </a>
    </div>
  </div>
</section>

<section class="l-topStore p-topStore">
  <div class="l-innerA">
    <h2 class="c-sectionTitle p-topStore__title">お店を探す</h2>
    <p class="c-sectionSubTitle p-topStore__subTitle">Find a store</p>

    <div class="p-topStore__mapContainer p-japanMap">
      <div class="p-japanMap__inner">
        <span class="c-storeJpMap p-japanMap__1"></span>
        <span class="c-storeJpMap p-japanMap__2"></span>
        <span class="c-storeJpMap p-japanMap__3"></span>
        <span class="c-storeJpMap p-japanMap__4"></span>
        <span class="c-storeJpMap p-japanMap__5"></span>


        <a href="<?php echo get_page_by_path('sapporo', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__sapporo">札幌店</a>
        <a href="<?php echo get_page_by_path('miyagi', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__miyagi">宮城店</a>
        <a href="<?php echo get_page_by_path('shinjuku', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__shinjuku">新宿店</a>
        <a href="<?php echo get_page_by_path('ishikawa', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__ishikawa">石川店</a>
        <a href="<?php echo get_page_by_path('umeda', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__umeda">梅田店</a>
        <a href="<?php echo get_page_by_path('shizuoka', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__shizuoka">静岡店</a>
        <a href="<?php echo get_page_by_path('fukuoka', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__fukuoka">福岡店</a>
        <a href="<?php echo get_page_by_path('kagoshima', OBJECT, 'page_store_detail')->guid ?>" class="c-storeMapButton p-japanMap__kagoshima">鹿児島店</a>
      </div>
    </div>

    <div class="c-button01">
      <a href="<?php echo get_post_type_archive_link('page_store_detail'); ?>" class="c-button01__link p-topStore__button">
        店舗一覧を見る
      </a>
    </div>

  </div>
</section>

<section class="l-topBlog p-topBlog">
  <div class="l-innerA">
    <h2 class="c-sectionTitle p-topBlog__title">ブログ</h2>
    <p class="c-sectionSubTitle p-topBlog__subTitle">Blog</p>

    <ul class="p-topBlog__container p-lists01">

      <?php
      $blog_lists = get_blog('post', null, null, null, 4);
      if ($blog_lists->have_posts()) :
        while ($blog_lists->have_posts()) : $blog_lists->the_post();
      ?>
          <li class="p-lists01__item p-card01">
            <a href="<?php echo get_permalink($blog_lists->ID); ?>" class="p-card01__link">
              <div class="p-card01__imgBox">
                <?php $img_id = get_field('main_image'); ?>
                <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="" />
              </div>

              <div class="p-card01__Body">
                <p class="p-card01__text">
                  <?php the_title(); ?>
                </p>

                <time class="p-card01__date" datetime="<?php echo get_the_date('Y.m.d'); ?>">
                  <?php echo get_the_date('Y.m.d'); ?>
                </time>
              </div>
            </a>
          </li>
      <?php
        endwhile;
      endif;
      ?>

    </ul>

    <div class="c-button01">
      <a href="<?php echo esc_url(home_url()); ?>/post_archive/" class="c-button01__link p-topBlog__button">
        ブログ一覧を見る
      </a>
    </div>


  </div>
</section>

<section class="l-topAbout p-topAbout">
  <div class="l-innerB p-topAbout__bgImg">

    <div class="l-innerA">

      <h2 class="c-sectionTitle p-topAbout__title">サイトについて</h2>
      <p class="c-sectionSubTitle p-topAbout__subTitle">About</p>

      <div class="p-topAbout__container">

        <p class="p-topAbout__textTitle">
          ペットと人との笑顔ある未来の創造
        </p>

        <p class="p-topAbout__textDescription">
          家族の絆を深める、子供の情操教育、ヒーリング効果など、<br class="sp-none">
          ペットと暮らすメリットが証明されてきており、<br class="sp-none">
          それらの効果は人々の暮らしに必要不可欠な”笑顔”を<br class="sp-none">
          もたらすことができます。 <br>
          CAT BELLは、ペットというかけがえのない生命を<br class="sp-none">
          お客様へご提供することで、笑顔ある未来を創造し、<br class="sp-none">
          より豊かな社会環境の構築に貢献いたします。
        </p>


      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>