<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午12:14
 */

use Model\Employee;
use Fuel\Core\Input;

class Controller_Api_Employee extends \Fuel\Core\Controller_Rest {

    // 根据员工 ID 获取员工信息
    public function get_get_employee() {

        $employee_id = Input::get('employee_id');

        $employee = Employee::get_employee($employee_id);

        if (! empty($employee)) {
            return $this->response(array(
                'state' => 1,
                'message' => 'SUCCESS',
                'data' => $employee,
            ));
        }

        return $this->response(array(
            'state' => 0,
            'message' => 'Can not find the employee, please check the employee id.' ,
            'data' => $employee,
        ));
    }
    // 列出所有员工信息
    public function get_list_employee() {

        $employees = Employee::list_employee();

        if (! empty($employees)) {
            return $this->response(array(
                'state' => 1,
                'message' => 'SUCCESS',
                'data' => $employees,
            ));
        }

        return $this->response(array(
            'state' => 0,
            'message' => 'Can not find the employee, please check the employee id.' ,
            'data' => null,
        ));
    }
    // 根据条件查询员工
    public function get_search_employee() {

        $condition = Input::get('condition');

        $result = Employee::search_employee($condition);


        if (! empty($result)) {
            return $this->response(array(
                'state' => 1,
                'message' => 'SUCCESS',
                'data' => $result,
            ));
        }

        return $this->response(array(
            'state' => 0,
            'message' => 'Can not find any employee.' ,
            'data' => null,
        ));
    }
    // 插入员工
    public function get_insert_employee() {

        // position_id, affiliation_id, name, kana

        $employee_props = array(
            'position_id' => Input::get('position_id'),
            'affiliation_id' => Input::get('affiliation_id'),
            'name' => Input::get('name'),
            'kana' => Input::get('kana'),
        );

        $result = $this->check_props($employee_props);

        if (! empty($result)) {
            return $this->response(array(
                'state' => 0,
                'message' => "$result is necessary.",
                'data' => null,
            ));
        }

        $result = Employee::insert_employee($employee_props);

        if ($result[1] != 0) {
            return $this->response(array(
                'state' => 1,
                'message' => 'employee insert successfully.',
                'data' => null,
            ));
        }

        return $this->response(array(
            'state' => 0,
            'message' => 'employee insert failed.',
            'data' => null,
        ));

    }
    // 更新员工
    public function get_update_employee() {

        $employee_props = array(
            'employee_id' => Input::get('employee_id'),
            'position_id' => Input::get('position_id'),
            'affiliation_id' => Input::get('affiliation_id'),
            'name' => Input::get('name'),
            'kana' => Input::get('kana'),
        );

        if (empty($employee_props['employee_id'])) {
            return $this->response(array(
                'state' => 0,
                'message' => 'employee_id is necessary.',
                'data' => null,
            ));
        }

        $result = $this->check_props($employee_props);

        if (! empty($result)) {
            return $this->response(array(
                'state' => 0,
                'message' => "$result is necessary.",
                'data' => null,
            ));
        }

        $result = Employee::update_employee($employee_props);

        if ($result != 0) {
            return $this->response(array(
                'state' => 1,
                'message' => 'employee update successfully.',
                'data' => null,
            ));
        }

        return $this->response(array(
            'state' => 0,
            'message' => 'employee update failed.',
            'data' => null,
        ));

    }

    // 删除员工
    public function get_delete_employee() {

        $employee_id = Input::get('employee_id');

        $result = Employee::delete_emloyee($employee_id);

        if ($result != 0) {
            return $this->response(array(
                'state' => 1,
                'message' => "employee has been deleted.",
                'data' => null,
            ));
        }

        return $this->response(array(
            'state' => 0,
            'message' => 'Can not delete the employee, please check the employee id.',
            'data' => null,
        ));
    }




    // 检查员工的属性
    private function check_props($employee_props) {

        if (empty($employee_props['position_id'])) {
            return 'position_id';
        }

        if (empty($employee_props['affiliation_id'])) {
            return 'affiliation_id';
        }

        if (empty($employee_props['name'])) {
            return 'name';
        }

        if (empty($employee_props['kana'])) {
            return 'kana';
        }

        return null;
    }

}