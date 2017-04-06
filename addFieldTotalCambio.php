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
$module = Vtiger_Module::getInstance('RegistroDeVentas');
// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('Resumen', $module);
// Add field
$fieldInstance = new Vtiger_Field();
$fieldInstance->name = 'totalcambiobs'; //Usually matches column name
$fieldInstance->table = 'vtiger_registrodeventas';
$fieldInstance->column = 'totalcambiobs'; //Must be lower case
$fieldInstance->label = 'Total Dolares a Bs.'; //Upper case preceeded by LBL_
$fieldInstance->columntype = 'DOUBLE(25,2)'; //
$fieldInstance->uitype = 71; //textCampo mandatory
$fieldInstance->displaytype = 2	; //textCampo mandatory
$fieldInstance->typeofdata = 'I~O'; //V=Varchar?, M=Mandatory, O=Optional
$block->addField($fieldInstance);

$block->save($module);
$module->initWebservice();
?>
