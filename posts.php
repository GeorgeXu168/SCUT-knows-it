//回帖功能




<?php require_once 'inc/inc.php'; ?>
<?php include  'header.php'; ?>

<?php 
if (! isset($_g['id'])) 
{
  echo ("<script>alert('id错误');location.href='index.php';</script>");
  exit;
}


$posts = get_one("select * from `posts` where `id` = {$_g['id']};");
if(! $posts)
{
  echo ("<script>alert('id错误');location.href='index.php';</script>");
  exit;
}


$page   = empty($_g['page']) ? '1' : intval($_g['page']);
$result = mysql_query("select * from `comm` where `post_id` = {$_g['id']}");
$count  = mysql_num_rows($result);
$pager  = get_page("?id={$_g['id']}&", array(), $count, $page, 10);
$comm  = get_list("select * from `comm` where `post_id` = {$_g['id']} order by `id` asc limit {$pager['start']},{$pager['size']};");

function is_friend($user_id)
{
    global $_s;
    if(! isset($_s['user_id']))
    {
      return false;
    }
    $_is = get_row("select * from friends where `f_user` = {$_s['user_id']} and `t_user` = {$user_id}");
    return $_is ? true : false;
}
?>



<div class="wrapper">
  
  
    <div class="cat_list">
      <div class="title">
      <?php echo $posts['title'] ?>
      </div>
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
    <tr>
      <td rowspan="2" valign="top" width="120">
        <?php $zt_user = get_one("select * from `users` where `id` = {$posts['user_id']}") ?>
        <?php $flw_ct  = get_row("select * from `flower` where `t_user` = {$posts['user_id']} ") ?>
        <?php if ($zt_user['avatar']): ?>
          <img src="<?php echo base_url($zt_user['avatar']) ?>" height="120" width="120">
        <?php else: ?>
          <img src="<?php echo base_url('css/no_face.jpg') ?>" height="120" width="120">
        <?php endif ?>
        <div style="line-height:20px">楼主：<?php echo $zt_user['passport'] ?>
          <?php if (is_friend($zt_user['id'])): ?>
            
        <p>已经是好友</p>
      <?php else: ?>
        <p><a href="admin/actions.php?act=friend&tuser_id=<?php echo $zt_user['id']?>&post_id=<?php echo $posts['id'] ?>">加为好友</a></p>
          <?php endif ?>
        <p><a href="admin/actions.php?act=flower&tuser_id=<?php echo $zt_user['id']?>&post_id=<?php echo $posts['id'] ?>">送鲜花（<?php echo $flw_ct?>）</a></p></div>
      </td>
      <td valign="top">
        <?php echo $posts['conts'] ?>
      </td>
    </tr>
    <tr>
      <td valign="top" height="20">
        发布时间： <?php echo $posts['post_time'] ?>
      </td>
    </tr>
  </table>
  
  
  
  
      <div style="height:20px"></div>
      <div class="title">
     回复列表
      </div>
    <?php if ($comm): ?>
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
    <?php foreach ($comm as $k => $v): ?>
      
    <tr>
      <td rowspan="2" valign="top" width="100">
        <?php $tz_user = get_one("select * from `users` where `id` = {$v['user_id']}") ?>
        <?php $flw_ct  = get_row("select * from `flower` where `t_user` = {$v['user_id']} ") ?>
        <?php if ($tz_user['avatar']): ?>
          <img src="<?php echo base_url($tz_user['avatar']) ?>" height="100" width="100">
        <?php else: ?>
          <img src="<?php echo base_url('css/no_face.jpg') ?>" height="100" width="100">
        <?php endif ?>
        <div style="line-height:20px">会员：<?php echo $tz_user['passport'] ?>
          <?php if (is_friend($tz_user['id'])): ?>
            
        <p>已经是好友</p>
      <?php else: ?>
        <p><a href="admin/actions.php?act=friend&tuser_id=<?php echo $tz_user['id']?>&post_id=<?php echo $posts['id'] ?>">加为好友</a></p>
      <?php endif ?>
        <p><a href="admin/actions.php?act=flower&tuser_id=<?php echo $tz_user['id']?>&post_id=<?php echo $posts['id'] ?>">送鲜花（<?php echo $flw_ct?>）</a></p></div>
      </td>
      <td valign="top">
        <?php echo $v['conts'] ?>
      </td>
    </tr>
    <tr>
      <td valign="top" height="20">
        发布时间： <?php echo $v['post_time'] ?>
      </td>
    </tr>
    
    <?php endforeach ?>
  </table>
<?php else: ?><br>
  暂无回复<br><br>
    <?php endif ?>
  
  
    </div>
    
<?php require 'page.php';?>

    <div class="cat_list">
      <div class="title">
        我来回复
      </div>
      
  <form action="admin/actions.php?act=comm.add" method="post" name="form">
    <input type="hidden" name="post_id" value="<?php echo $posts['id'] ?>">
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
  <tr>
    <td>内容</td>
    <td><textarea id="editor" name="conts" style="width:680px;height:200px;"></textarea></td>
  </tr>
  <tr>
    <td width="120">&nbsp;</td>
    <td><input type="submit" value="提交" class="submit" /></td>
  </tr>
</table>
  </form>
      
    </div>

</div>

<script charset="utf-8" src="admin/editor/kindeditor.js"></script>
<script charset="utf-8" src="admin/editor/lang/zh_CN.js"></script>
<script>
        var editor;
        KindEditor.ready(function(K) {
                editor = K.create('#editor');
        });
</script>
<?php include  'footer.php'; ?>
</body>
</html>