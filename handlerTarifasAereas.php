<?php
require_once 'include/utils/utils.php';
require 'include/events/include.inc';
$em = new VTEventsManager($adb);
//$em->registerHandler("vtiger.entity.beforesave", "modules/AsignacionSatelites/AsignacionSatelitesHandler.php", "AsignacionSatelitesHandler");
$em->registerHandler("vtiger.entity.aftersave", "modules/TarifasAereas/TarifasAreasHandler.php", "TarifasAereasHandler");
echo 'Custom Handler Registered !';
?>
