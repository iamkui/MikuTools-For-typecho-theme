<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $Weibo = new Typecho_Widget_Helper_Form_Element_Text('Weibo', NULL, NULL, _t('站长微博地址'), _t('输入你的底部微博图标地址'));
    $form->addInput($Weibo);

    // $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
    // array('ShowRecentPosts' => _t('显示最新文章'),
    // 'ShowRecentComments' => _t('显示最近回复'),
    // 'ShowCategory' => _t('显示分类'),
    // 'ShowArchive' => _t('显示归档'),
    // 'ShowOther' => _t('显示其它杂项')),
    // array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));

    // $form->addInput($sidebarBlock->multiMode());
    /*<?php $this->options->socialqq(); ?> 调用方法*/

    //站长博客地址
    $Blogurl = new Typecho_Widget_Helper_Form_Element_Text('Blogurl', NULL, NULL, _t('站长博客地址'), _t('输入你的底部博客图标地址'));
    $form->addInput($Blogurl);
    //首页名称后缀（必填）
    $Indexdict = new Typecho_Widget_Helper_Form_Element_Text('Indexdict', NULL, NULL, _t('首页的名称后缀'), _t('输入你的首页显示的名称后缀'));
    $form->addInput($Indexdict);
    //首页标题名称后缀（必填）
    $Indexbt = new Typecho_Widget_Helper_Form_Element_Text('Indexbt', NULL, NULL, _t('首页标题名称后缀'), _t('输入你的首页顶部显示的名称后缀'));
    $form->addInput($Indexbt);
    //博主名称
    $BlogMail = new Typecho_Widget_Helper_Form_Element_Text('BlogMail', NULL, NULL, _t('邮箱地址'), _t('输入你的邮箱地址'));
    $form->addInput($BlogMail);
    //QQ群号
    $BlogQh = new Typecho_Widget_Helper_Form_Element_Text('BlogQh', NULL, NULL, _t('QQ群'), _t('输入QQ群群号'));
    $form->addInput($BlogQh);
    //加群链接
    $BlogQurl = new Typecho_Widget_Helper_Form_Element_Text('BlogQurl', NULL, NULL, _t('QQ群加群链接'), _t('输入QQ群的加群URL'));
    $form->addInput($BlogQurl);
    //备案号
    $BlogBa = new Typecho_Widget_Helper_Form_Element_Text('BlogBa', NULL, NULL, _t('备案号'), _t('输入网站备案号'));
    $form->addInput($BlogBa);
    //QQ收款码
    $Payqq = new Typecho_Widget_Helper_Form_Element_Text('Payqq', NULL, NULL, _t('QQ收款码'), _t('输入QQ收款码的图片URL'));
    $form->addInput($Payqq);
    //微信收款码
    $Paywx = new Typecho_Widget_Helper_Form_Element_Text('Paywx', NULL, NULL, _t('微信收款码'), _t('输入微信收款码的图片URL'));
    $form->addInput($Paywx);
    //支付宝收款码
    $Payali = new Typecho_Widget_Helper_Form_Element_Text('Payali', NULL, NULL, _t('支付宝收款码'), _t('输入支付宝收款码的图片URL'));
    $form->addInput($Payali);
}


//获取评论的锚点链接
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));
    $parent = @$prow['parent'];
    if ($parent != "0") {//子评论
        $arow = $db->fetchRow($db->select('author,status')->from('table.comments')
            ->where('coid = ?', $parent));//查询该条评论的父评论的作者的名称
        @$author = @$arow['author'];//作者名称
        if(@$author && $arow['status'] == "approved"){//父评论作者存在且父评论已经审核通过
            if (@$prow['status'] == "waiting"){
                echo '<em class="awaiting">'."您的评论正等待审核！".'</em>';
            }
            echo '<a href="#comment-' . $parent . '"><div>@' . $author . '</div></a>';
        }else{//父评论作者不存在或者父评论没有审核通过
            if (@$prow['status'] == "waiting"){
                echo '<em class="awaiting">'."您的评论正等待审核！".'</em>';
            }else{
                echo '';
            }
        }
    } else {
        //母评论，无需输出锚点链接
        if (@$prow['status'] == "waiting"){
            echo '<em class="awaiting">'."您的评论正等待审核！".'</em>';
        }else{
            echo '';
        }
    }

}


//评论时间
function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '小时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);

for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';

return $output;
}

//get_post_view($this)
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    }
    echo $row['views'];
}