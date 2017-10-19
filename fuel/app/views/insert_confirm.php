<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加确认</title>
</head>
<body>
<a style="margin-left: 45%" href="index">社員情報一覧</a>

<p>新社员信息确认：</p>

<p>姓名：<?php print $name ?></p>

<p>仮名：<?php print $kana ?> </p>

<p>职位：<?php print $position ?></p>

<p>隶属：<?php print $affiliation ?></p>

<button onclick="location.href='insert?<?php print 'name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id?>'">确认添加</button>

<button onclick="location.href='insert_page?<?php print 'name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id?>'">修改</button>

</body>