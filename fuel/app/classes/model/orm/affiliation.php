<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 上午11:22
 */

class Model_Orm_Affiliation extends Orm\Model {

    protected static $_table_name = 't_affiliation';

    protected static $_primary_key = array('affiliation_id');

    protected static $_properties = array(
        'affiliation_id',
        'affiliation' => array (
            'data_type' => 'varchar',
            'validation' => array('required'),
        )
    ) ;

    /**
     * 列出所有的 Affiliation
     */
    public static function list_affiliation() {
        return self::find('all');
    }
}