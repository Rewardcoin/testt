<?php 
ob_start();
session_start(); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Powercn人员学历统计</title>
<style type="text/css">
<!--
body,td,th {
	font-family: 宋体;
	font-size: 9pt;
	color: #222;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
	line-height:20px;
}
a:link {
	color: #222;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #222;
}
a:hover {
	text-decoration: underline;
	color: #FF0000;
}
a:active {
	text-decoration: none;
	color: #999999;
}
-->
</style>
<script>
    function del(id){
		if(confirm("确定要删除吗？")){
			window.location='?id='+id;
			}
		}
</script>
<script language=javascript>
  function CheckPost()
 {

	if (myform.title.value.length<2)
	{
		alert("工号不能少于2个字符");
		myform.title.focus();
		return false;
	}
	if (myform.name.value=="")
	{
		alert("姓名不能为空");
		myform.name.focus();
		return false;
	}
	if (myform.content.value.length<10)
	{
		alert("内容不能少于10个字符");
		myform.content.focus();
		return false;
	}
 }
</script>
<?php 
if($_POST['submit5']){
if($_POST['pwd']=="123"){
$_SESSION['pwd']=$_POST['pwd'];
echo "<script language=javascript>alert('登陆成功！');window.location='index.php'</script>";
}
  }
?>
<?php
	if($_GET['tj'] == 'logout'){
	session_start(); //开启session
	session_destroy();  //注销session
	header("location:index.php"); //跳转到首页
	}
?>
<?php
if($_GET["id"]<>''){
$id = $_GET["id"];
$info = file_get_contents("info.txt");
$column = explode("@@@",$info); unset($column[$id]);
$noinfo = implode("@@@",$column);
    file_put_contents("info.txt",$noinfo);
	echo "<script language=javascript>alert('删除成功！');window.location='index.php'</script>";
}
?>
</head>
<body>
<form  name="myform" method="post" onSubmit="return CheckPost()" action="" style="margin-bottom:5px;">
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td height="25" align="center" bgcolor="#EBEBEB"><a href="index.php">查看留言</a>&nbsp;|&nbsp;<a href="index.php?tj=add">添加留言</a>&nbsp;|&nbsp;<a href="index.php?tj=login">留言管理</a>&nbsp;|&nbsp;<?php if($_SESSION['pwd']<>''){
echo "<a href='index.php?tj=logout'>退出管理</a>"; 
}?></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>

<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
<tr>
<th width="60" bgcolor="#EBEBEB">表情</th>
<th width="76" bgcolor="#EBEBEB">工号</th>
<th width="77" bgcolor="#EBEBEB">姓名</th>
<th width="133" bgcolor="#EBEBEB">是否可以寄出学历证书及寄出时间</th>
<th width="78" bgcolor="#EBEBEB">时间</th>
<?php if($_SESSION['pwd']<>''){
echo "<th width='59' bgcolor='#EBEBEB'>操作</th>";
}?>
</tr>
<?php
$info = file_get_contents("info.txt");
$info = rtrim($info,"@");
if(strlen($info)>10){
$column = explode("@@@",$info);
foreach($column as $keys=>$values){
$message = explode("%%",$values);
?>
<tr>
<td align="center" bgcolor="#FFFFFF"><img src="face/PIC<?php echo $message[2];?>.GIF" width="20" height="20" /></th>
<td align="center" bgcolor="#FFFFFF"><?php echo $message[0];?>
    </th>
</td>
<td align="center" bgcolor="#FFFFFF"><?php echo $message[1];?></th>
<td align="center" bgcolor="#FFFFFF"><?php echo $message[3];?></th>
<td align="center" bgcolor="#FFFFFF"><?php echo date("m/d H:i",$message[4]);?></th>
<?php if($_SESSION['pwd']<>''){
echo "<td align='center' bgcolor='#FFFFFF'>";
echo "<a href='javascript:del({$keys})'>删除</a>"; 
echo "</th>";
}?>
</tr>
<?php
	}
}
?>
</table>

<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>
<?php 
if($_GET["tj"] == add){
?>
<?php
if($_POST[submit]){
$title = $_POST["title"];
$name = $_POST["name"];
$face = $_POST["face"];
$content = $_POST["content"];
$addtime = time();
$insert = "{$title}%%{$name}%%{$face}%%{$content}%%{$addtime}@@@";
$content = file_get_contents("info.txt");
           file_put_contents("info.txt",$content.$insert);
		   echo "<script language=javascript>alert('留言成功！');window.location='index.php'</script>";
	}
?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="5"></td>
    </tr>
  </table>
  <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3" brder="1">
<tr>
    <td width="62" align="center" bgcolor="#FFFFFF">工号：</td>
    <td width="465" bgcolor="#FFFFFF"><input type="text" name="title"/>
      &nbsp;*</td>
</tr>
<tr>
     <td align="center" bgcolor="#FFFFFF">姓名：</td>
     <td bgcolor="#FFFFFF"><input name="name" type="text" id="name"/> 
       &nbsp;*</td>    
</tr>
<tr>
  <td align="center" bgcolor="#FFFFFF">表情：</td>
  <td bgcolor="#FFFFFF"><input type="radio" value="1" name="face" checked="checked" />
                            <img src="face/PIC1.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="2" name="face" />
                            <img src="face/PIC2.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="3" name="face" />
                            <img src="face/PIC3.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="4" name="face" />
                            <img src="face/PIC4.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="5" name="face" />
                            <img src="face/PIC5.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="6" name="face" />
                            <img src="face/PIC6.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="7" name="face" />
                            <img src="face/PIC7.GIF" width="20" height="20" border="0" /></td>
</tr>
<tr>
     <td align="center" bgcolor="#FFFFFF">内容（能否寄出、寄出时间）：</td>
     <td bgcolor="#FFFFFF"><textarea name="content" rows="5" cols="40"></textarea>
      &nbsp;不能少于10个字符</td>
</tr>
<tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF">
        <input name="submit" type="submit"value="提交" />&nbsp;&nbsp; 
        <input name="reset" type="reset"  value="重填"/>      </td>
    </tr>
</table>
</form>
<?php 
	}
?>
<?php if($_GET['tj'] == 'login'){ ?>
<form  name="form" method="post" action="" style=" margin-top:5px;">
 <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td colspan="3" align="center" bgcolor="#EBEBEB" class="font">后台管理页</td>
    </tr>
  <tr>
    <td width="89" align="center" bgcolor="#FFFFFF" class="font">管理密码:</td>
    <td colspan="2" bgcolor="#FFFFFF" class="font">
      <input name="pwd" type="text" id="pwd" size="16"/></td>
    </tr>
    <tr>
    <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF" class="font">
    <input type="submit" name="submit5" value="登录" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="reset"  value="重置" /></td>
    </tr>
</table>
 <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="5"></td>
   </tr>
 </table>
 <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
   <tr>
     <td bgcolor="#FFFFFF">最新版本提醒:<!--删除后将无法获得最新版本-->php无数据库文本留言本V0.02
      <script type="text/javascript" src="http://www.60ie.net/wap/txtlyb.js"></script></td>
   </tr>
 </table>
</form>
<?php } ?>
<table width="550" height="20" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td align="left" bgcolor="#FFFFFF">&nbsp;Copyright @2013 <a href="http://www.60ie.net/article/6/486.html" target="_blank">
      <!--本源码免费开源，保留版权信息你将获得本站免费技术支持和程序升级服务。-->
      60IE.NET</a> All Rights Reserved. Build V0.02</td>
  </tr>
</table>
</body>
</html>
