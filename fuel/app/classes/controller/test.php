<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午3:48
 */

class Controller_Test extends \Fuel\Core\Controller {

    public function action_list_position() {

        $data = array();
        $data['db_data'] = Model_Orm_Position::list_positions();
        /*
         * $data
         * key          value
         * da_data      list_positions
         */
        return \Fuel\Core\View::forge('test', $data);
    }


    public function action_list_affiliation() {

        $data = array();
        $data['db_data'] = Model_Orm_Affiliation::list_affiliation();

        return \Fuel\Core\View::forge('test', $data);
    }

}