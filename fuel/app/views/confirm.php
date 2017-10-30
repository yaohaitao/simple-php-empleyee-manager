<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>确认</title>
</head>
<body>

<p>请确认：</p>

<p>姓名：<?php print $name ?></p>

<p>仮名：<?php print $kana ?> </p>

<p>职位：<?php print $position ?></p>

<p>隶属：<?php print $affiliation ?></p>

<?php 
// 'mark=update&employee_id=' . $employee_id . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id
// 'mark=update&employee_id=' . $employee_id . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id
?>
<button onclick="location.href='regist?<?php print $data ?>'">重新编辑</button>

<button onclick="location.href='done?<?php print $data ?>'">确认</button>


</body>