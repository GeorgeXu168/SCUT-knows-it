//���԰�




<?php require_once 'inc/inc.php'; ?>

<?php include  'header.php'; ?>
<?php 

$page   = empty($_g['page']) ? '1' : intval($_g['page']);
$result = mysql_query("select * from `books`");
$count  = mysql_num_rows($result);
$pager  = get_page("?", array(), $count, $page, 10);
$_list  = get_list("select * from `books` order by `id` desc limit {$pager['start']},{$pager['size']};");

 ?>
<div class="wrapper">
  	
  	<form action="admin/actions.php?act=books.add" method="post">
		  
	<div class="cat_list">
  		<div class="title">
			  <a href="">���԰�</a>
		</div>
	</div>
  	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<td valign="top">��������</td>
			<td>
				<textarea name="cont" cols="60" rows="5"></textarea>
			</td>
		</tr>
		<tr>
			<td width="140">&nbsp;</td>
			<td>
				<?php if (isset($_s['user_login'])): ?>
				<input type="submit" value="�ύ" class="submit">
					<?php else: ?>
				<input type="button" value="���ȵ�¼" class="submit" onclick="alert('���ȵ�¼��');window.location.href='login.php'">
				<?php endif ?>
			</td>
		</tr>
	</table>
	<div class="cat_list">
		<div class="title">
			<a href="">�����б�</a>
		</div>
	</div>

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<?php if ($_list): ?>
		
		<?php foreach ($_list as $k => $v): ?>
		<?php $_user = get_one("select * from users where id = {$v['user_id']}") ?>
		<tr>
			<td style="text-align:right" valign="top">
				<?php if ($_user['avatar']): ?>
					<img style="display:inline" src="<?php echo base_url($_user['avatar']) ?>" height="60" width="60" >
				<?php else: ?>
					<img style="display:inline" src="<?php echo base_url('css/no_face.jpg') ?>" height="60" width="60" >
				<?php endif ?>
			</td>
			<td valign="top"><?php echo $_user['passport'] ?>&nbsp;������&nbsp;<?php echo $v['post_time'] ?>
				<br><b><?php echo $v['conts'] ?></b>
				<?php if ($v['reply']): ?>
					<p style="border:1px solid #f00;margin-top:10px; color:#f60;padding:10px;">����Ա�ظ��� <?php echo $v['reply'] ?><br>ʱ�䣺<?php echo $v['reply_time'] ?></p>
				<?php endif ?></td>
		</tr>
		<?php endforeach ?>
		
		
		
		
	<?php else: ?>
		<tr>
			<td colspan="2">�������Լ�¼</td>
		</tr>
		<?php endif ?>
	</table>
  	</form>
  	<?php include 'page.php'; ?>
</div>

<?php include  'footer.php'; ?>
</body>
</html>