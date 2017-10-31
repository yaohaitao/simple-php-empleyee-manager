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

class Controller_Employee extends \Fuel\Core\Controller
{
    private static $path = 'index.php/guide/';

    public function action_index() {
        // 声明数组
        $data = array();
        // 查询全部员工，将查询结果转为数组格式，然后赋值给数组
        $data['employees'] = Employee::list_employee()->as_array();
        // 将页面跳转至 views/search.php，同时将数据带过去
        return View::forge('list', $data);
    }

    public function action_list()
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
            return View::forge('list', $data);
        }
        // 没有传来条件的话，重定向至 guide/index 页面
        Response::redirect('index.php/employee/index');
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
        Response::redirect('index.php/employee/index');
    }

    
    public function action_regist(){
    	
    	$mark = Input::param('mark');
    	
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
    		
    		$data['position_id'] = Input::param('position_id');
    		$data['affiliation_id'] = Input::param('affiliation_id');
    		$data['name'] = Input::param('name');
    		$data['kana'] = Input::param('kana');
    		
    		$data['title'] = '增加';
//     		$data['action'] = 'insert_confirm';
//     		$data['hidden'] = '';
    		$data['position_condition'] = !empty(Input::param('position_id'));
    		$data['affiliation_condition'] = !empty(Input::param('affiliation_id'));
    		
    		return View::forge('regist', $data);
    	} else if ($mark == 'update') {
    		
    		 //第一步，获取id
	        $employee_id =Input::param('employee_id');
	        /* 第二步获取信息现在分两种情况，第一种是从 index 直接点编辑进来，这个时候只会传来 employee_id，
	           第二种是通过 update_confirm 这个页面的重新编辑这个按钮进来，这个时候除了 employee_id，
	           还有 name，kana 等信息。
	        */
	        $position_id = Input::param('position_id');
	        $affiliation_id = Input::param('affiliation_id');
	        $name = Input::param('name');
	        $kana = Input::param('kana');
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

    	$mark = Input::post('mark');
    	$position_id = Input::post('position_id');
    	$affiliation_id = Input::post('affiliation_id');
    	$name = Input::post('name');
    	$kana = Input::post('kana');
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
    		$employee_id = Input::post('employee_id');
    		$data['employee_id'] = Input::post('employee_id');
    		$data['data'] = 'mark=update&employee_id=' . $employee_id . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id;
    	} else if ($mark == 'insert') {
    		$data['data'] = 'mark=insert' . '&name='. $name . '&kana=' . $kana . '&position_id=' . $position_id . '&affiliation_id=' . $affiliation_id;
    	}
    	
    	return View::forge('confirm', $data);
    	
    }
    
    public function action_done() {
    	
    	$mark = Input::post('mark');
    	// 获取表单用 get 方式提交上来的员工信息
    	$position_id = Input::post('position_id');
    	$affiliation_id = Input::post('affiliation_id');
    	$name = Input::post('name');
    	$kana = Input::post('kana');
    	// 将员工信息封装至名叫 $employee_props 的数组中
    	$employee_props = array(
    			'position_id' => $position_id,
    			'affiliation_id' => $affiliation_id,
    			'name' => $name,
    			'kana' => $kana,
    	);
    	
    	if ($mark == 'update') {
    		$employee_id = Input::post('employee_id');
    		$employee_props['employee_id'] = $employee_id;
    		$result = Employee::update_employee($employee_props);
    		$employee = Employee::get_employee($employee_id)->as_array()[0];
    		$employee['mark'] = 'update';
    	} else if ($mark == 'insert') {
    		$result = Employee::insert_employee($employee_props);
    		$employee = Employee::get_employee($result[0])->as_array()[0];
    		$employee['mark'] = 'insert';
    	}
    	
    	return View::forge('done',$employee);
    }
    
}