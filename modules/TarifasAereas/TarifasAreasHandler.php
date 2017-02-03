<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include_once('include/PHPMailer/enviar_email.php');
	class TarifasAereasHandler extends VTEventHandler 
	{	
    	function handleEvent($eventName, $entityData) 
    	{  
    		global $log, $adb;
    		$log->debug("Entering handle event Tarifas Aereas Handler");
        	$moduleName = $entityData->getModuleName();
        	if ($moduleName == 'TarifasAereas') 
        	{  
        		if ($eventName == 'vtiger.entity.aftersave') 
        		{          						
        			$esNuevo=$entityData->isNew();

                    //RURIEPE 22/09/2016 - CAPTURA DE ID
                    $RelId=$entityData->getId();
                   
        			//RURIEPE 16/09/2016 - SE REALIZA LA CAPTURA DE LOS CAMPOS. 
                    $airline        =$_REQUEST["airline"];
                    $origen         =$_REQUEST["aeropuerto"];
                    $destino        =$_REQUEST["aeropuerto1"];
                    $moneda         =$_REQUEST["currency"];
                    $tarifa         =$_REQUEST["tarifa"];
                    $observaciones  =$_REQUEST["observaciones"];
                    $asignado       =$_REQUEST["assigned_user_id"];
                    $modulo         ='Calendar';
                    $asunto         ='Actualizar Tarifa para '.$origen.' - '.$destino;
                    $actividad      ='Task';

                    //RURIEPE 19/09/2016 - SE EVALUA SI EL REGISTRO A CREAR ES NUEVO, EN CASO DE SER VERDADERO SE REALIZA EL ENVIO DE PARAMETROS PARA CREAR EL REGISTRO DE ACTIVIDAD EN LA BASE DE DATOS Y ACTIVAR LA NOTIFICACION(POP-UP)
                    if($esNuevo && $tarifa == 0)
                    {
                        
                        //RURIEPE 19/09/2016 - SE INCLUYE ARCHIVO PARA INVOCAR LA FUNCION
                        include('modules/Vtiger/GenerarNotificaciones.php');
    
                        //RURIEPE 19/09/2016 - LLAMADO DE LA FUNCION Y PASE DE PARAMETROS CON LOS VALORES ASIGNADOS;
                        crearActividad($asignado,$modulo,$asunto,$actividad,$RelId);
                    } 
                    elseif (!$esNuevo && $tarifa > 0)  
                    {

                        //RURIEPE 16/09/2016 - SE CAPTURA EL NOMBRE Y APELLIDO DEL ASESOR.
                        $ownerModel = Users_Record_Model::getInstanceById($asignado, 'Users');
                        $asesor = $ownerModel->get('first_name')." ".$ownerModel->get('last_name');

                        $correo  =  "dairelys.herrera@tuagencia24.com ";
                        $asunto  =  "Tarifa Aerea Cargada";
                    
                        //RURIEPE 16/09/2016 - SE CREA VARIBLE $mensaje PARA CREAR EL CUERPO DEL CORREO CON CODIGO HTML
                        $mensaje .="  
                        <table>
                            <tr>
                                <th>--------------------------------------------------------------------------------------------------------------</th>
                            </tr>
                            <tr>
                                <th><i>Tarifa Aérea</i></th>
                            </tr>
                            <tr>
                                <th>--------------------------------------------------------------------------------------------------------------</th>
                            </tr>
                            <tr>
                                <td><b>Aerolínea: </b>".$airline."</td>
                            </tr>
                            <tr>
                                <td><b>Aeropuerto Origen: </b>".$origen."</td>
                            </tr>
                            <tr>
                                <td><b>Aeropuerto Destino: </b>".$destino."</td>
                            </tr>
                            <tr>
                                <td><b>Moneda: </b>".$moneda."</td>
                            </tr>
                             <tr>
                                <td><b>Tarifa: </b>".$tarifa."</td>
                            </tr>
                             <tr>
                                <td><b>Observaciones: </b>".$observaciones."</td>
                            </tr>
                            <tr>
                                <td><b>Asesor: </b>".$asesor."</td>
                            </tr>
                            <tr>
                                <th>--------------------------------------------------------------------------------------------------------------</th>
                            </tr> 
                        </table>";

                        $envio=enviarEmail($correo,$asunto,$mensaje);
                    }
        		}
    		}
    		return true;
    	}
	}	
?>
	
