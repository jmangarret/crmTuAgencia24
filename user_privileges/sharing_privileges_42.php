<?php


//This is the sharing access privilege file
$defaultOrgSharingPermission=array('2'=>2,'4'=>3,'6'=>3,'7'=>2,'9'=>3,'13'=>3,'16'=>3,'20'=>3,'21'=>2,'22'=>3,'23'=>3,'26'=>2,'8'=>3,'33'=>2,'35'=>3,'42'=>2,'44'=>2,'45'=>3,'46'=>2,'47'=>2,'48'=>2,'50'=>2,'51'=>2,'52'=>2,'14'=>2,'31'=>2,'18'=>2,'60'=>2,'61'=>2,'62'=>2,'63'=>2,'64'=>2,'65'=>2,'66'=>2,'67'=>2,'68'=>2,'69'=>2,'70'=>2,'71'=>2,'72'=>2,'73'=>2,'74'=>2,'76'=>2,);

$related_module_share=array(2=>array(6,),13=>array(6,),20=>array(6,2,),22=>array(6,2,20,),23=>array(6,22,),);

$Leads_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Leads_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Leads_Emails_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Leads_Emails_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Accounts_share_write_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Contacts_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Contacts_share_write_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Accounts_Potentials_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_Potentials_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_HelpDesk_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Accounts_HelpDesk_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_Emails_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_Emails_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_Quotes_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Accounts_Quotes_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_SalesOrder_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Accounts_SalesOrder_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounts_Invoice_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),3=>array(1,23,5,8,12,19,27,32,34,35,38,44,45,48,54,56,7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,18,25,30,37,42,43,47,26,36,),));

$Accounts_Invoice_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Potentials_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Potentials_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Potentials_Quotes_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Potentials_Quotes_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Potentials_SalesOrder_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Potentials_SalesOrder_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$HelpDesk_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(0=>12,1=>19,2=>27,3=>32,4=>34,5=>35,6=>38,7=>44,8=>45,9=>48,10=>54,11=>56,12=>7,13=>16,14=>17,15=>20,16=>28,17=>31,18=>40,19=>41,20=>46,21=>49,22=>50,23=>51,24=>52,25=>53,26=>55,27=>57,28=>58,29=>18,30=>25,31=>30,32=>37,33=>42,34=>43,35=>47,36=>26,37=>36,),3=>array(0=>1,1=>23,2=>5,3=>8,4=>12,5=>19,6=>27,7=>32,8=>34,9=>35,10=>38,11=>44,12=>45,13=>48,14=>54,15=>56,16=>7,17=>16,18=>17,19=>20,20=>28,21=>31,22=>40,23=>41,24=>46,25=>49,26=>50,27=>51,28=>52,29=>53,30=>55,31=>57,32=>58,33=>18,34=>25,35=>30,36=>37,37=>42,38=>43,39=>47,40=>26,41=>36,),));

$HelpDesk_share_write_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(0=>12,1=>19,2=>27,3=>32,4=>34,5=>35,6=>38,7=>44,8=>45,9=>48,10=>54,11=>56,12=>7,13=>16,14=>17,15=>20,16=>28,17=>31,18=>40,19=>41,20=>46,21=>49,22=>50,23=>51,24=>52,25=>53,26=>55,27=>57,28=>58,29=>18,30=>25,31=>30,32=>37,33=>42,34=>43,35=>47,36=>26,37=>36,),3=>array(0=>1,1=>23,2=>5,3=>8,4=>12,5=>19,6=>27,7=>32,8=>34,9=>35,10=>38,11=>44,12=>45,13=>48,14=>54,15=>56,16=>7,17=>16,18=>17,19=>20,20=>28,21=>31,22=>40,23=>41,24=>46,25=>49,26=>50,27=>51,28=>52,29=>53,30=>55,31=>57,32=>58,33=>18,34=>25,35=>30,36=>37,37=>42,38=>43,39=>47,40=>26,41=>36,),));

$Emails_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Emails_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Campaigns_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Campaigns_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Quotes_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Quotes_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Quotes_SalesOrder_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Quotes_SalesOrder_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$PurchaseOrder_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$PurchaseOrder_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$SalesOrder_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$SalesOrder_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$SalesOrder_Invoice_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$SalesOrder_Invoice_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Invoice_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Invoice_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Documents_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(0=>12,1=>19,2=>27,3=>32,4=>34,5=>35,6=>38,7=>44,8=>45,9=>48,10=>54,11=>56,12=>7,13=>16,14=>17,15=>20,16=>28,17=>31,18=>40,19=>41,20=>46,21=>49,22=>50,23=>51,24=>52,25=>53,26=>55,27=>57,28=>58,29=>18,30=>25,31=>30,32=>37,33=>42,34=>43,35=>47,36=>26,37=>36,),3=>array(0=>1,1=>23,2=>5,3=>8,4=>12,5=>19,6=>27,7=>32,8=>34,9=>35,10=>38,11=>44,12=>45,13=>48,14=>54,15=>56,16=>7,17=>16,18=>17,19=>20,20=>28,21=>31,22=>40,23=>41,24=>46,25=>49,26=>50,27=>51,28=>52,29=>53,30=>55,31=>57,32=>58,33=>18,34=>25,35=>30,36=>37,37=>42,38=>43,39=>47,40=>26,41=>36,),));

$Documents_share_write_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(0=>12,1=>19,2=>27,3=>32,4=>34,5=>35,6=>38,7=>44,8=>45,9=>48,10=>54,11=>56,12=>7,13=>16,14=>17,15=>20,16=>28,17=>31,18=>40,19=>41,20=>46,21=>49,22=>50,23=>51,24=>52,25=>53,26=>55,27=>57,28=>58,29=>18,30=>25,31=>30,32=>37,33=>42,34=>43,35=>47,36=>26,37=>36,),3=>array(0=>1,1=>23,2=>5,3=>8,4=>12,5=>19,6=>27,7=>32,8=>34,9=>35,10=>38,11=>44,12=>45,13=>48,14=>54,15=>56,16=>7,17=>16,18=>17,19=>20,20=>28,21=>31,22=>40,23=>41,24=>46,25=>49,26=>50,27=>51,28=>52,29=>53,30=>55,31=>57,32=>58,33=>18,34=>25,35=>30,36=>37,37=>42,38=>43,39=>47,40=>26,41=>36,),));

$Products_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Products_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Vendors_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Vendors_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Services_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Services_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$ServiceContracts_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$ServiceContracts_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$ModComments_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$ModComments_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$ProjectMilestone_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$ProjectMilestone_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$ProjectTask_share_read_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(0=>12,1=>19,2=>27,3=>32,4=>34,5=>35,6=>38,7=>44,8=>45,9=>48,10=>54,11=>56,12=>7,13=>16,14=>17,15=>20,16=>28,17=>31,18=>40,19=>41,20=>46,21=>49,22=>50,23=>51,24=>52,25=>53,26=>55,27=>57,28=>58,29=>18,30=>25,31=>30,32=>37,33=>42,34=>43,35=>47,36=>26,37=>36,),3=>array(0=>1,1=>23,2=>5,3=>8,4=>12,5=>19,6=>27,7=>32,8=>34,9=>35,10=>38,11=>44,12=>45,13=>48,14=>54,15=>56,16=>7,17=>16,18=>17,19=>20,20=>28,21=>31,22=>40,23=>41,24=>46,25=>49,26=>50,27=>51,28=>52,29=>53,30=>55,31=>57,32=>58,33=>18,34=>25,35=>30,36=>37,37=>42,38=>43,39=>47,40=>26,41=>36,),));

$ProjectTask_share_write_permission=array('ROLE'=>array(),'GROUP'=>array(2=>array(0=>12,1=>19,2=>27,3=>32,4=>34,5=>35,6=>38,7=>44,8=>45,9=>48,10=>54,11=>56,12=>7,13=>16,14=>17,15=>20,16=>28,17=>31,18=>40,19=>41,20=>46,21=>49,22=>50,23=>51,24=>52,25=>53,26=>55,27=>57,28=>58,29=>18,30=>25,31=>30,32=>37,33=>42,34=>43,35=>47,36=>26,37=>36,),3=>array(0=>1,1=>23,2=>5,3=>8,4=>12,5=>19,6=>27,7=>32,8=>34,9=>35,10=>38,11=>44,12=>45,13=>48,14=>54,15=>56,16=>7,17=>16,18=>17,19=>20,20=>28,21=>31,22=>40,23=>41,24=>46,25=>49,26=>50,27=>51,28=>52,29=>53,30=>55,31=>57,32=>58,33=>18,34=>25,35=>30,36=>37,37=>42,38=>43,39=>47,40=>26,41=>36,),));

$Project_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Project_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Assets_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Assets_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounting_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Accounting_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Timecontrol_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Timecontrol_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$RegistroDeVentas_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$RegistroDeVentas_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$RegistroDePagos_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$RegistroDePagos_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Envios_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Envios_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Pagos_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Pagos_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Boletos_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Boletos_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$VentaDeProductos_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$VentaDeProductos_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Localizadores_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Localizadores_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$TiposdeComisiones_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$TiposdeComisiones_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$ComisionSatelites_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$ComisionSatelites_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Terminales_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Terminales_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Tarifas_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Tarifas_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$AsignacionSatelites_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$AsignacionSatelites_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Aeropuerto_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Aeropuerto_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Airline_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Airline_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$TarifasAereas_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$TarifasAereas_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$RegistroDeCambios_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$RegistroDeCambios_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

$Auditoria_share_read_permission=array('ROLE'=>array(),'GROUP'=>array());

$Auditoria_share_write_permission=array('ROLE'=>array(),'GROUP'=>array());

?>