<?php get_header(); ?>



<div class="l-innerA p-innerColor">


  <?php
  echo mytheme_breadcrumb();
  ?>

  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();
      if ($wp_query->current_post == 0) :
  ?>

        <div class="p-mainView3">
          <?php $img_id = get_field('main_image'); ?>
          <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="">
        </div>

        <div class="p-lists03--top">
          <a href="<?php the_permalink(); ?>" class="p-lists03__title">
            <?php the_title(); ?>
          </a>
          <p class="p-lists03__excerpt">
            <?php the_excerpt(); ?>
          </p>
          <div class="p-addBox01">
            <ul class="p-hashLists01">
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
            <time class="c-date01"><?php the_date('Y.m.d'); ?></time>
          </div>

        </div>

  <?php
      endif;
    endwhile;
  endif;
  ?>


  <div class="l-twoCol">

    <div class="l-mainCol">


      <div class="p-lists04">

        <ul class="p-lists04__lists">
          <?php
          if (have_posts()) :
            while (have_posts()) : the_post();
              if ($wp_query->current_post != 0) :
          ?>
                <li>

                  <div class="p-lists04__imgBoxA">
                    <?php $img_id = get_field('main_image'); ?>
                    <img src="<?php echo wp_get_attachment_image_src($img_id, 'large')[0]; ?>" alt="">
                  </div>

                  <div class="p-lists04__info">
                    <div class="p-lists04__wrapper">

                      <time><?php echo get_the_date('Y.m.d'); ?></time>
                      <a href="<?php the_permalink(); ?>" class="p-lists04__title">
                        <?php the_title(); ?>
                      </a>
                      <p class="p-lists04__excerpt">
                        <?php
                        $excerpt = get_the_excerpt();
                        if (!empty($excerpt)) {
                          the_excerpt();
                        } else {
                          the_content();
                        }
                        ?>
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
              endif;
            endwhile;
          endif;
          ?>

        </ul>

        <?php
        the_posts_pagination(array(
          'mid_size' => 2,
          'prev_next' => false,
          'type' => 'list',
        ));
        ?>

      </div>

    </div>

    <div class="l-sideCol2 p-sideCol">

      <p class="p-sideCol__title">ピックアップ</p>

      <ul class="p-sideCol__lists p-lists07">
        <?php
        $blog_lists = get_blog('post', null, null, null, 3);
        if ($blog_lists->have_posts()) :
          while ($blog_lists->have_posts()) : $blog_lists->the_post();

        ?>
            <li class="p-lists07__card p-card07">
              <div class="p-card07__imgBox">
                <?php
                $img_id = get_field('main_image'); ?>
                <img src="<?php echo wp_get_attachment_image_src($img_id, 'full')[0]; ?>" alt="">
              </div>

              <p class="p-card07__title"><?php the_title(); ?></p>

              <time class="p-card07__date"><?php echo get_the_date('Y.m.d'); ?></time>
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

<?php get_footer(); ?>