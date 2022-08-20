"use strict";

jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる
  $('#MenuButton').click(function () {
    // $(".l-drawer-menu").toggleClass("is-show");
    // $(".p-drawer-menu").toggleClass("is-show");
    $('.js-drawer-open').toggleClass('open');
    $('.drawer-menu').toggleClass('open');
    $('html').toggleClass('is-fixed');
  });
  var topBtn = $('.pagetop');
  topBtn.hide(); // ボタンの表示設定

  $(window).scroll(function () {
    if ($(this).scrollTop() > 70) {
      // 指定px以上のスクロールでボタンを表示
      topBtn.fadeIn();
    } else {
      // 画面が指定pxより上ならボタンを非表示
      topBtn.fadeOut();
    }
  }); // ボタンをクリックしたらスクロールして上に戻る

  topBtn.click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 300, 'swing');
    return false;
  }); // フロントページのヘッダー背景画像表示

  $(window).on('load resize scroll', function () {
    var mainViewContents = $('.p-mainView1__contents').offset().top;
    console.log('mainViewContents=' + mainViewContents);
    var headerHeight = $('header').outerHeight();
    console.log('headerHeight=' + headerHeight);
    var windowWidth = $(window).width();
    console.log('windowWidth=' + windowWidth);

    if (windowWidth >= 768) {
      if ($(window).scrollTop() > mainViewContents - headerHeight) {
        $('header').css('background-color', '#fff');
      } else {
        $('header').css('background-color', 'transparent');
      }
    } else {
      $('header').css('background-color', '#fff');
    }
  }); // スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動)

  $(document).on('click', 'a[href*="#"]', function () {
    var time = 400;
    var header = $('header').innerHeight();
    var target = $(this.hash);
    if (!target.length) return;
    var targetY = target.offset().top - header;
    $('html,body').animate({
      scrollTop: targetY
    }, time, 'swing');
    return false;
  });
  $('.p-hamburger').on('click', function () {
    $(this).toggleClass('open');
    $('.p-header').toggleClass('open');
  });
});