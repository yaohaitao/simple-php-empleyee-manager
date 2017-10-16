<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/14
 * Time: 下午2:57
 */

Class Controller_Api_Position extends \Fuel\Core\Controller_Rest {

    public function get_list_position() {

        $entry = Model_Position::find('all');

        return $this->response(array(
            'state' => 1,
            'message' => 'success',
            'data' => $entry,
        ));
    }

    public function post_list_position() {

        $entry = Model_Position::list_positions();

        return $this->response(array(
            'state' => 1,
            'message' => 'success',
            'data' => $entry,
        ));
    }
}