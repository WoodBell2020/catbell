<?php get_header(); ?>

<?php
if (isset($_GET['post_slug'])) {
  $post_slug = $_GET['post_slug'];
  // var_dump($post_slug);
  if ($post_slug == 'cat_detail') {
    get_template_part('shop_breed_lists');
  } elseif ($post_slug == 'post') {
    get_template_part('shop_blog_lists');
  };
};

?>

<?php get_footer(); ?>