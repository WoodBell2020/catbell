<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <!-- meta情報 -->
  <title><?php echo wp_get_document_title(); ?></title>
  <meta name="description" content="<?php bloginfo('description') ?>" />
  <meta name="keywords" content="" />
  <!-- ogp -->
  <meta property="og:title" content="" />
  <meta property="og:type" content="" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="" />
  <meta property="og:description" content="" />
  <!-- ファビコン -->
  <link rel="”icon”" href="" />

  <!-- googlefont -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet" />

  <!-- css -->
  <!-- <link rel="stylesheet" href="http://ninjacat.local/wp-content/themes/NinjaCat/assets/css/styles.css" /> -->
  <!-- jQuery -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <?php
  wp_head();
  ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="l-header p-header <?php
                                    if (is_home() || is_front_page()) {
                                      echo 'p-front_page';
                                    }
                                    ?>">

    <div class="p-header__inner">

      <div class="p-header__container">

        <h1 class="p-header__logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">cat bell</a>
        </h1>

        <nav class="p-header__navi p-globalNavi">
          <ul class="p-globalNavi__Box">
            <li class="p-globalNavi__Item p-globalNavi__Item--header"><a href="<?php echo get_post_type_archive_link('cat_detail'); ?>">ペットを探す</a></li>
            <li class="p-globalNavi__Item p-globalNavi__Item--header"><a href="<?php echo get_post_type_archive_link('page_store_detail'); ?>">お店を探す</a></li>
            <li class="p-globalNavi__Item p-globalNavi__Item--header"><a href="<?php echo home_url(); ?>/post_archive/">ブログ一覧</a></li>
          </ul>
        </nav>

        <div class="p-header__hamburger p-hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>

      </div>

    </div>
  </header>