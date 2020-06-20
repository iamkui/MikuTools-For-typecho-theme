<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>





            <?php if ($this->is('index')): ?>
            <?php elseif ($this->is('post')): ?>
            <span class="pull-left"><?php $this->category(); ?></span>
            <span class="active text-ellipsis pull-left"><?php $this->title() ?></span>
            <?php else: ?>

            <?php endif; ?>

<fieldset class="nya-container">
					<legend class="nya-title">
						<i class="fa fa-search"></i>
						<span>搜索结果</span>
					</legend>
                <?php if ($this->have()): ?>
                  <?php while ($this->next()): ?><a href="<?php $this->tool_url(); ?>" target="_blank" rel="nofollow" class="nya-btn" title="<?php $this->title(); ?>">
                           <?php $this->title(); ?>
                    </a><?php endwhile; ?>
                <?php else :?>
                    <p>很遗憾，未找到与关键词相关的内容，可能是本站还没有这方面的内容或是您输入的关键词不够准确，您可以尝试使用新的关键词重新搜索</p>
                <?php endif;?>
</fieldset>

          <div class="text-center">
           <?php $this->pageNav('«', '»', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination pagination-sm', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?>

       <?php $this->need('global.php'); ?>
<?php $this->need('footer.php'); ?>