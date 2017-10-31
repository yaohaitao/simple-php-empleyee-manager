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
<button onclick="regist();">重新编辑</button>

<button onclick="done();">确认</button>


	<form method="post">
            <input type="hidden" name="name" value="<?php print $name; ?>">
            <input type="hidden" name="kana" value="<?php print $kana; ?>">          
            <input type="hidden" name="position_id" value="<?php print $position_id; ?>">
            <input type="hidden" name="affiliation_id"   value="<?php print $affiliation_id; ?>">
            <?php 
            	if (!empty($employee_id)) {
            		print '<input type="hidden" name="employee_id" value="'. $employee_id .'">';
            		print '<input type="hidden" name="mark" value="update">';
            	} else {
            		print '<input type="hidden" name="mark" value="insert">';
            	}
            ?>
     </form>


<script type="text/javascript">

	function regist() {
		var form = document.forms[0];
		var actionPath = "regist";
		form.action = actionPath;
		form.submit();
	}

	function done() {
		var form = document.forms[0];
		var actionPath = "done";
		form.action = actionPath;
		form.submit();
	}
            
</script>
 
</body>