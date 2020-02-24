<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';$isauthor="博主";
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    else{$isauthor="";
}
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div class="comment-txt-box" id="<?php $comments->theId(); ?>">
        <div class="comment-author clearfix">
            <a href="<?php $comments->url(); ?>" target="_blank" rel="external nofollow">
            <?php $comments->gravatar('40', ''); ?>
            </a>
            <cite class="fn comment-info-title"><?php echo $author; ?><?php  echo '<span class="label bg-dark m-l-xs">'.$isauthor.'</span>';?></cite>
            <span class="comment-meta" ><?php echo timesince($comments->created);?></span>
        </div>

        <div><b><?php get_comment_at($comments->coid)?></b></div>
        <p><?php $comments->content();?></p>
        
        <div class="comment-meta">
            <span class="comment-reply label bg-primary"><?php $comments->reply(); ?></span>
        </div>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>
<!-- comments Begin -->
<section id="comments">
 <?php $this->comments()->to($comments); ?>
 <?php if ($comments->have()): ?>
<h4 class="m-t-lg m-b"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h4> 
<?php $comments->listComments(); ?>
<?php endif; ?>
<div class="text-center"> 
<?php $comments->pageNav('«', '»', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination pagination-sm', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?>
</div> 
<?php if($this->allow('comment')): ?>
<section id="<?php $this->respondId(); ?>" class="respond">
<div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
</div>
<h4 class="m-t-md m-b" id="response"><?php _e('欢迎留言'); ?></h4>
<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" > 
    <div class="form-group"> 
    <label><?php _e('评论'); ?> <em class="form-bt">*</em></label> 
    <textarea rows="5" cols="50" name="text" id="textarea" class="form-control OwO-textarea" placeholder="<?php _e('在这里输入您的想法...'); ?>" required ><?php $this->remember('text'); ?></textarea>
     <div title="OwO" class="OwO"></div> 
    </div> 
    <?php if($this->user->hasLogin()): ?>
       <p><?php _e('欢迎'); ?> <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> <?php _e('归来'); ?>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
    <?php else: ?>
    <div class="form-group pull-in clearfix"> 
    <div class="col-sm-4"> 
     <label for="author"><?php _e('名称'); ?> <em class="form-bt">*</em></label> 
     <input type="text" name="author" id="author" class="form-control" placeholder="<?php _e('姓名或者昵称'); ?>" value="<?php $this->remember('author'); ?>" required /> 
    </div> 
    <div class="col-sm-4"> 
     <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('邮箱'); ?> <em class="form-bt">*</em></label> 
     <input type="mail" name="mail" id="mail" class="form-control" placeholder="<?php _e('邮箱（将为您保密）'); ?>" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> /> 
    </div> 
    <div class="col-sm-4"> 
     <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('地址'); ?></label> 
     <input type="url" name="url" id="url" class="form-control" placeholder="<?php _e('http或https'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> /> 
    </div>
    </div> 
    <?php endif; ?>
    <div class="form-group"> 
    <button type="submit" class="btn btn-success"><?php _e('发表留言'); ?></button> 
    </div> 
</form>
</section>
 <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
<?php endif; ?>
</section>
<!-- OWO 表情 -->
<script>
var OwO_demo = new OwO({
    logo: '表情',
    container: document.getElementsByClassName('OwO')[0],
    target: document.getElementsByClassName('OwO-textarea')[0],
    api: '/usr/themes/TiNav/js/OwO.min.json',
    position: 'down',
    width: '100%',
    maxHeight: '250px'
});
</script>
<script type = "text/javascript">
function showhidediv(id){  
var sbtitle=document.getElementById(id);  
if(sbtitle){  
   if(sbtitle.style.display=='block'){  
   sbtitle.style.display='none';  
   }else{  
   sbtitle.style.display='block';  
   }  
}  
}
(function() {
    window.TypechoComment = {
        dom: function(id) {
            return document.getElementById(id);
        },
        create: function(tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply: function(cid, coid) {
            var comment = this.dom(cid),
                parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type': 'hidden',
                    'name': 'parent',
                    'id': 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id': 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';
            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply: function() {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
                holder = this.dom('comment-form-place-holder'),
                input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>