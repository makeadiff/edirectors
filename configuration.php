<?php
//Configuration file for iFrame
$config = array(
	'site_title'	=> 'Directors',
	'db_database'	=> ($_SERVER['HTTP_HOST'] == 'makeadiff.in') ? 'makeadiff_madapp' : 'Project_Madapp',
) + $config_data;
$config['site_home'] = $config_data['site_home'] . 'apps/edirectors/';
