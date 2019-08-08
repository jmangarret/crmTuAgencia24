<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once('vtlib/Vtiger/Module.php');
include_once('vtlib/Vtiger/Utils.php');
include_once('vtlib/Vtiger/Menu.php');
require_once('vtlib/Vtiger/Block.php');
require_once('vtlib/Vtiger/Field.php');
$Vtiger_Utils_Log = true;
$module=Vtiger_Module::getInstance('Boletos');
$block = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION',$module);

$field2=new Vtiger_Field();
$field2->label='Fecha de Regreso';
$field2->name='fecha_regreso';
$field2->table='vtiger_boletos';
$field2->column='fecha_regreso';
$field2->columntype = 'DATE';
$field2->uitype = 5; //calendar
$field2->typeofdata = 'D~M';
$block->addField($field2);


$block->save($module);
$module->initWebservice();
echo 'Code successfully executed';
?>
