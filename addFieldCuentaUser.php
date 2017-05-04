<?php
$Vtiger_Utils_Log = true;
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once('vtlib/Vtiger/Module.php');
include_once('vtlib/Vtiger/Utils.php');
include_once('vtlib/Vtiger/Menu.php');
require_once('vtlib/Vtiger/Block.php');
require_once('vtlib/Vtiger/Field.php');
$Vtiger_Utils_Log = true;
// Define instances
$users = Vtiger_Module::getInstance('Users');
// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $users);
// Add field
$fieldInstance = new Vtiger_Field();
$fieldInstance->name = 'accountid'; //Usually matches column name
$fieldInstance->table = 'vtiger_users';
$fieldInstance->column = 'accountid'; //Must be lower case
$fieldInstance->label = 'Cuenta/Satelite'; //Upper case preceeded by LBL_
$fieldInstance->columntype = 'INT(11)'; //
$fieldInstance->uitype = 10; //Related module
$fieldInstance->typeofdata = 'N~M'; //V=Varchar?, M=Mandatory, O=Optional
$block->addField($fieldInstance);

$fieldInstance->setRelatedModules(Array('Accounts'));

$block->save($users);
$users->initWebservice();
?>
