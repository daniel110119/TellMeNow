<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script></script>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><h5><?php echo ($v); ?></h5><?php endforeach; endif; ?>
</body>
</html>