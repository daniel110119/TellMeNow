<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php if(is_array($list)): foreach($list as $key=>$v): ?><h3><?php echo ($v["content"]); ?></h3><?php endforeach; endif; ?>
	<?php echo ($page); ?>
</body>
</html>