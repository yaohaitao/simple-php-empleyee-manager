<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>检索</title>
    <style type="text/css">
        #searchInput {
            background-image: url('https://static.runoob.com/images/mix/searchicon.png'); /* 搜索按钮 */
            background-position: 10px 12px; /* 定位搜索按钮 */
            background-repeat: no-repeat; /* 不重复图片 */
            width: 70%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable tr {
            /* 表格添加边框 */
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header, #myTable tr:hover {
            /* 表头及鼠标移动过 tr 时添加背景 */
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<input type="text" id="searchInput" onkeyup="myFunction()" placeholder="搜索...">
<button>搜索</button>
<button>重置</button>
<button>添加</button>
<table id="myTable">
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
        foreach ($employees as $employee) {
            print '<tr>'.
                '<td>'.$employee['name'].'</td>>'.
                '<td>'.$employee['kana'].'</td>>'.
                '<td>'.$employee['position'].'</td>>'.
                '<td>'.$employee['affiliation'].'</td>>'.
                '<td>'.
                    '<button>修改</button>'.
                    '<button>删除</button>'.
                '</td>>'.
                '</tr>';
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

<?php
///**
// * Created by PhpStorm.
// * User: YaoHaitao
// * Date: 2017/10/16
// * Time: 下午2:01
// */
