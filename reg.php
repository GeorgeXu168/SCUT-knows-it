//�û�ע��





<?php require_once 'inc/inc.php'; ?>

<?php include  'header.php'; ?>


<div class="wrapper">
  	<form action="admin/actions.php?act=user.add" method="post" name="form">
  	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th colspan="2">�û�ע��</th>
		</tr>
		<tr>
			<td>�ʺ�</td>
			<td>
				<input type="text" name="passport" style="width:200px" />
			</td>
		</tr>
		<tr>
			<td>ͷ���ַ</td>
			<td>
				<input type="text" name="upload" style="width:500px" />
			</td>
		</tr>
		<tr>
			<td>�ϴ�ͷ��</td>
			<td>
				<iframe src="admin/upload.php?dir=images" width="400" height="25" frameborder="0" scrolling="no"></iframe>
			</td>
		</tr>
		<tr>
			<td>����</td>
			<td>
				<input type="password" name="pwd1" style="width:200px" />
			</td>
		</tr>
		<tr>
			<td>�ظ�����</td>
			<td>
				<input type="password" name="pwd2" style="width:200px" />
			</td>
		</tr>
		<tr>
			<td>�Ա�</td>
			<td>
				<input type="radio" name="sex" value="��" />��&nbsp;&nbsp;&nbsp;
				<input type="radio" name="sex" value="Ů" />Ů
			</td>
		</tr>
		<tr>
			<td>����</td>
			<td>
				<input type="date" name="btd" style="width:200px" />��ʽ 1992-01-01
			</td>
		</tr>
		<tr>
			<td>qq</td>
			<td>
				<input type="text" name="qq" style="width:200px" />
			</td>
		</tr>
		<tr>
			<td>��ַ</td>
			<td>
				<input type="text" name="addr" style="width:200px" />
			</td>
		</tr>
		<tr>
			<td width="120">&nbsp;</td>
			<td><input type="submit" value="�ύ" class="submit"></td>
		</tr>
	</table>
  	</form>
</div>

<?php include  'footer.php'; ?>
</body>
</html>