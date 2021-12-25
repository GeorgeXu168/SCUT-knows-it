//修改个人资料




<?php require_once 'inc/inc.php'; ?>
<?php include  'header.php'; ?>

<?php if(! isset($_s['user_login']))
{
	echo ("<script>alert('请先登录');location.href='index.php';</script>");
	exit;
} ?>


<?php $user = get_one("select * from `users` where `id` = {$_s['user_id']};") ?>

<div class="wrapper">
  	<form action="admin/actions.php?act=user.edit" method="post" name="form">
  	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th colspan="2">修改资料</th>
		</tr>
		<tr>
			<td>帐号</td>
			<td>
				<input type="text" name="passport" style="width:200px" value="<?php echo $user['passport'] ?>" />
			</td>
		</tr>
		<tr>
			<td>上传头像</td>
			<td>
				<?php if ($user['avatar']): ?>
					<img src="<?php echo base_url($user['avatar']) ?>" height="100" width="100" />
				<?php endif ?>
				<input type="text" name="upload" style="width:500px" value="<?php echo $user['avatar'] ?>" />
				<iframe src="admin/upload.php?dir=images" width="400" height="25" frameborder="0" scrolling="no"></iframe>
			</td>
		</tr>
		<tr>
			<td>性别</td>
			<td>
				<input type="radio" name="sex" value="男" <?php if($user['sex'] == '男'): ?> checked="checked"<?php endif ?> />男&nbsp;&nbsp;&nbsp;
				<input type="radio" name="sex" value="女" <?php if($user['sex'] == '女'): ?> checked="checked"<?php endif ?> />女
			</td>
		</tr>
		<tr>
			<td>生日</td>
			<td>
				<input type="text" name="btd" style="width:200px" value="<?php echo $user['birthday'] ?>" />格式 1992-01-01
			</td>
		</tr>
		<tr>
			<td>qq</td>
			<td>
				<input type="text" name="qq" style="width:200px" value="<?php echo $user['qq'] ?>" />
			</td>
		</tr>
		<tr>
			<td>地址</td>
			<td>
				<input type="text" name="addr" style="width:200px" value="<?php echo $user['addr'] ?>" />
			</td>
		</tr>
		<tr>
			<td>注册时间</td>
			<td>
				<?php echo $user['reg_time'] ?>
			</td>
		</tr>
		<tr>
			<td width="120">&nbsp;</td>
			<td><input type="submit" value="提交" class="submit"></td>
		</tr>
	</table>
  	</form>
</div>

<?php include  'footer.php'; ?>
</body>
</html>
