<?php
$configure = array();

/*
The path in system that where phpHiveAdmin put, please do not change it.

phpHiveAdmin所在文件系统路径，自动获取，请不要修改。
*/
$configure['fs_root'] = __DIR__;

/*
Settting up where the metadata of Hive stored.
Support some usually database, like mysql, mysqli, postgresql, oracle...
Need compile the drivers with php first.
but not support Derby(Apache) access.

设置Hive存储元数据所使用的数据库
支持常用的数据库连接方式，例如mysql,mysqli,postgresql,oracle等等
需预先在php中编译该数据库的驱动
但是不支持Derby(Apache)访问
*/
$configure['meta_database_host'] = '127.0.0.1';
$configure['meta_database_port'] = '3306';
$configure['meta_database_user'] = 'root';
$configure['meta_database_pass'] = '';
$configure['meta_database_type'] = 'mysqli';
$configure['meta_database_name'] = 'easyhadoop';

/*
Setting up hiveserver thrift host and port,
and metastore thrift host and port, if needed.
Please see `hive --service -help` for more help

设置hiveserver的thrift主机IP和端口
如果需要的话，设置metastore访问的主机和端口
请查看 `hive --service -help`获取thrift帮助和metastore帮助
*/
$configure['hive_thrift_host'] = '127.0.0.1';
$configure['hive_thrift_port'] = '10000';
$configure['hive_metastore_host'] = '127.0.0.1';
$configure['hive_metastore_port'] = '9083';

/*
Setting up languages you need in phpHiveAdmin user interface,
now support chinese or english

设置phpHiveAdmin用户界面所使用的语言
目前支持中文(chinese)和英文(english)
*/
$configure['language'] = 'chinese';

/*
Setting up the system environment that used by phpHiveAdmin

设置phpHiveAdmin所使用的系统环境变量
*/
$configure['hadoop_home'] = '/usr';
$configure['java_home'] = '/usr/java/default';
$configure['hive_home'] = '/usr/local/hive';

$configure['lang_set'] = 'zh_CN.UTF-8' ;
//Or en_US.UTF-8, if you are in english countries.
//如果你处在英语国家，请使用en_US.UTF-8

$configure['output_seperator'] = '\t'; 
// The result data columns seperating character.
// 用来分隔结果集数据列的分隔符.

/*
Setting up phpHiveAdmin output path,
please use linux commandline console to chmod these path below to 777

设置phpHiveAdmin的输出路径
请使用Linux命令行终端来将下列路径chmod为777
*/
$configure['etl_path'] = $configure['fs_root'] . '/etl/';
$configure['result_path'] = $configure['fs_root'] . '/results/';
$configure['log_path'] = $configure['fs_root'] . '/logs/';

/*
Setting up Hive thrift path, no need to change them.

设置Hive thrift包的路径，无需自行修改
*/
$configure['thrift_root'] = $configure['fs_root']."/libs/";

include_once $configure['thrift_root'] . 'packages/hive_service/ThriftHive.php';
include_once $configure['thrift_root'] . 'packages/hive_metastore/ThriftHiveMetastore.php';
include_once $configure['thrift_root'] . 'transport/TSocket.php';
include_once $configure['thrift_root'] . 'protocol/TBinaryProtocol.php';

?>