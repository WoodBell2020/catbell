<?php

function my_script_init() {

  // swiper.min.css
  wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');

  wp_enqueue_style('styleA', get_template_directory_uri() . '/assets/css/styles.css');

  wp_enqueue_script('jquery');

  wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js');

  // 子テーマの独自jsファイルを直前で読み込む（jQueryの後に）
  wp_enqueue_script('original', get_template_directory_uri() . '/assets/js/swiper.js');

  wp_enqueue_script('jsA', get_template_directory_uri() . '/assets/js/script.js');
}
add_action('wp_enqueue_scripts', 'my_script_init');


// 投稿画面にタグ一覧を表示しチェックボックス選択式にする
function _re_register_post_tag_taxonomy() {
  $tag_slug_args = get_taxonomy('post_tag');
  $tag_slug_args->hierarchical = true;
  $tag_slug_args->meta_box_cb = 'post_categories_meta_box';
  register_taxonomy('post_tag', 'post', (array) $tag_slug_args);
}
add_action('init', '_re_register_post_tag_taxonomy', 1);



// アイキャッチ画像を利用できるようにする
add_theme_support('post-thumbnails');

// トップページのメイン画像用のサイズ設定
add_image_size('top_main', 820, 655, true);

// 下層ページのメイン画像用のサイズ設定
add_image_size('sub_main', 980, 400, true);

// ブログ詳細(サイドカラムあり)の店舗紹介用のサイズ設定
add_image_size('blogDetail_shop_twoCol', 282, 154, true);

// ブログ詳細(サイドカラムあり)の他記事紹介用のサイズ設定
add_image_size('blogLists_small', 147, 147, true);

// 店舗詳細(サイドカラムなし)の店長挨拶と他記事紹介用のサイズ設定
add_image_size('medium', 475, 295, true);


// 各テンプレート毎のメイン画像を表示
function get_main_image() {
  if (is_page()) {
    $attachment_id = get_field('main_image');
    return wp_get_attachment_image($attachment_id, 'sub_main');
  } elseif (is_singular('post') || is_singular('page_store_detail')) {
    $mainImage_id = get_field('main_image');
    return wp_get_attachment_image($mainImage_id, 'blogDetail_main');
  } else {
    return '<img src="' . get_template_directory_uri() . '/assets/images/bg-page-dummy.png" />';
  }
}


// デフォルト投稿メニューを削除
// function remove_menus() {
//   global $menu;
//   remove_menu_page('edit.php');
// }
// add_action('admin_menu', 'remove_menus');


// 絞り込みされた記事一覧を取得する
function get_blog($post_type, $taxonomy = null, $term = null, $tag = null,  $number = -1) {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  // var_dump($paged);
  if (!$term) {
    $args = array(
      'post_type' => $post_type,
      'posts_per_page' => $number,
      'tag' => $tag,
      'order' => 'DESC',
      'orderby' => 'date',
      'paged' => $paged,
    );
  } else {
    $args = array(
      'post_type' => $post_type,
      'posts_per_page' => $number,
      'order' => 'DESC',
      'orderby' => 'date',
      'paged' => $paged,
      'tax_query' => array(
        array(
          'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => $term,
        ),
      ),
    );
  }

  $specific_posts = new WP_Query($args);

  return $specific_posts;
}


// サブループ用ページネーション関数
function subPagination($the_lists, $end_size = 1, $mid_size = 2, $prev_next = false) {
  $page_formats = paginate_links(array(
    'current' => max(1, get_query_var('paged')),
    'total' => $the_lists->max_num_pages,
    'type' => 'array',
    'end_size' => $end_size,
    'mid_size' => $mid_size,
    'prev_next' => false,
  ));
  // var_dump($page_formats);
  $pagination_code = "";
  if (is_array($page_formats)) {
    $paged = get_query_var('page') == 0 ? 1 : get_query_var('page');
    $pagination_code .= '<div class="nav-links">' . PHP_EOL;
    $pagination_code .= '<ul class="page-numbers">' . PHP_EOL;
    foreach ($page_formats as $page_format) :
      // var_dump($page_format);
      $pagination_code .= '<li>' . $page_format . '</li>' . PHP_EOL;
    endforeach;
    $pagination_code .= '</ul>' . PHP_EOL;
    $pagination_code .= '</div>' . PHP_EOL;
    // $pagination_code .= '<div class="pagination-total">' . $paged . '/' . $the_lists->max_num_pages . '</div>' . PHP_EOL;
    wp_reset_query();
    return $pagination_code;
  }
};



function cms_excerpt_more() {
  return '...';
}
add_filter('excerpt_more', 'cms_excerpt_more');

function cms_excerpt_length() {
  return 80;
}
add_filter('excerpt_mblength', 'cms_excerpt_length');


// 抜粋機能を固定ページに使えるよう設定
add_post_type_support('page', 'excerpt');


function get_flexible_excerpt($number) {
  $value = get_the_excerpt();
  $value = wp_trim_words($value, $number, '...');
  return $value;
}

//get_the_excerpt() で取得する文字列に改行タグを挿入
function apply_excerpt_br($value) {
  return nl2br($value);
}
add_filter('get_the_excerpt', 'apply_excerpt_br');

// 画像に勝手にwidthやheightが入るのを防ぐ
// add_filter('wp_img_tag_add_width_and_height_attr', '__return_false');
// add_filter('wp_calculate_image_srcset_meta', '__return_null');



// 投稿のタイトルプレースホルダーを変更
function title_placeholder($placeholder) {
  $screen = get_current_screen();
  if ($screen->post_type == 'page_store_detail') {
    $title = '店名を入力してください';
  }
  return $title;
}
add_filter('enter_title_here', 'title_placeholder');


// 管理画面のカスタム投稿の投稿を公開日順に並び替え
function set_post_types_admin_order($wp_query) {
  if (is_admin()) {
    $post_type = $wp_query->query['post_type'];
    if ($post_type == 'page_store_detail' || $post_type == 'cat_detail') {
      $wp_query->set('orderby', 'date');
      $wp_query->set('order', 'DESC');
    }
  }
}
add_filter('pre_get_posts', 'set_post_types_admin_order');


// 管理画面の投稿記事をページ属性の順序の順にする
function ag_custom_post_type_order($wp_query) {
  if (is_admin()) {
    $post_type = $wp_query->query['post_type'];
    if ($post_type == 'page_store_detail') {
      $wp_query->set('orderby', 'menu_order'); //ソートの基準を設定：日付の場合は date
      $wp_query->set('order', 'ASC');   //ASC Or DESC で昇順・降順を設定
    }
  }
}
add_filter('pre_get_posts', 'ag_custom_post_type_order');



/* 投稿アーカイブページの作成 */
function post_has_archive($args, $post_type) {
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'post_archive'; //任意のスラッグ名
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);






// パンクズリスト
function mytheme_breadcrumb() {
  $urlA = $_SERVER['REQUEST_URI'];
  if (!is_front_page() && !is_home()) :
    $pnkz =  '<div class="l-breadcrumb p-breadcrumb">' . PHP_EOL;;
    $pnkz .=
      '<ol class="p-breadcrumb__lists">' . PHP_EOL;;
    $pnkz .=
      '<li class="p-breadcrumb__list">' . PHP_EOL;;
    $pnkz .= '<a href="' . get_bloginfo('url') .
      '">ホーム</a>' . PHP_EOL;;
    $pnkz .=
      '</li>' . PHP_EOL;;
    if (is_archive()) {
      if (is_tag()) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url(home_url()) .
          '/post_archive/ ">ブログ一覧</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
        $tag = get_queried_object();
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<span>' . $tag->name . ' ' .
          'ブログ一覧</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      } elseif (is_tax('cat_breed')) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url(get_post_type_archive_link('cat_detail')) .
          '" >猫種一覧</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
        $term_name = single_term_title('', false);
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<span>' . $term_name .
          '一覧</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      } elseif (is_tax('shop') && strstr($urlA, 'post_slug=cat_detail')) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url(home_url()) .
          '/post_archive/ ">ブログ一覧</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
        $term_name = single_term_title('', false);
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<span>' . $term_name .
          'の猫ちゃん一覧</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      } elseif (is_tax('shop') && strstr($urlA, 'post_slug=post')) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url(home_url()) .
          '/post_archive/ ">ブログ一覧</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
        $term_name = single_term_title('', false);
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<span>' . $term_name .
          'のブログ一覧</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      } elseif (is_post_type_archive('post')) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .=
          '<span>ブログ一覧</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      } elseif (is_post_type_archive('page_store_detail')) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .=
          '<span>お店を探す</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      } elseif (is_post_type_archive('cat_detail')) {
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .=
          '<span>猫種一覧</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      }
    } elseif (is_singular('post')) {
      $pnkz .=
        '<li class="p-breadcrumb__list">' . PHP_EOL;;
      $pnkz .= '<a href="' . esc_url(home_url()) .
        '/post_archive/ ">ブログ一覧</a>' . PHP_EOL;;
      $pnkz .=
        '</li>' . PHP_EOL;;
      $post_id = get_the_ID();
      $term_obj = get_the_terms($post_id, 'shop');
      if (!empty($term_obj)) :
        $url = add_query_arg(array('post_slug' => 'post'), esc_url(get_term_link($term_obj[0]->term_id)));
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url($url) . '">' . $term_obj[0]->name .
          'ブログ一覧</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;
      endif;
      if (is_single()) {
        $title = get_the_title();
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<span>' . $title .
          '</span>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      }
    } elseif (is_singular('page_store_detail')) {
      $post_id = get_the_ID();
      $term_obj = get_the_terms($post_id, 'shop');
      if (!empty($term_obj)) :
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url(get_post_type_archive_link('page_store_detail')) .
          '">お店を探す</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      endif;
      $title = get_the_title();
      $pnkz .=
        '<li class="p-breadcrumb__list">' . PHP_EOL;;
      $pnkz .= '<span>' . $title .
        '</span>' . PHP_EOL;;
      $pnkz .=
        '</li>' . PHP_EOL;;
    } elseif (is_singular('cat_detail')) {
      $pnkz .=
        '<li class="p-breadcrumb__list">' . PHP_EOL;;
      $pnkz .= '<a href="' . esc_url(get_post_type_archive_link('cat_detail')) .
        '">猫種一覧</a>' . PHP_EOL;;
      $pnkz .=
        '</li>' . PHP_EOL;;

      $post_id = get_the_ID();
      $term_obj_breed = get_the_terms($post_id, 'cat_breed');
      if (!empty($term_obj_breed)) :
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<a href="' . esc_url(get_term_link($term_obj_breed[0]->term_id)) . '">' . $term_obj_breed[0]->name .
          '</a>' . PHP_EOL;;
        $pnkz .=
          '</li>' . PHP_EOL;;
      endif;
      $term_obj_shop = get_the_terms($post_id, 'shop');
      if (!empty($term_obj_shop)) :
        $pnkz .=
          '<li class="p-breadcrumb__list">' . PHP_EOL;;
        $pnkz .= '<span>' . $term_obj_breed[0]->name . '　' . $term_obj_shop[0]->name . '</span>';
        $pnkz .=
          '</li>' . PHP_EOL;
      endif;
    }
    $pnkz .=
      '</ol>' . PHP_EOL;;
    $pnkz .=
      '</div>' . PHP_EOL;;
    echo $pnkz;
  endif;
}
