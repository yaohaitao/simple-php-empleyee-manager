<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午9:35
 */

use Model\Employee;
use Model\Position;
use Model\Affiliation;
use Fuel\Core\Input;
use Fuel\Core\View;
use Fuel\Core\Response;

class Controller_Guide extends \Fuel\Core\Controller
{
    private static $path = 'index.php/guide/';

    public function action_index() {
        // 声明数组
        $data = array();
        // 查询全部员工，将查询结果转为数组格式，然后赋值给数组
        $data['employees'] = Employee::list_employee()->as_array();
        // 将页面跳转至 views/search.php，同时将数据带过去
        return View::forge('search', $data);
    }

    public function action_search()
    {
        // 声明数组
        $data = array();
        // 从页面获取条件 condition
        $condition = Input::get('condition');
        // 判断页面有没传来 condition，传来的话那就搜索
        if (! is_null($condition)) {
            // 按照条件查询员工，将查询结果转为数组格式，然后赋值给数组
            $data['employees'] = Employee::search_employee($condition)->as_array();
            // 将查询的条件赋值给数组
            $data['condition'] = $condition;
            // 将页面跳转至 views/search.php，同时将数据带过去
            return View::forge('search', $data);
        }
        // 没有传来条件的话，重定向至 guide/index 页面
        Response::redirect('index.php/guide/index');
    }

    public function action_delete()
    {
        // 从页面获取要删除的员工 ID
        $employee_id = Input::get('employee_id');
        // 如果指定了员工 ID 就删除员工
        if (! empty($employee_id)) {
            $result = Employee::delete_employee($employee_id);
        }
        // 如果没有指定，重定向至 guide/index 页面
        Response::redirect('index.php/guide/index');
    }

    public function action_update_page(){
        //第一步，获取id
        $employee_id =Input::get('employee_id');
        /* 第二步获取信息现在分两种情况，第一种是从 index 直接点编辑进来，这个时候只会传来 employee_id，
           第二种是通过 update_confirm 这个页面的重新编辑这个按钮进来，这个时候除了 employee_id，
           还有 name，kana 等信息。
        */
        $position_id = Input::get('position_id');
        $affiliation_id = Input::get('affiliation_id');
        $name = Input::get('name');
        $kana = Input::get('kana');
        // 判断是否可以从页面取到 name 这些值，如果取到，说明就是上述第二种情况
        if (!empty($name) && !empty($kana) && !empty($position_id) && !empty($affiliation_id)) {
            $employees = array(array(
                'employee_id' => $employee_id,
                'position_id' => $position_id,
                'affiliation_id' => $affiliation_id,
                'name' => $name,
                'kana' => $kana,
            ));
        }
        // 如果取不到则是第一种情况
        else {
            $employees = Employee::get_employee($employee_id);
        }
        // 获取职位列表
        $positions = \Model\Position::list_positions()->as_array();
        // 获取隶属列表
        $affiliations = \Model\Affiliation::list_affiliation()->as_array();
        //第三步，把信息整合到数组
        $data = array();
        $data['employees'] = $employees;
        $data['positions'] = $positions;
        $data['affiliations'] = $affiliations;
        //第四部，把信息带到更新确认页面
        return View::forge('update', $data);
    }

    public function action_update_confirm() {
        // 获取表单用 get 方式提交上来的员工信息
        $employee_id = Input::get('employee_id');
        $position_id = Input::get('position_id');
        $affiliation_id = Input::get('affiliation_id');
        $name = Input::get('name');
        $kana = Input::get('kana');
        $affiliation = Affiliation::get_affiliation($affiliation_id)[0]['affiliation'];
        $position = Position::get_position($position_id)[0]['position'];
        // 将员工信息封装至名叫 $employee_props 的数组中
        $employee_props = array(
            'employee_id' => $employee_id,
            'position_id' => $position_id,
            'position' => $position,
            'affiliation_id' => $affiliation_id,
            'affiliation' => $affiliation,
            'name' => $name,
            'kana' => $kana,
        );
        // 将页面跳到 views/insert_confirm.php，并将数据带过去
        return View::forge('update_confirm', $employee_props);

    }

    public function action_update() {
        // 获取表单用 get 方式提交上来的员工信息
        $employee_id = Input::get('employee_id');
        $position_id = Input::get('position_id');
        $affiliation_id = Input::get('affiliation_id');
        $name = Input::get('name');
        $kana = Input::get('kana');
        // 将员工信息封装至名叫 $employee_props 的数组中
        $employee_props = array(
            'employee_id' => $employee_id,
            'position_id' => $position_id,
            'affiliation_id' => $affiliation_id,
            'name' => $name,
            'kana' => $kana,
        );
        // 将员工信息插入数据库表，并把返回的结果赋值给 $result，该结果表示更新条数
        $result = Employee::update_employee($employee_props);
        // 更新完成后跳到更新完成页面
        $employee = Employee::get_employee($employee_id)->as_array()[0];
        return View::forge('update_complete',$employee);
    }

    
    public function action_regist(){
    	
    	$mark = Input::get('mark');
    	
    	// 声明数组
    	$data = array();
    	// 获取职位列表
    	$positions = \Model\Position::list_positions()->as_array();
    	// 获取隶属列表
    	$affiliations = \Model\Affiliation::list_affiliation()->as_array();
    	// 将获取的数据放入 $data
    	$data['positions'] = $positions;
    	$data['affiliations'] = $affiliations;
    	
    	if ($mark == 'insert') {
    		
    		$data['position_id'] = Input::get('position_id');
    		$data['affiliation_id'] = Input::get('affiliation_id');
    		$data['name'] = Input::get('name');
    		$data['kana'] = Input::get('kana');
    		
    		$data['title'] = '增加';
//     		$data['action'] = 'insert_confirm';
//     		$data['hidden'] = '';
    		$data['position_condition'] = !empty(Input::get('position_id'));
    		$data['affiliation_condition'] = !empty(Input::get('affiliation_id'));
    		
    		return View::forge('regist', $data);
    	} else if ($mark == 'update') {
    		
    		 //第一步，获取id
	        $employee_id =Input::get('employee_id');
	        /* 第二步获取信息现在分两种情况，第一种是从 index 直接点编辑进来，这个时候只会传来 employee_id，
	           第二种是通过 update_confirm 这个页面的重新编辑这个按钮进来，这个时候除了 employee_id，
	           还有 name，kana 等信息。
	        */
	        $position_id = Input::get('position_id');
	        $affiliation_id = Input::get('affiliation_id');
	        $name = Input::get('name');
	        $kana = Input::get('kana');
	        // 判断是否可以从页面取到 name 这些值，如果取到，说明就是上述第二种情况
	        if (!empty($name) && !empty($kana) && !empty($position_id) && !empty($affiliation_id)) {
	        	$data['employee_id'] = $employee_id;
	        	$data['position_id'] = $position_id;
	        	$data['affiliation_id'] = $affiliation_id;
	        	$data['name'] = $name;
	        	$data['kana'] = $kana;
	        }
	        // 如果取不到则是第一种情况
	        else {
	            $employees = Employee::get_employee($employee_id);
	            $data['employee_id'] = $employees[0]['employee_id'];
	            $data['position_id'] = $employees[0]['position_id'];
	            $data['affiliation_id'] = $employees[0]['affiliation_id'];
	            $data['name'] = $employees[0]['name'];
	            $data['kana'] = $employees[0]['kana'];
	        }
	        
	        
	        $data['title'] = '编辑';
// 	        $data['action'] = 'update_confirm';
// 	        $data['hidden'] = '<input type="hidden" name="employee_id" value="'. $employee_id .'">';
	        $data['position_condition'] = true;
	        $data['affiliation_condition'] = true;
	        
	        
	        return View::forge('regist', $data);
    	}
    }
    
    public function action_confirm() {

    	$mark = Input::get('mark');
    	$position_id = Input::get('position_id');
    	$affiliation_id = Input::get('affiliation_id');
    	$name = Input::get('name');
    	$kana = Input::get('kana');
    	$affiliation = Affiliation::get_affiliation($affiliation_id)[0]['affiliation'];
    	$position = Position::get_position($position_id)[0]['position'];
    	// 将员工信息封装至名叫 $employee_props 的数组中
    	$data = array(
    			'position_id' => $position_id,
    			'position' => $position,
    			'affiliation_id' => $affiliation_id,
    			'affiliation' => $affiliation,
    			'name' => $name,
    			'kana' => $kana,
    	);


    	if ($mark == 'update') {
    		$employee_id = Input::get('employee_id');
    		$data['employee_id'] = Input::get('employee_id');
    		$data['data'] = 'mark=update&employee_id=' . $employee_id . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id;
    	} else if ($mark == 'insert') {
    		$data['data'] = 'mark=insert' . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id;
    	}
    	
    	return View::forge('confirm', $data);
    	
    }
    
    public function action_done() {
    	
    	$mark = Input::get('mark');
    	// 获取表单用 get 方式提交上来的员工信息
    	$position_id = Input::get('position_id');
    	$affiliation_id = Input::get('affiliation_id');
    	$name = Input::get('name');
    	$kana = Input::get('kana');
    	// 将员工信息封装至名叫 $employee_props 的数组中
    	$employee_props = array(
    			'position_id' => $position_id,
    			'affiliation_id' => $affiliation_id,
    			'name' => $name,
    			'kana' => $kana,
    	);
    	
    	if ($mark == 'update') {
    		$employee_id = Input::get('employee_id');
    		$employee_props['employee_id'] = $employee_id;
    		$result = Employee::update_employee($employee_props);
    		$employee = Employee::get_employee($employee_id)->as_array()[0];
    		$employee['mark'] = 'update';
    	} else if ($mark == 'insert') {
    		$result = Employee::insert_employee($employee_props);
    		$employee = Employee::get_employee($result[0])->as_array()[0];
    		$employee['mark'] = 'insert';
    	}
    	
    	return View::forge('complete',$employee);
    }
    
    public function action_insert_page() {
        // 声明数组
        $data = array();
        // 获取职位列表
        $positions = \Model\Position::list_positions()->as_array();
        // 获取隶属列表
        $affiliations = \Model\Affiliation::list_affiliation()->as_array();
        // 将获取的数据放入 $data
        $data['positions'] = $positions;
        $data['affiliations'] = $affiliations;
        // 如果是从确认页面跳过来的，则会带着 name、kana 等数据
        // 获取表单用 get 方式提交上来的员工信息
        $data['position_id'] = Input::get('position_id');
        $data['affiliation_id'] = Input::get('affiliation_id');
        $data['name'] = Input::get('name');
        $data['kana'] = Input::get('kana');
        // 将页面跳到 views/insert.php，并将数据带过去
        return View::forge('insert', $data);
    }

    public function action_insert_confirm() {
        // 获取表单用 get 方式提交上来的员工信息
        $position_id = Input::get('position_id');
        $affiliation_id = Input::get('affiliation_id');
        $name = Input::get('name');
        $kana = Input::get('kana');
        $affiliation = Affiliation::get_affiliation($affiliation_id)[0]['affiliation'];
        // Array => 记录1 记录2 记录3   记录1 => position_id position
        $position = Position::get_position($position_id)[0]['position'];
        // 将员工信息封装至名叫 $employee_props 的数组中
        $employee_props = array(
            'position_id' => $position_id,
            'position' => $position,
            'affiliation_id' => $affiliation_id,
            'affiliation' => $affiliation,
            'name' => $name,
            'kana' => $kana,
        );
        // 将页面跳到 views/insert_confirm.php，并将数据带过去
        return View::forge('insert_confirm', $employee_props);

    }

    public function action_insert() {
        // 获取表单用 get 方式提交上来的员工信息
        $position_id = Input::get('position_id');
        $affiliation_id = Input::get('affiliation_id');
        $name = Input::get('name');
        $kana = Input::get('kana');
        // 将员工信息封装至名叫 $employee_props 的数组中
        $employee_props = array(
            'position_id' => $position_id,
            'affiliation_id' => $affiliation_id,
            'name' => $name,
            'kana' => $kana,
        );
        // 将员工信息插入数据库表，并把返回的结果赋值给 $result
        $result = Employee::insert_employee($employee_props);
        // $result是个数组，$result[0] 是插入的员工的主键，$result[1] 是插入的数量，
        // 在文档中可以找到详细介绍，如果结果为 0 ，肯定没插入成功
        if ($result[1] == 0) {
            // 如果插入失败，跳到插入页面
            Response::redirect("index.php/guide/insert_page");
        }
        // 如果插入成功，通过上面 result 返回的主键，查询相关的信息，然后跳到添加完成页面
        $employee = Employee::get_employee($result[0])->as_array()[0];
        return View::forge('insert_complete',$employee);
    }
}