<?php
	mysql_connect('localhost', 'root','');
	mysql_select_db('db_application');
	mysql_query('set names utf8');
	//print_r($argv);exit();
	$qry = mysql_query("SELECT count(0) as total FROM `tb_application` WHERE `discription` LIKE '%$argv[1]%'");
	$i = rand();
	$row = mysql_fetch_assoc($qry);
	$created_time = time();
    mysql_query("INSERT INTO `tb_sex_keyword` (`keyword`, `weight`, `total`, `created_time`, `status`) VALUES ('{$argv[1]}', {$i}, {$row[total]}, {$created_time}, 'published')");
	mysql_close();
