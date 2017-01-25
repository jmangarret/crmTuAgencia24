<?php
/*VIENE DE LISTVIEW.PHP*/
/*INCLUDE PARA FUNCION getListViewEntries*/
$currentUser = vglobal('current_user');
//$role = Users_Record_Model::getRole();

echo "<pre>";
//print_r($currentUser);

$methods = array();
foreach (get_class_methods($currentUser) as $method) {    
        $methods[] = $method;    
}
print_r($methods);
$role=$currentUser->column_fields["roleid"];
echo "ROL: ".$role;

//Modified by jmangarret 13ene2016 popUP seleccionar localizadores desde Registro de Ventas
if ($moduleName=="Localizadores" && $sourceModule=="RegistroDeVentas"){
	$listQuery .= ' AND vtiger_localizadores.procesado=0';	
}

//Modified by jmangarret 03feb2016 popUP seleccionar cuentas desde Comsiones Satelites
if ($moduleName=="Accounts" && $sourceModule=="ComisionSatelites"){
	$listQuery .= ' AND vtiger_account.account_type="Satelite"';	
}	

//Modified by jmangarret 13ene2017 Filtro de Localizadores por Firma de satelite.
if ($moduleName=="Localizadores" && $role=="Bestravel"){
	$accountid=13020;
	$sqlFirmas ="SELECT firma FROM vtiger_terminales as t INNER JOIN vtiger_contactdetails as c ON t.usercontactoid=c.contactid ";
	$sqlFirmas.=" INNER JOIN vtiger_account as a ON c.accountid=a.accountid ";
	$sqlFirmas.=" WHERE account_type='Satelite' AND a.accountid=$accountid ";
	$qryFirmas=$db->pquery($sqlFirmas, array());
	//leemos cada firma para convertirla en una cadena tipo string
	while ($firma=$db->fetch_row($qryFirmas)){
		$firmas.="'".$firma[0]."',";
	}	
	$firmas = substr($firmas, 0, -1); //eliminamos la ultima coma que traerá un valor vacio
	$listQuery .= ' AND vtiger_localizadores.referencia IN ('.$firmas.')';	
}

?>