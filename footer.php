  <footer class="l-footer p-footer">

    <div class="p-footer__inner">

      <div class="p-footer__container">

        <div class="p-footer__logo">
          <a href="<?php echo esc_url(home_url()); ?>">cat bell</a>
        </div>

        <navi class="p-footer__navi p-footerNavi">
          <ul class="p-footerNavi__Box">
            <li class="p-footerNavi__Item p-footerNavi__Item--footer"><a href="<?php echo get_post_type_archive_link('cat_detail'); ?>">ペットを<br class="pc-none">探す</a></li>
            <li class="p-footerNavi__Item p-footerNavi__Item--footer"><a href="<?php echo get_post_type_archive_link('page_store_detail'); ?>">お店を<br class="pc-none">探す</a></li>
            <li class="p-footerNavi__Item p-footerNavi__Item--footer"><a href="<?php echo home_url(); ?>/post_archive/">ブログ<br class="pc-none">一覧</a></li>
          </ul>
        </navi>

      </div>

      <div class="p-footer__copy">
        <span class="c-copy">
          &copy; 2020-2022 CAT BELL Co., Ltd.
        </span>
      </div>

    </div>


  </footer>
  <?php
  wp_footer();
  ?>
  </body>

  </html>