<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加确认</title>
</head>
<body>

<p>新社员信息确认：</p>

<p>姓名：<?php print $name ?></p>

<p>仮名：<?php print $kana ?> </p>

<p>职位：<?php print $position ?></p>

<p>隶属：<?php print $affiliation ?></p>

<button onclick="location.href='insert_page?<?php print 'mark=insert&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id?>'">修改</button>

<button onclick="location.href='insert?<?php print 'name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id?>'">确认添加</button>


</body>