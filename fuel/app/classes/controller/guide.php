<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午9:35
 */

class Controller_Guide extends \Fuel\Core\Controller {

    public function action_seaerch() {
        return \Fuel\Core\View::forge('search');
    }
}