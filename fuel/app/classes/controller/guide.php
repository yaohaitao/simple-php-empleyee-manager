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
        //第二步，用id去查找对应员工的所有的信息
        $employees = Employee::get_employee($employee_id);
        // 获取职位列表
        $positions = \Model\Position::list_positions()->as_array();
        // 获取隶属列表
        $affiliations = \Model\Affiliation::list_affiliation()->as_array();
        //第三步，把信息整合到数组
        $data = array();
        $data['employees'] = $employees;
        $data['positions'] = $positions;
        $data['affiliations'] = $affiliations;
        //第四部，把信息带到更新页面
        return View::forge('update', $data);
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
        // 更新完成后跳到主页
        Response::redirect("index.php/guide/index");
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
        $data['positions_id'] = Input::get('position_id');
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
        // 如果插入成功，跳到主页
        Response::redirect("index.php/guide/index");
    }
}