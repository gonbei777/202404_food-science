<?php

// タイトルタグを有効化する
add_theme_support('title-tag');

// アイキャッチ画像を有効化する
add_theme_support('post-thumbnails');

// メニューを有効化する
add_theme_support('menus');


// titleタグの区切り文字を変更する
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator)
{
  $separator = '|';
  return $separator;
}


// Contact Form 7の出力の際にPタグが勝手に入らないようにする
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
  return false;
}
