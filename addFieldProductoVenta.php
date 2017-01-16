<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once('vtlib/Vtiger/Module.php');
include_once('vtlib/Vtiger/Utils.php');
include_once('vtlib/Vtiger/Menu.php');
require_once('vtlib/Vtiger/Block.php');
require_once('vtlib/Vtiger/Field.php');
$Vtiger_Utils_Log = true; 
$module=Vtiger_Module::getInstance('VentaDeProductos');
$block = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION',$module);

$field0 = new Vtiger_Field();
$field0->name = 'productoid'; //Usually matches column name
$field0->table = 'vtiger_ventadeproductos';
$field0->column = 'productoid'; //Must be lower case
$field0->label = 'Producto'; //Upper case preceeded by LBL_
$field0->columntype = 'INT(11)'; //
$field0->uitype = 10; //Campo select setRelatedModule
$field0->typeofdata = 'N~M'; //V=Varchar?, M=Mandatory, O=Optional
$block->addField($field0);
$field0->setRelatedModules(Array('Products'));

?>