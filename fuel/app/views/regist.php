<?php
// 	if ($mark == 'insert') {
// 		$title = '增加';
// 		$action = 'insert_confirm';
// 		$hidden = '';
// 		$position_condition = ! empty($position_id);
// 		$affiliation_condition = ! empty($affiliation_id);
// 	} else if ($mark == 'update') {
// 		$title = '编辑';
// 		$action = 'update_confirm';
// 		$hidden = '<input type="hidden" name="employee_id" value="'. $employee_id .'">';
// 		$position_condition = true;
// 		$affiliation_condition = true;
// 	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php print $title; ?></title>
    <style type="text/css">
        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .show_error {
            color: red;
        }
    </style>
</head>
<body>
    <a style="margin-left: 45%" href="index">社員情報一覧</a>
    <div class="container">
        <form action="confirm" method="get">
        
            <label for="name">姓名</label>
            <input type="text" id="name" name="name" placeholder="请输入姓名.." required value="<?php if (! empty($name)) { print $name; } ?>">

            <label for="kana">仮名</label>
            <input type="text" id="kana" name="kana" placeholder="请输入假名.." required value="<?php if (! empty($kana)) { print $kana; } ?>">

            <label for="position">职位</label>
            <select id="position" name="position_id">
                <?php
                    if (! empty($positions)) {
                        foreach ($positions as $position) {
                            if ($position_condition && $position_id == $position['position_id']) {
                                print '<option selected="selected" value="' . $position['position_id'] . '">' . $position['position'] . '</option>';
                            } else {
                                print '<option value="' . $position['position_id'] . '">' . $position['position'] . '</option>';
                            }
                        }
                    }
                ?>
            </select>

            <label for="affiliation">隶属</label>
            <select id="affiliation" name="affiliation_id">
                <?php
                if (! empty($affiliations)) {
                    foreach ($affiliations as $affiliation) {
                        if ($affiliation_condition && $affiliation_id == $affiliation['affiliation_id']){
                            print '<option selected="selected" value="'. $affiliation['affiliation_id'] .'">'. $affiliation['affiliation'] .'</option>';
                        } else {
                            print '<option value="'. $affiliation['affiliation_id'] .'">'. $affiliation['affiliation'] .'</option>';
                        }
                    }
                }
                ?>
            </select>

            <?php 
            	if (!empty($employee_id)) {
            		print '<input type="hidden" name="employee_id" value="'. $employee_id .'">';
            		print '<input type="hidden" name="mark" value="update">';
            	} else {
            		print '<input type="hidden" name="mark" value="insert">';
            	}
            
            ?>
            
            <input type="submit" value="提交">
        </form>
    </div>
</body>