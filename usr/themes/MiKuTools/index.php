<?php
/**
 * 主题基于Typecho的工具箱主题
 * 主题改自:Miku.tools
 * 演示站点:https://tools.kui.li

 * @package MikuTools
 * @version 1.0
 * @link https://tools.kui.li
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>


            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
          <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
              <?php while ($categories->next()): ?>
                  <?php if(count($categories->children) === 0): ?>
                  <?php $this->widget('Widget_Archive@category-' . $categories->mid, 'pageSize=10000&type=category', 'mid=' . $categories->mid)->to($posts); ?>

<fieldset class="nya-container">
          <legend class="nya-title">
            <i class="fa <?php $categories->slug(); ?>"></i>
            <span><?php $categories->name(); ?></span>
          </legend><br>

                  <?php while ($posts->next()): ?><a href="<?php $posts->test_url(); ?>" target="_blank" rel="nofollow" class="nya-btn <?php $posts->test_word(); ?>" title="<?php $posts->title(); ?>">
                           <?php $posts->title(); ?>
</a><?php endwhile; ?>
</fieldset>


        <?php else: ?>
      <?php endif; ?>
  <?php endwhile; ?>

       <?php $this->need('global.php'); ?>
<?php $this->need('footer.php'); ?>