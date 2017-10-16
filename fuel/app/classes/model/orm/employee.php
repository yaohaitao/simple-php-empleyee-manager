<?php
/**
 * Created by PhpStorm.
 * User: YaoHaitao
 * Date: 2017/10/16
 * Time: 上午11:36
 */

class Model_Orm_Employee extends \Orm\Model {

    protected static $_table_name = 't_employee';

    protected static $_primary_key = array('employee_id');

    protected static $_properties = array(
        'employee_id',
        'position_id' => array (
            'data_type' => 'int',
            'validation' => array('required'),
        ),
        'affiliation_id' => array (
            'data_type' => 'int',
            'validation' => array('required'),
        ),
        'name' => array (
            'data_type' => 'varchar',
            'validation' => array('required'),
        ),
        'kana' => array (
            'data_type' => 'varchar',
            'validation' => array('required'),
        ),
    ) ;
    // 表示 Employee 属于 Position 与 Affiliation，在一对多关系中，多的一方用 belongs_to
    protected static $_belongs_to = array(
        // 关联的对象
        'position' => array(
            // 对应本表的哪一个字段
            'key_from' => 'position_id',
            // 对应哪一个 Model
            'model_to' => 'Model_Orm_Position',
            // 对应隶属表的哪一个字段
            'key_to' => 'position_id',
            // 是否关联保存
            'cascade_save' => true,
            // 是否关联删除
            'cascade_delete' => false,
        ),
        'affiliation' => array(
            'key_from' => 'affiliation_id',
            'model_to' => 'Model_Orm_Affiliation',
            'key_to' => 'affiliation_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
    );

    /**
     * 根据 employee_id 查询员工所有信息
     * @param $employee_id
     * @return 查询结果
     */
    public static function get_employee($employee_id) {
        return self::find($employee_id, array('related' => array('position', 'affiliation')));
    }

    /**
     * 查询所有员工所有信息
     */
    public static function list_employee() {
        return self::find('all', array('related' => array('position', 'affiliation')));
    }

    /**
     * 根据输入条件查询员工
     * @param $condition
     * @return mixed
     */
    public static function search_employee($condition) {

        $condition = '%'.$condition.'%';

        $result = self::query()
            ->select('*')
            ->related('position')
            ->related('affiliation')
            ->where('employee_id', 'like', $condition)
            ->or_where('position.position', 'like', $condition)
            ->or_where('affiliation.affiliation', 'like', $condition)
            ->or_where('name', 'like', $condition)
            ->or_where('kana', 'like', $condition)
            ->get();

        return $result;
    }

    /**
     * 添加员工信息
     * @param $employee_props: position_id, affiliation_id, name, kana
     * @return bool 是否添加成功
     */
    public static function insert_employee($employee_props) {
        $new_employee = new Model_Orm_Employee($employee_props);
        return $new_employee->save();
    }

    /**
     * 更新员工信息
     * @param $employee_props: employee_id, position_id, affiliation_id, name, kana
     * @return bool 是否添加成功
     */
    public static function update_employee($employee_props) {
        $employee = self::find($employee_props['employee_id']);
        $employee->set($employee_props);
        return $employee->save();
    }

    /**
     * 删除员工信息
     */
    public static function delete_emloyee($employee_id) {
        $employee = self::find($employee_id);
        return $employee->delete();
    }
}