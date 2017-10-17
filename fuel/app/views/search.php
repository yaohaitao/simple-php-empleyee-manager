<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>检索</title>
    <style type="text/css">
        #search_input {
            background-image: url('https://static.runoob.com/images/mix/searchicon.png'); /* 搜索按钮 */
            background-position: 10px 12px; /* 定位搜索按钮 */
            background-repeat: no-repeat; /* 不重复图片 */
            width: 60%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #result_table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #result_table th, #result_table td {
            text-align: left;
            padding: 12px;
        }

        #result_table tr {
            /* 表格添加边框 */
            border-bottom: 1px solid #ddd;
        }

        #result_table tr.header, #result_table tr:hover {
            /* 表头及鼠标移动过 tr 时添加背景 */
            background-color: #f1f1f1;
        }

        .button {
            background-color: #e7e7e7;
            color: black;
            border: none;
            padding: 12px 28px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 12px;
            width: 10%;
        }

        .button:hover {
            background-color: #555555;
            color: white;
        }

        .update_button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 12px 28px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 12px;
            width: 30%;
        }

        .update_button:hover {
            background-color: white;
            color: black;
            border: 2px solid #008CBA;
        }

        .delete_button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 12px 28px;
            margin-left: 5%;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 12px;
            width: 30%;
        }

        .delete_button:hover {
            background-color: white;
            color: black;
            border: 2px solid #f44336;
        }

        .show_error {
            color: red;
        }

        .show_message {
            color: green;
        }

    </style>
</head>
<body>
<input type="text" id="search_input" placeholder="搜索..." value="<?php if (! empty($condition)){print $condition;} ?>">
<!-- 给搜索按钮添加功能：使用 onclick 属性，该属性的意思是点击后会发生什么，属性中值是 JavaScript 语句，意思是要进行页面跳转。-->
<button class="button" onclick="location.href='search?condition=' + document.getElementById('search_input').value;">搜索</button>
<button class="button" onclick="location.href='index';">重置</button>
<button class="button" onclick="location.href='insert_page';">添加</button>
<?php
    if (! empty($message)) {
        $code = $message['code'];
        $message = $message['message'];
        if ($code == 1) {
            print "<p class='show_message'>$message</p>";
        } else {
            print "<p class='show_error'>$message</p>";
        }
    }
?>
<table id="result_table">
    <tr class="header">
        <th style="width:15%;">姓名</th>
        <th style="width:15%;">假名</th>
        <th style="width:15%;">职位</th>
        <th style="width:15%;">所属</th>
        <th style="width:40%;">操作</th>
    </tr>
    <?php
    /*
     * $employees 这个变量是 Controller 传过来的，内容格式如下
     * Array
       (
            [0] => Array
                (
                    [employee_id] => 1
                    [position_id] => 1
                    [affiliation_id] => 1
                    [name] => 湿答答
                    [kana] => しだだ
                    [position] => 老大
                    [affiliation] => 1技
                )

            [1] => Array
                (
                    [employee_id] => 2
                    [position_id] => 2
                    [affiliation_id] => 2
                    [name] => 离战书
                    [kana] => りせんしょ
                    [position] => 老二
                    [affiliation] => 1技1科
                )

        )
    */
    if ( ! empty($employees)) {
        foreach ($employees as $employee) {
            $employee_id = $employee['employee_id'];
            print '<tr>'.
                '<td>'.$employee['name'].'</td>'.
                '<td>'.$employee['kana'].'</td>'.
                '<td>'.$employee['position'].'</td>'.
                '<td>'.$employee['affiliation'].'</td>'.
                '<td>'.
                '<button class="update_button">修改</button>'.
                "<button class='delete_button' onclick=\"location.href='delete?employee_id=$employee_id'\">删除</button>".
                '</td>'.
                '</tr>';
        }
    }
    ?>
    <!-- 静态的内容不要了，换为动态的
    <tr>
        <td>哈哈</td>
        <td>はは</td>
        <td>老大</td>
        <td>1技</td>
        <td>
            <button>修改</button>
            <button>删除</button>
        </td>
    </tr>
    -->
</table>
</body>
</html>

