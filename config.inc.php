<?php
$configure = array();

/*
The path in system that where phpHiveAdmin put, please do not change it.

phpHiveAdmin�����ļ�ϵͳ·�����Զ���ȡ���벻Ҫ�޸ġ�
*/
$configure['fs_root'] = __DIR__;

/*
Settting up where the metadata of Hive stored.
Support some usually database, like mysql, mysqli, postgresql, oracle...
Need compile the drivers with php first.
but not support Derby(Apache) access.

����Hive�洢Ԫ������ʹ�õ����ݿ�
֧�ֳ��õ����ݿ����ӷ�ʽ������mysql,mysqli,postgresql,oracle�ȵ�
��Ԥ����php�б�������ݿ������
���ǲ�֧��Derby(Apache)����
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

����hiveserver��thrift����IP�Ͷ˿�
�����Ҫ�Ļ�������metastore���ʵ������Ͷ˿�
��鿴 `hive --service -help`��ȡthrift������metastore����
*/
$configure['hive_thrift_host'] = '127.0.0.1';
$configure['hive_thrift_port'] = '10000';
$configure['hive_metastore_host'] = '127.0.0.1';
$configure['hive_metastore_port'] = '9083';

/*
Setting up languages you need in phpHiveAdmin user interface,
now support chinese or english

����phpHiveAdmin�û�������ʹ�õ�����
Ŀǰ֧������(chinese)��Ӣ��(english)
*/
$configure['language'] = 'chinese';

/*
Setting up the system environment that used by phpHiveAdmin

����phpHiveAdmin��ʹ�õ�ϵͳ��������
*/
$configure['hadoop_home'] = '/usr';
$configure['java_home'] = '/usr/java/default';
$configure['hive_home'] = '/usr/local/hive';

$configure['lang_set'] = 'zh_CN.UTF-8' ;
//Or en_US.UTF-8, if you are in english countries.
//����㴦��Ӣ����ң���ʹ��en_US.UTF-8

$configure['output_seperator'] = '\t'; 
// The result data columns seperating character.
// �����ָ�����������еķָ���.

/*
Setting up phpHiveAdmin output path,
please use linux commandline console to chmod these path below to 777

����phpHiveAdmin�����·��
��ʹ��Linux�������ն���������·��chmodΪ777
*/
$configure['etl_path'] = $configure['fs_root'] . '/etl/';
$configure['result_path'] = $configure['fs_root'] . '/results/';
$configure['log_path'] = $configure['fs_root'] . '/logs/';

/*
Setting up Hive thrift path, no need to change them.

����Hive thrift����·�������������޸�
*/
$configure['thrift_root'] = $configure['fs_root']."/libs/";

include_once $configure['thrift_root'] . 'packages/hive_service/ThriftHive.php';
include_once $configure['thrift_root'] . 'packages/hive_metastore/ThriftHiveMetastore.php';
include_once $configure['thrift_root'] . 'transport/TSocket.php';
include_once $configure['thrift_root'] . 'protocol/TBinaryProtocol.php';

?>