<?php
require("../inc/inc.php");
$_act = ((isset($_g['act']) and ! empty($_g['act']) ) ? $_g['act'] : ''); 
$_now = date('Y-m-d H:i:s');

// ��ӷ���
if($_act == 'cat.add')
{
	if($_p['name'] == '')
	{
		echo "<script>alert('����д ��������');history.back();</script>";
    	exit;  
	}
	if($_p['desc'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	
	$sql = "insert into `cat` (`name`,`desc`) values ('{$_p['name']}','{$_p['desc']}');";
	mysql_query($sql); 
	echo "<script>alert('��ӳɹ�,�������!');location='cat_list.php';</script>";
	exit;
}

// �༭����
if($_act == 'cat.edit')
{
	$id = intval($_p['id']);
	if($_p['name'] == '')
	{
		echo "<script>alert('����д ��������');history.back();</script>";
    	exit;  
	}
	if($_p['desc'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	
	$sql = "update `cat` set `name` = '{$_p['name']}',`desc` = '{$_p['desc']}' where `id` = {$id};";
	mysql_query($sql); 
	echo "<script>alert('�༭�ɹ�,�������!');location='cat_list.php';</script>";
	exit;
}

// ɾ������
if($_act == 'cat.del')
{
	$id = intval($_g['id']);
	
	$sql = "delete from `cat` where id = {$id};";
	mysql_query($sql); 
	echo "<script>alert('ɾ���ɹ�,�������!');location='cat_list.php';</script>";
	exit;
}



// ɾ����Ա
if($_act == 'user.del')
{
	$id = intval($_g['id']);
	$sql = "delete from `users` where id = {$id};";
	mysql_query($sql); 
	echo "<script>alert('ɾ���ɹ�,�������!');location='user_list.php';</script>";
	exit;
}

// ���Ա��ظ�
if($_act == 'books.reply')
{
	$id = $_p['id'];
	if($_p['reply'] == '')
	{
		echo "<script>alert('����д �ظ�����');history.back();</script>";
    	exit;  
	}
	
	$sql = "update `books` set `reply` = '{$_p['reply']}', `reply_time` = '{$_now}' where `id` = {$id};";
	mysql_query($sql); 
	echo "<script>alert('�ظ��ɹ�,�������!');location='books_list.php';</script>";
	exit;
}


// ------------------------------------------------------------------------------------------
// �޸Ĺ���Ա����
if($_act == 'admin_pwd.edit')
{
	$id = intval($_s['admin_id']);
	if($_p['pwd1'] == '')
	{
		echo "<script>alert('����д ��ǰ����');history.back();</script>";
    	exit;  
	}
	if($_p['pwd2'] == '')
	{
		echo "<script>alert('����д ������');history.back();</script>";
    	exit;  
	}
	if($_p['pwd2'] != $_p['pwd3'])
	{
		echo "<script>alert('�������벻��ͬ');history.back();</script>";
    	exit;  
	}
	$adm_info = get_one("select * from `admin` where `id` = {$id};");
	
	if($adm_info['password'] != $_p['pwd1'])
	{
		echo "<script>alert('��ǰ���벻��ȷ');history.back();</script>";
    	exit;  
	}
	
	$sql = "update `admin` set 
			`password` = '{$_p['pwd3']}'
			 where `id` = {$id};";
	mysql_query($sql); 
	
	unset($_SESSION['admin_login']);
	unset($_SESSION['admin_name']);
	unset($_SESSION['admin_id']);
	
	echo "<script>alert('�޸ĳɹ�,������µ�¼!');top.location='login.php';</script>";
	exit;
}




// ע���Ա
if($_act == 'user.add')
{
	if($_p['passport'] == '')
	{
		echo "<script>alert('����д �ʺ�');history.back();</script>";
    	exit;  
	}
	if($_p['upload'] == '')
	{
		echo "<script>alert('���ϴ� ͷ��');history.back();</script>";
    	exit;  
	}
	if($_p['pwd1'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	if($_p['pwd1'] != $_p['pwd2'])
	{
		echo "<script>alert('�������벻��ͬ');history.back();</script>";
    	exit;  
	}
	if($_p['sex'] == '')
	{
		echo "<script>alert('��ѡ�� �Ա�');history.back();</script>";
    	exit;  
	}
	// if($_p['btd'] == '')
	// {
	// 	echo "<script>alert('����д ����');history.back();</script>";
    // 	exit;  
	// }
	// if($_p['qq'] == '')
	// {
	// 	echo "<script>alert('����д qq');history.back();</script>";
    // 	exit;  
	// }
	// if($_p['addr'] == '')
	// {
	// 	echo "<script>alert('����д ��ַ');history.back();</script>";
    // 	exit;  
	// }
	$sql = "insert into `users` (`passport`, `password`, `sex`,`birthday`,`qq`,`addr`,`reg_time`, `avatar`) values 
	(
		'{$_p['passport']}',
		'{$_p['pwd2']}',
		'{$_p['sex']}',
		'{$_p['btd']}',
		'{$_p['qq']}',
		'{$_p['addr']}',
		'{$_now}',
		'{$_p['upload']}'
		);";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='../index.php';</script>";
	exit;
}

// �༭��Ա
if($_act == 'user.edit')
{
	if($_p['passport'] == '')
	{
		echo "<script>alert('����д �ʺ�');history.back();</script>";
    	exit;  
	}
	if($_p['upload'] == '')
	{
		echo "<script>alert('���ϴ� ͷ��');history.back();</script>";
    	exit;  
	}
	if($_p['sex'] == '')
	{
		echo "<script>alert('��ѡ�� �Ա�');history.back();</script>";
    	exit;  
	}
	if($_p['btd'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	if($_p['qq'] == '')
	{
		echo "<script>alert('����д qq');history.back();</script>";
    	exit;  
	}
	if($_p['addr'] == '')
	{
		echo "<script>alert('����д ��ַ');history.back();</script>";
    	exit;  
	}
	
	$sql = "update `users` set 
		`passport` = '{$_p['passport']}',
		`sex` = '{$_p['sex']}',
		`birthday` = '{$_p['btd']}',
		`qq` = '{$_p['qq']}',
		`addr` = '{$_p['addr']}',
		`avatar` = '{$_p['upload']}'
	where id = {$_s['user_id']}	
	";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='../user_info.php';</script>";
	exit;
}




// ��Ա��¼
if($_act == 'user.login')
{
	if($_p['passport'] == '')
	{
		echo "<script>alert('����д�ʺ�');history.back();</script>";
    	exit;  
	}
	if($_p['pwd1'] == '')
	{
		echo "<script>alert('����д����');history.back();</script>";
    	exit;  
	}
	
	$user = get_one("select * from users where passport = '{$_p['passport']}' and password = '{$_p['pwd1']}'");
	
	if(! $user)
	{
		echo "<script>alert('�ʺ����벻��ȷ');history.back();</script>";
    	exit;  
	}
	
	$_SESSION['user_login'] = true;
	$_SESSION['user_name']  = $user['passport'];
	$_SESSION['user_id']    = $user['id'];

	echo "<script>alert('��¼�ɹ�');window.history.go(-2);</script>";
	exit;
	// echo "<script>alert('��¼�ɹ�');window.location.href='../user_info.php'</script>";
	
}




// ����
if($_act == 'books.add')
{
	if($_p['cont'] == '')
	{
		echo "<script>alert('����д ��������');history.back();</script>";
    	exit;  
	}
	
	$sql = "insert into `books` (`conts`, `post_time`, `reply`,`reply_time`,`user_id`) values 
	(
		'{$_p['cont']}',
		'{$_now}',
		'',
		'',
		'{$_s['user_id']}'
	);";
	// echo $sql;
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!(���������Ѿ��ϴ���������Ա�ظ��󼴿���ʾ)');location='../books.php';</script>";
	exit;
}

// �޸Ļ�Ա����
if($_act == 'user.reset_pwd')
{
	$id = intval($_s['user_id']);
	if($_p['pwd1'] == '')
	{
		echo "<script>alert('����д ��ǰ����');history.back();</script>";
    	exit;  
	}
	if($_p['pwd2'] == '')
	{
		echo "<script>alert('����д ������');history.back();</script>";
    	exit;  
	}
	if($_p['pwd2'] != $_p['pwd3'])
	{
		echo "<script>alert('�������벻��ͬ');history.back();</script>";
    	exit;  
	}
	$user_info = get_one("select * from `users` where `id` = {$id};");
	
	if($user_info['password'] != $_p['pwd1'])
	{
		echo "<script>alert('��ǰ���벻��ȷ');history.back();</script>";
    	exit;  
	}
	
	$sql = "update `users` set 
			`password` = '{$_p['pwd3']}'
			 where `id` = {$id};";
	mysql_query($sql); 
	
	unset($_SESSION['user_login']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_id']);
	
	echo "<script>alert('�޸ĳɹ�,������µ�¼!');location='../login.php';</script>";
	exit;
}


// ��������
if($_act == 'posts.add')
{
	if(! isset($_s['user_login']))
	{
		echo "<script>alert('���ȵ�½');location='../login.php';</script>";
    	exit;  
	}
	
	if($_p['title'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	
	if($_p['conts'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	
	$sql = "insert into `posts` (`title`, `conts`, `post_time`,`user_id`,`cat_id`) values 
	(
		'{$_p['title']}',
		'{$_p['conts']}',
		'{$_now}',
		'{$_s['user_id']}',
		'{$_p['cat_id']}'
	);";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!(���������Ѿ��ɹ��ϴ���������Ա��˺󼴿���ʾ)');location='../cat.php?id=".$_p['cat_id']."';</script>";
	exit;
}


// �ظ�����
if($_act == 'comm.add')
{
	if(! isset($_s['user_login']))
	{
		echo "<script>alert('���ȵ�½');location='../login.php';</script>";
    	exit;  
	}
	
	if($_p['conts'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	
	$sql = "insert into `comm` (`post_id`, `user_id`, `conts`,`post_time`) values 
	(
		'{$_p['post_id']}',
		'{$_s['user_id']}',
		'{$_p['conts']}',
		'{$_now}'
	);";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='../posts.php?id=".$_p['post_id']."';</script>";
	exit;
}

// ���ʻ�
if($_act == 'flower')
{
	if(! isset($_s['user_login']))
	{
		echo "<script>alert('���ȵ�½');location='../login.php';</script>";
    	exit;  
	}
	if(! isset($_g['tuser_id']) or ! isset($_g['post_id']))
	{
		echo "<script>alert('ȱ�ٲ���');history.back();</script>";
    	exit;  
	}
	if($_s['user_id'] == $_g['tuser_id'])
	{
		echo "<script>alert('���ܸ��Լ��ͻ�');location='../posts.php?id=".$_g['post_id']."';</script>";
    	exit;  
	}
	$sql = "insert into `flower` (`f_user`,`t_user`,`add_time`) values 
	('{$_s['user_id']}','{$_g['tuser_id']}','{$_now}')";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='../posts.php?id=".$_g['post_id']."';</script>";
	exit;
}

// �Ӻ���
if($_act == 'friend')
{
	if(! isset($_s['user_login']))
	{
		echo "<script>alert('���ȵ�½');location='../login.php';</script>";
    	exit;  
	}
	if(! isset($_g['tuser_id']) or ! isset($_g['post_id']))
	{
		echo "<script>alert('ȱ�ٲ���');history.back();</script>";
    	exit;  
	}
	if($_s['user_id'] == $_g['tuser_id'])
	{
		echo "<script>alert('���ܼ��Լ�Ϊ����');location='../posts.php?id=".$_g['post_id']."';</script>";
    	exit;  
	}
	$sql = "insert into `friends` (`f_user`,`t_user`,`conf`) values 
	('{$_s['user_id']}','{$_g['tuser_id']}',0)";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='../posts.php?id=".$_g['post_id']."';</script>";
	exit;
}


// ɾ������
if($_act == 'posts.del')
{
	$id = intval($_g['id']);
	
	$sql = "delete from `posts` where id = {$id};";
	mysql_query($sql); 
	$sql = "delete from `comm` where post_id = {$id};";
	mysql_query($sql); 
	echo "<script>alert('ɾ���ɹ�,�������!');location='zt_list.php';</script>";
	exit;
}


// ɾ���ظ�
if($_act == 'comm.del')
{
	$id = intval($_g['id']);
	
	$sql = "delete from `comm` where id = {$id};";
	mysql_query($sql); 
	echo "<script>alert('ɾ���ɹ�,�������!');location='hf_list.php';</script>";
	exit;
}

// ɾ������
if($_act == 'friend.del')
{
	$id = intval($_g['tuser_id']);
	$sql = "delete from `friends` where f_user = {$_s['user_id']} and t_user = {$id};";
	mysql_query($sql); 
	echo "<script>alert('ɾ���ɹ�,�������!');location='../user_friend.php';</script>";
	exit;
}



// �ظ�����
if($_act == 'msg.add')
{
	if(! isset($_s['user_login']))
	{
		echo "<script>alert('���ȵ�½');location='../login.php';</script>";
    	exit;  
	}
	
	if($_p['conts'] == '')
	{
		echo "<script>alert('����д ����');history.back();</script>";
    	exit;  
	}
	
	if($_s['user_id'] == $_p['tuser_id'])
	{
		echo "<script>alert('���ܸ��Լ�����Ϣ');location='../user_msg.php?tuser_id=".$_p['tuser_id']."';</script>";
    	exit;  
	}
	
	$sql = "insert into `msg` (`f_user`, `t_user`, `conts`,`post_time`) values 
	(
		'{$_s['user_id']}',
		'{$_p['tuser_id']}',
		'{$_p['conts']}',
		'{$_now}'
	);";
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='../user_msg.php?tuser_id=".$_p['tuser_id']."';</script>";
	exit;
}

// �������
if ($_act == 'posts.confirm') {
	$sql = "update posts set status = 1 where id = ".$_GET['id'];
	mysql_query($sql); 
	echo "<script>alert('�ɹ�,�����ת!');location='zt_list.php';</script>";
}

// ɾ������
if ($_act == 'books.del') {
	$sql = "delete from books where id = ".$_GET['id'];
	mysql_query($sql);
	echo "<script>alert('�ɹ�,�����ת!');location='books_list.php';</script>";
}