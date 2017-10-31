<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>完成</title>
</head>
<body>

<p>完成！</p>

<p>姓名：<?php print $name ?></p>

<p>仮名：<?php print $kana ?> </p>

<p>职位：<?php print $position ?></p>

<p>隶属：<?php print $affiliation ?></p>

<button onclick="location.href='index'">社員情報一覧</button>

<?php 
	if ($mark == 'insert') {
?>
	<button onclick="location.href='regist?mark=insert'">继续添加</button>
<?php 
	}
?>


</body>