<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 下午11:36
 */

namespace Model;

use Fuel\Core\DB;
use Fuel\Core\Model;

class Position extends Model {

    /**
     * 列出所有的职位
     */
    public static function list_positions() {
        return DB::query('SELECT * FROM t_position')->execute();
    }

}