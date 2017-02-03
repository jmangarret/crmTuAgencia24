<?php
require_once 'include/utils/utils.php';
require 'include/events/include.inc';
$em = new VTEventsManager($adb);
$em->registerHandler("vtiger.entity.aftersave", "modules/Localizadores/LocalizadoresHandler.php", "LocalizadoresHandler", "ModuleName in ['Localizadores']");
echo 'Custom Handler Localizadores Registered !';

?>
