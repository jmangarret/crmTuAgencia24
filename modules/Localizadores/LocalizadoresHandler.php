<?php
class LocalizadoresHandler extends VTEventHandler {	
    function handleEvent($eventName, $entityData) {  
    	global $log, $adb;
    	$log->debug("Entering handle event LocalizadoresHandler");
        $moduleName = $entityData->getModuleName();        
    	if ($eventName == 'vtiger.entity.aftersave') {          						
    		$id=$entityData->getId();    
			$exonerarfee=$_REQUEST["exonerarfee"];	
			if ($exonerarfee=="on"){				
    			$sql="UPDATE vtiger_boletos SET fee=0 WHERE localizadorid=$id";
    			$result = $adb->pquery($sql, array());
    			//die($sql);
    		}
    		return true;
    	}
    }
}

?>
	