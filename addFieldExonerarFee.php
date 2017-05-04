<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require_once('vtlib/Vtiger/Module.php');
include_once('vtlib/Vtiger/Utils.php');
include_once('vtlib/Vtiger/Menu.php');
require_once('vtlib/Vtiger/Block.php');
require_once('vtlib/Vtiger/Field.php');
$Vtiger_Utils_Log = true;
$module=Vtiger_Module::getInstance('Localizadores');

$block = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION',$module);

$field1=new Vtiger_Field();
$field1->label='Exonerar Fee';
$field1->name='exonerarfee';
$field1->table='vtiger_localizadores';
$field1->column='exonerarfee';
$field1->columntype = 'VARCHAR(3)';
$field1->uitype = 56; //checkbox
$field1->typeofdata = 'V~O';
$field1->defaultvalue = '0';
$block->addField($field1);

$block->save($module);
$module->initWebservice();
echo 'Code successfully executed';
?>
