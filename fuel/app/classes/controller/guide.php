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

        $code = Input::get('code');
        $message = Input::get('message');

        $data['message'] = array(
                'code' => $code,
                'message' => $message
        );

        // 显示全部员工
        $data['employees'] = Employee::list_employee()->as_array();
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
        Response::redirect(self::$path . 'index?code=0&message=请输入搜索条件');
        // return View::forge('search', $data);
    }

    public function action_delete()
    {


        // 从页面获取要删除的员工 ID
        $employee_id = Input::get('employee_id');
        // 如果指定了员工 ID 就删除员工
        if (!empty($employee_id)) {
            $result = Employee::delete_employee($employee_id);
            // 上面的方法会返回删除条数，如果删除条数为 0，就说明删除失败了
            if ($result == 0) {
                // $data['error_message'] = "删除失败！";
                // return View::forge('search', $data);
                Response::redirect(self::$path . 'index?code=0&message=删除失败！');
            }
            // 如果返回的删除条数不为 0，就说明删除成功
            // $data['message'] = "删除成功！员工ID：$employee_id";
            // return View::forge('search', $data);
            Response::redirect(self::$path . "index?code=1&message=删除成功！员工ID：{$employee_id} ！");
        }
        // 没有从页面获取到员工，把错误信息返回
        // $data['error_message'] = "获取员工 ID 失败！";
        // return View::forge('search', $data);
        Response::redirect(self::$path . 'index?code=0&message=获取员工 ID 失败！');
    }
}