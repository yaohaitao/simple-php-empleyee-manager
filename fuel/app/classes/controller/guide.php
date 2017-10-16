<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午9:35
 */


class Controller_Guide extends \Fuel\Core\Controller {

    // 该方法的访问地址：localhost/FuelPHP/public/index.php/guide/search
    public function action_search() {

        $data = array();
//        $data['employees'] = Model_Orm_Employee::list_employee();
//        $data['positions'] = Model_Orm_Position::list_positions();
//        $data['positions'] = \Model\Position::list_positions();
//        $data2 = array();
//        $data2['positions'] = Model_Position::list_positions();
        // 把所有的 Model 改为 DB 实现
        $data['employees'] = \Model\Employee::list_employee()->as_array();

        return \Fuel\Core\View::forge('search',$data);
    }
}