<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if ($this->is('index')): ?>
<?php endif; ?>
<!DOCTYPE html>
<html>
 <head> 
  <meta charset="<?php $this->options->charset(); ?>">
  <title><?php $this->archiveTitle(array(
    'category'  =>  _t('%s导航'),
    'search'    =>  _t('包含关键字 %s 的文章'),
    'tag'       =>  _t('标签 %s 下的文章'),
    'author'    =>  _t('%s 发布的文章')
  ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')): ?> - <?php $this->options->Indexdict(); ?><?php endif; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>">
 <link rel="stylesheet" href="<?php $this->options->themeUrl('css/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <script src="https://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/icon.png">
  <meta property="og:image" content="https://web.geekji.cn/images/logo.jpg">
  <meta data-n-head="true" name="HandheldFriendly" content="true">    <!-- 自适应 -->
  <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <!-- 通过自有函数输出HTML头部信息 -->
  <style type="text/css">
    mark {
        background: #249ffd;
    	color: #fff;
    }
	input::-webkit-input-placeholder{color:#fff;}
    </style>
  <?php $this->header(); ?>
 </head> 
 <body> 
	<div class="index_page">
		<div class="bgimg" style="filter:blur(4px);opacity:.5"></div>
		<style>:root{--t1:#2f3e4c;--t2:#ffffff;color:#2f3e4c}</style>
		<main>
					<div class="navbar">
						<header>
							<h1 class="title">
								<a href="/" class="nuxt-link-exact-active nuxt-link-active">
									<?php $this->options->title() ?> - <?php $this->options->Indexbt();?>
								</a>
								<i class="fa fa-flag"></i>
							</h1>
							<div class="subtitle">
								<i class="fa fa-star"></i>
								<span>收藏本站体验更多功能</span>
							</div>
						</header>
					</div>
				<div class="home view">
	<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search"> 
     <div class="search-component"> 
      <div class="search" style="background-color:#249ffd;"> 
<!--         <span>
       	<button type="submit"> --><i class="fa fa-search" style="color:#fff;"></i><!-- </button>
       </span> -->
       <input type="text" id="s" name="s" placeholder="<?php _e('输入关键字回车搜索'); ?>" autocomplete="off"/> 
      </div> 
     </div> 
    </form> 
					<div class="favorites"></div>
					<div id="context">