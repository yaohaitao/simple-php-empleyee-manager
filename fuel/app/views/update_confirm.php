<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑确认</title>
</head>
<body>

<p>编辑社员信息确认：</p>

<p>姓名：<?php print $name ?></p>

<p>仮名：<?php print $kana ?> </p>

<p>职位：<?php print $position ?></p>

<p>隶属：<?php print $affiliation ?></p>

<button onclick="location.href='update_page?<?php print 'employee_id=' . $employee_id . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id?>'">重新编辑</button>

<button onclick="location.href='update?<?php print 'employee_id=' . $employee_id . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id?>'">确认编辑</button>


</body>