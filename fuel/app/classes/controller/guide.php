<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午9:35
 */

use Model\Employee;
use Fuel\Core\Input;
use Fuel\Core\View;
use Fuel\Core\Response;

class Controller_Guide extends \Fuel\Core\Controller
{
    private static $path = 'index.php/guide/';

    public function action_index() {

        $data = array();

//         $code = Input::get('code');
        
        $data['message'] = Input::get('message');
        
        // 显示全部员工
        $data['employees'] = Employee::list_employee()->as_array();
//         if(count($data['employees'])!=0){
//         	$data['message']="";
  
//         }        
//         if (count($data['employees']) == 0) {
//         	$data['message']['code'] = 0;
//         	$data['message']['message'] = $data['message']['message'].' 查询到 0 个员工！';
//         }
	
        
        return View::forge('search', $data);
    }


    // 该方法的访问地址：localhost/FuelPHP/public/index.php/guide/search
    public function action_search()
    {

        $data = array();

        // 从页面获取 condition
        $condition = Input::get('condition');
        // 判断页面有没传来 condition，传来的话那就搜索
        if (!is_null($condition)) {
            $data['employees'] = Employee::search_employee($condition)->as_array();
            $data['condition'] = $condition;
            return View::forge('search', $data);
        }
        // 没有传来的话显示错误
        // $data['error_message'] = '请输入搜索条件！';
        Response::redirect(self::$path . 'index');
        // return View::forge('search', $data);
    }

    public function action_update_page(){
		//第一步，获取id
		$employee_id =Input::get('employee_id');
		//第二步，用id去查找对应员工的所有的信息
        $employees = Employee::get_employee($employee_id)->as_array();
        // 获取职位列表
        $positions = \Model\Position::list_positions()->as_array();
        // 获取隶属列表
        $affiliations = \Model\Affiliation::list_affiliation()->as_array();
		//第三步，把信息整合到数组
        $data['employees'] = $employees;
        $data['positions'] = $positions;
        $data['affiliations'] = $affiliations;
		//第四部，把信息带到更新页面
        return View::forge('update', $data);
    }
    
    
    public function action_delete()
    {

        // 从页面获取要删除的员工 ID
        $employee_id = Input::get('employee_id');
        // 如果指定了员工 ID 就删除员工
        if (!empty($employee_id)) {
            $result = Employee::delete_employee($employee_id);
            // 上面的方法会返回删除条数，如果删除条数为 0，就说明删除失败了
//             if ($result == 0) {
                // $data['error_message'] = "删除失败！";
                // return View::forge('search', $data);
//                 Response::redirect(self::$path . 'index');
//             }
            // 如果返回的删除条数不为 0，就说明删除成功
            // $data['message'] = "删除成功！员工ID：$employee_id";
            // return View::forge('search', $data);
//             Response::redirect(self::$path . "index");
        }
        // 没有从页面获取到员工，把错误信息返回
        // $data['error_message'] = "获取员工 ID 失败！";
        // return View::forge('search', $data);
        Response::redirect(self::$path . 'index');
    }

    public function action_insert_page() {

        $data = array();

        // 获取职位列表
        $positions = \Model\Position::list_positions()->as_array();
        // 获取隶属列表
        $affiliations = \Model\Affiliation::list_affiliation()->as_array();
        // 将获取的数据放入 $data，然后传到页面
        $data['positions'] = $positions;
        $data['affiliations'] = $affiliations;
//         $data['message'] = Input::get('message');
//         $data['name'] = Input::get('name');
//         $data['kana'] = Input::get('kana');

        return View::forge('insert', $data);
    }

    public function action_insert() {

        $position_id = Input::get('position_id');
        $affiliation_id = Input::get('affiliation_id');
        $name = Input::get('name');
        $kana = Input::get('kana');

        $employee_props = array(
            'position_id' => $position_id,
            'affiliation_id' => $affiliation_id,
            'name' => $name,
            'kana' => $kana,
        );

        $result = Employee::insert_employee($employee_props);

        // 如果结果为 0 ，肯定没插入成功
        if ($result[1] == 0) {
            Response::redirect(self::$path."insert_page");
        }

        Response::redirect(self::$path . "index");
    }
}