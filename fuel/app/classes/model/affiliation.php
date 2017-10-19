<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/17
 * Time: 上午12:08
 */

namespace Model;

use Fuel\Core\DB;
use Fuel\Core\Model;

class Affiliation extends Model {

    /**
     * 列出所有的 Affiliation
     */
    public static function list_affiliation() {
        return DB::query('SELECT * FROM t_affiliation')->execute();
    }

    public static function get_affiliation($affiliation_id) {
        return DB::query("SELECT *
                        FROM t_affiliation
                        WHERE affiliation_id = $affiliation_id")
            ->execute();
    }
}