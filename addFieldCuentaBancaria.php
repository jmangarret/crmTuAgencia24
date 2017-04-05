<?php
$Vtiger_Utils_Log = true;
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_STRICT & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
require_once('vtlib/Vtiger/Module.php');
include_once('vtlib/Vtiger/Utils.php');
include_once('vtlib/Vtiger/Menu.php');
require_once('vtlib/Vtiger/Block.php');
require_once('vtlib/Vtiger/Field.php');
$Vtiger_Utils_Log = true;
// Define instances
$contact = Vtiger_Module::getInstance('Contacts');
// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('LBL_CONTACT_INFORMATION', $contact);
// Add field
$fieldInstance = new Vtiger_Field();
$fieldInstance->name = 'cuentabancaria'; //Usually matches column name
$fieldInstance->table = 'vtiger_contactdetails';
$fieldInstance->column = 'cuentabancaria'; //Must be lower case
$fieldInstance->label = 'Cuenta(s) Bancaria(s)'; //Upper case preceeded by LBL_
$fieldInstance->columntype = 'TEXT'; //
$fieldInstance->displaytype = 1; //textCampo mandatory
$fieldInstance->uitype = 19; //textCampo mandatory
$fieldInstance->summaryfield = 1; //textCampo mandatory
$fieldInstance->typeofdata = 'V~O'; //V=Varchar?, M=Mandatory, O=Optional
$block->addField($fieldInstance);

$block->save($contact);
$contact->initWebservice();
?>
