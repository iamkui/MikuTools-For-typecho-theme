<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
     <aside class="bg-dark aside hidden-print" id="nav"> 
      <section class="vbox"> 
       <section class="w-f-md scrollable"> 
        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2"> 
         <nav class="nav-primary hidden-xs"> 
         <ul class="nav clearfix hidden-nav-xs"> 
           <li> 
            <div class="text-center"> 
             <a href="<?php $this->options->siteUrl();?>" class="thumb-lg m-t-xs"> <img src="<?php $this->options->BlogPic();?>" alt="<?php $this->options->BlogName();?>" title="<?php $this->options->BlogName();?>" class="img-circle" /> </a>
              <div class="m-t-sm m-b-sm l-h-2x"> 
              <small class="text-muted"><?php $this->options->BlogAdd();?></small> 
              </div> 
            </div>
           </li> 
           <li class="m-b-sm">
            <div class="lt text-center clearfix">
               <div class="wrapper">
                <div>
                  <?php $time = date("H", time() + ($this->options->timezone - idate("Z")));$percent = $time / 24;$percent = sprintf("%01.2f", $percent * 100) . '%';?> 
                  <?php if ($time >= 6 && $time <= 11) {    ?>
                  <p><?php  _e('新的一天要元气满满！');?></p>
                  <?php } elseif ($time >= 12 && $time <= 13) {    ?>
                  <p><?php _e('午饭时间，休息一下吧！'); ?></p>
                  <?php } elseif ($time >= 14 && $time <= 15) {?>
                  <p><?php _e('打起精神，好好工作！');?></p>
                  <?php } elseif ($time >= 16 && $time <= 17) {?>
                  <p><?php _e('该不该叫个下午茶呢？');?></p>
                  <?php } else {?>
                       <p><?php _e('天黑了，回家吧！');?></p>
                  <?php }?>
                  </div>
                  <div class="progress progress-xs m-b-none dker">
                    <div class="progress-bar bg-white" data-toggle="tooltip" data-original-title="<?php echo $percent;?>" style="width: <?php echo $percent;?>"></div>
                  </div>
              </div>
            </div>
           </li>
          </ul>
         <ul class="nav text-center hidden-xs" data-ride="collapse"> 
  
  <?php $this->widget('Widget_Metas_Category_List')->to($categorys);
    while ($categorys->next()) {
      if ($categorys->levels === 0) {
        $children = $categorys->getAllChildren($categorys->mid);
        if (empty($children)) {?>
        <li <?php if ($this->is('category', $categorys->slug)) {?> class="active"<?php }?>>
          <a href="/#<?php $categorys->name();?>" title="<?php $categorys->name();?>"><span style="padding-right:10px;"> <i class="fa <?php $categorys->slug();?>" style="padding-right:10px;"> </i> <?php $categorys->name();?></span></a>
        </li>
      <?php  } else {?>
        <li><a href="javascript:;" class="auto"> <span class="pull-right text-muted"> <i class="fa fa-angle-left text"></i> <i class="fa fa-angle-down text-active"></i> </span> <span><i class="fa <?php $categorys->slug();?>" style="padding-right:10px;"> </i> <?php 
 $categorys->name();?></span></a>
          <ul class="nav dk text-sm">
            <?php foreach ($children as $mid) {$child = $categorys->getCategory($mid);?>
              <li <?php if ($this->is('category', $mid)) {?> class="active"<?php }?>>
                <a href="/#<?php echo $child['name'];?>" title="<?php echo $child['name'];?>" ><span style="padding-right:10px;"> <i class="fa <?php echo $child['slug'];?>" style="padding-right:10px;"> </i> <?php echo $child['name'];?></span></a>
              </li>
          <?php 
            }
            ?>
        </ul>
      </li>
    <?php 
            }
        }
    }
  ?></ul>

<ul class="nav text-center visible-xs" data-ride="collapse"> 
  
<?php $this->widget('Widget_Metas_Category_List')->to($categorys);while ($categorys->next()) {
    if ($categorys->levels === 0) {
        $children = $categorys->getAllChildren($categorys->mid);
        if (empty($children)) {
            ?>
          <li <?php if ($this->is('category', $categorys->slug)) {?> class="active"<?php }?>>
            <a href="<?php $categorys->permalink(); ?>" title="<?php $categorys->name();?>"><span style="padding-right:10px;"> <i class="fa <?php $categorys->slug();?>" style="padding-right:10px;"> </i> <?php $categorys->name();?></span></a>
          </li>
      <?php 
        } else {
            ?>
          <li>
            <a href="javascript:;" class="auto"> <span class="pull-right text-muted"> <i class="fa fa-angle-left text"></i> <i class="fa fa-angle-down text-active"></i> </span> <span><i style="padding-right:10px;" class="fa <?php $categorys->slug();?>"> </i> <?php $categorys->name();?></span></a>
            <ul class="nav dk text-sm">
            <?php foreach ($children as $mid) {$child = $categorys->getCategory($mid);?>
              <li <?php if ($this->is('category', $mid)) {?> class="active"<?php }?>>
              <a href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name'];?>" ><span style="padding-right:10px;"> <i class="fa <?php echo $child['slug'];?>" style="padding-right:10px;"> </i> <?php echo $child['name'];?></span></a>
          </li>
    <?php 
            }
            ?>
          </ul>
        </li>
<?php 
        }
    }
}
?>
</ul>
        </div> 
       </section> 
       <footer class="footer hidden-xs no-padder text-center-nav-xs lt">
          <div class="bg hidden-xs text-center">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat);?>
               <div class="col-xs-4 blog-stats m-t-xs"> 
                 <span class="block text-white"><?php $stat->publishedPostsNum();?></span> 
                 <small class="text-muted">收录</small> 
               </div>
               <div class="col-xs-4 blog-stats m-t-xs"> 
               <a href="/#links" title="友情链接">
                 <span class="block text-white"><i class="fa fa-link"></i></span>
                 <small class="text-muted">友链</small>
               </a>
               </div>
               <div class="col-xs-4 blog-stats m-t-xs"> 
               <a href="/view.html" title="留言反馈">
                 <span class="block text-white"><i class="fa fa-send-o"></i></span> 
                 <small class="text-muted">留言</small> 
               </a>
               </div> 
          </div>
        </footer>
      </section> 
     </aside> 
     <!-- /.aside -->