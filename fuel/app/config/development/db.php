<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
        'type'          =>  'mysqli',
		'connection'    =>  array(
			'hostname'	=>	'localhost',
			'port'		=>	'3306',
			'database'	=>	'employee_manager',
			'username'	=>	'root',
			'password'	=>	'',
		),
	),
);
