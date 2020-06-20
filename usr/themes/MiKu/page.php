<?php
/**
 * 反馈
 * 
 * @package custom
 *
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>


     <section id="content" class="blog-box"> 
      <section class="vbox"> 
       <section class="scrollable wrapper"> 
        <div class="row"> 
         <div class="col-lg-12"> 
          <div class="blog-post"> 
          <ol class="breadcrumb clearfix">
          <i class="fa fa-circle-o icon-muted"> </i>
            <?php if ($this->is('index')): ?>
            <?php elseif ($this->is('post')): ?>
            <li class="pull-left"><?php $this->category(); ?></li>
            <li class="active text-ellipsis pull-left"><?php $this->title() ?></li>
            <?php else: ?>
              <li><?php $this->archiveTitle(' &raquo; ','',''); ?></li>
            <?php endif; ?>
          </ol>
           <div class="post-item"> 
           <?php $this->content(); ?>
           </div> 
          </div> 
          <?php $this->need('comments.php'); ?>
         </div>
        </div> 
       </section> 
       <?php $this->need('global.php'); ?>
      </section> 
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a> 
     </section> 
<?php $this->need('footer.php'); ?>