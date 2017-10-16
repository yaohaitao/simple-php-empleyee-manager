<?php

class Model_Position extends Orm\Model {
   
    // 设置表名
    protected static $_table_name = 't_position';
    // 设置表中的主键
    protected static $_primary_key = array('position_id');
    // 设置表中的字段
    protected static $_properties = array(
        'position_id', 
        'position' => array (
            // 对表中的字段进行详细的设置，可以省略
            // 数据库中的数据类型
            'data_type' => 'varchar',
            // 对数据的验证，此处为必须
            'validation' => array('required'),
            )
        ) ;

    /*
    // 对每次的查询结果都要附加的条件，可以省略
    protected static $_conditions = array(
        // 每次查询按照 id 降序排列
        'order_by' => array('position_id' => 'desc'),
        // 每次查询的 position_id 要大于 1000
        'where' => array(
            array('position_id', '>', 1000)
        ),
    );
    */
    /* 每次的查询结果需要忽略的字段，比如 password
    protected static $_to_array_exclude = array(
        'password'
    );
    */

    /**
     * 列出所有的职位
     */
    public static function list_positions() {
        return self::find('all');
    }
}

?>