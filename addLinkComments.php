<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
/*
include_once('vtlib/Vtiger/Module.php');
$moduleEnvios = Vtiger_Module::getInstance('RegistroDeCambios');
$moduleEnvios->setRelatedList(Vtiger_Module::getInstance('ModComments'), 'Comentarios',Array('ADD','SELECT'),'get_related_list');
//CREA UN LINK RELACIONADO CON EL MODULO INDICADO
*/

require_once 'vtlib/Vtiger/Module.php'; 
$vtiger_utils_log = true;

$modulename = 'RegistroDeCambios'; 
$moduleinstance = vtiger_module::getinstance($modulename);

require_once 'modules/ModComments/ModComments.php';
$commentsmodule = vtiger_module::getinstance( 'ModComments' );
$fieldinstance = vtiger_field::getinstance( 'related_to', $commentsmodule );
$fieldinstance->setrelatedmodules( array($modulename) ); 
$detailviewblock = modcomments::addwidgetto( $modulename );
echo "comment widget for module $modulename has been created";

/*
Crear carpeta /layouts/vlayout/modules/$modulename

Copiar los siguientes archivos from /layouts/vlayout/modules/Contacts

DetailViewSummaryContents.tpl
ModuleSummaryView.tpl

Correr siguiente SQL paa habilitar campos de la vista resumen (summary)

UPDATE  `vtiger_field` SET summaryfield=1  WHERE `tablename` LIKE '%$modulename%'

*/
?>
