<?php

	include_once ('vtlib/Vtiger/Module.php');

 	$Vtiger_Utils_Log = true;

 	$MODULENAME = 'TarifasAereas';
 	$TABLENAME = 'vtiger_tarifasaereas';


	/////////////////////////INICIO MODULO///////////////////////////

    $moduleInstance = new Vtiger_Module(); 
    $moduleInstance->name = $MODULENAME;     
    $moduleInstance->parent= 'General';
    $moduleInstance->save();			  

    // Schema Setup
    $moduleInstance->initTables(); 		 

    $menuInstance = Vtiger_Menu::getInstance('General');  
    $menuInstance->addModule($moduleInstance);			

	/////////////////////////FIN MODULO///////////////////////////

	/////////////////////////INICIO BLOQUE///////////////////////////

    // Field Setup
    $blockInstance = new Vtiger_Block();					
	$blockInstance->label = 'LBL_AIRFARES_INFORMATION';		
    $moduleInstance->addBlock($blockInstance);				

    $blockInstance2 = new Vtiger_Block();					
    $blockInstance2->label = 'LBL_CUSTOM_INFORMATION';		
    $moduleInstance->addBlock($blockInstance2);				

	/////////////////////////FIN BLOQUE///////////////////////////

	/////////////////////////INICIO CAMPOS///////////////////////////

  	$fieldInstance1  = new Vtiger_Field();                          
    $fieldInstance1->name = 'airline';                                       
    $fieldInstance1->label = 'Aerolinea';                                      
    $fieldInstance1->table = $TABLENAME;                      
    $fieldInstance1->uitype = 16;                                            
    $fieldInstance1->column = 'airline';                                     
    $fieldInstance1->columntype = 'VARCHAR(150)';           
    $fieldInstance1->typeofdata = 'V~M';                            
    $blockInstance->addField($fieldInstance1);                     

 	$fieldInstance2  = new Vtiger_Field();                          
    $fieldInstance2->name = 'aeropuerto';                                       
    $fieldInstance2->label = 'Origen';                                      
    $fieldInstance2->table = $TABLENAME;                      
    $fieldInstance2->uitype = 16;                                            
    $fieldInstance2->column = 'origen';                                     
    $fieldInstance2->columntype = 'VARCHAR(150)';           
    $fieldInstance2->typeofdata = 'V~M';                            
    $blockInstance->addField($fieldInstance2);  

    $fieldInstance3  = new Vtiger_Field();                          
    $fieldInstance3->name = 'aeropuerto1';                                       
    $fieldInstance3->label = 'Destino';                                      
    $fieldInstance3->table = $TABLENAME;                      
    $fieldInstance3->uitype = 16;                                            
    $fieldInstance3->column = 'destino';                                     
    $fieldInstance3->columntype = 'VARCHAR(150)';           
    $fieldInstance3->typeofdata = 'V~M';                            
    $blockInstance->addField($fieldInstance3);  

    $fieldInstance4  = new Vtiger_Field();                          
    $fieldInstance4->name = 'currency';                                       
    $fieldInstance4->label = 'Moneda';                                      
    $fieldInstance4->table = $TABLENAME;                      
    $fieldInstance4->uitype = 16;                                            
    $fieldInstance4->column = 'moneda';                                     
    $fieldInstance4->columntype = 'VARCHAR(50)';           
    $fieldInstance4->typeofdata = 'V~M';                            
    $blockInstance->addField($fieldInstance4); 

    $fieldInstance5  = new Vtiger_Field();                          
    $fieldInstance5->name = 'tarifa';                                       
    $fieldInstance5->label = 'Tarifa';                                      
    $fieldInstance5->table = $TABLENAME;                      
    $fieldInstance5->uitype = 71;                                            
    $fieldInstance5->column = 'tarifa';                                     
    $fieldInstance5->columntype = 'DECIMAL(25,2)';           
    $fieldInstance5->typeofdata = 'N~M';   
    $fieldInstance5->defaultvalue = '0.0';                         
    $blockInstance->addField($fieldInstance5); 

    $fieldInstance6  = new Vtiger_Field();
    $fieldInstance6->name = 'observaciones';
    $fieldInstance6->label = 'Observaciones';
    $fieldInstance6->table = $TABLENAME;
    $fieldInstance6->uitype = 19;
    $fieldInstance6->column = 'observaciones';
    $fieldInstance6->columntype = 'VARCHAR(300)';           
    $fieldInstance6->typeofdata = 'V~M';   
    $fieldInstance6->defaultvalue = 'Clase y Cambio de dia.'; 
    $blockInstance->addField($fieldInstance6);

    $fieldInstance7  = new Vtiger_Field();
    $fieldInstance7->name = 'presence';
    $fieldInstance7->label = 'Presence';
    $fieldInstance7->table = $TABLENAME;
    $fieldInstance7->uitype = 16;
    $fieldInstance7->column = 'presence';
    $fieldInstance7->columntype = 'Int(11)';           
    $fieldInstance7->typeofdata = 'I~O'; 
    $fieldInstance7->displaytype = 3;    
    $blockInstance->addField($fieldInstance7);

    $fieldInstance8  = new Vtiger_Field();
    $fieldInstance8->name = 'picklist_valueid';
    $fieldInstance8->label = 'Picklist Value';
    $fieldInstance8->table = $TABLENAME;
    $fieldInstance8->uitype = 16;
    $fieldInstance8->column = 'picklist_valueid';
    $fieldInstance8->columntype = 'Int(11)';           
    $fieldInstance8->typeofdata = 'I~O';   
    $fieldInstance8->displaytype = 3;  
    $blockInstance->addField($fieldInstance8);

    $fieldInstance9  = new Vtiger_Field();
    $fieldInstance9->name = 'sortorderid';
    $fieldInstance9->label = 'Sortorde';
    $fieldInstance9->table = $TABLENAME;
    $fieldInstance9->uitype = 16;
    $fieldInstance9->column = 'sortorderid';
    $fieldInstance9->columntype = 'Int(11)';           
    $fieldInstance9->typeofdata = 'I~O';  
    $fieldInstance9->displaytype = 3;   
    $blockInstance->addField($fieldInstance9);

    $fieldInstance10  = new Vtiger_Field();
    $fieldInstance10->name = 'activo';
    $fieldInstance10->label = 'Activo';
    $fieldInstance10->table = $TABLENAME;
    $fieldInstance10->uitype = 56;
    $fieldInstance10->column = 'activo';
    $fieldInstance10->columntype = 'VARCHAR(5)';           
    $fieldInstance10->typeofdata = 'V~M';
    $fieldInstance10->defaultvalue = '1';   
    $blockInstance->addField($fieldInstance10);

                     
    $moduleInstance->setEntityIdentifier($fieldInstance1);  //Define cual es el campo por el cual se realizaran las busquedas

	/////////////////////////FIN CAMPOS///////////////////////////

	/////////////////////////INICIO CAMPOS OBLIGATORIOS ///////////////////////////

    // Recommended common fields every Entity module should have (linked to core table)
    $mfield1 = new Vtiger_Field();
    $mfield1->name = 'assigned_user_id';
    $mfield1->label = 'Assigned To';
    $mfield1->table = 'vtiger_crmentity';
    $mfield1->column = 'smownerid';
    $mfield1->uitype = 53;
    $mfield1->typeofdata = 'V~M';
    $blockInstance2->addField($mfield1);

    $mfield2 = new Vtiger_Field();
    $mfield2->name = 'createdTime';
    $mfield2->label= 'Created Time';
    $mfield2->table = 'vtiger_crmentity';
   	$mfield2->column = 'createdtime';
    $mfield2->uitype = 70;
    $mfield2->typeofdata = 'T~O';
    $mfield2->displaytype= 2;
    $blockInstance2->addField($mfield2);

    $mfield3 = new Vtiger_Field();
    $mfield3->name = 'modifiedTime';
    $mfield3->label= 'Modified Time';
    $mfield3->table = 'vtiger_crmentity';
    $mfield3->column = 'modifiedtime';
    $mfield3->uitype = 70;
    $mfield3->typeofdata = 'T~O';
    $mfield3->displaytype= 2;
    $blockInstance2->addField($mfield3);

	/////////////////////////FIN CAMPOS OBLIGATORIOS ///////////////////////////

	/////////////////////////INICIO FILTRO OBLIGATORIO ///////////////////////////

    // Filter Setup
    $filter1 = new Vtiger_Filter();
    $filter1->name = 'All';
    $filter1->isdefault = true;
    $moduleInstance->addFilter($filter1);
    $filter1->addField($fieldInstance1)->addField($fieldInstance2, 1)->addField($fieldInstance3,2)->addField($fieldInstance4,3)->addField($fieldInstance5,4)->addField($fieldInstance6,5)->addField($mfield1,6)->addField($mfield2,7)->addField($mfield3,8); //campos que se agregaran al filtro

	/////////////////////////FIN FILTRO OBLIGATORIO ///////////////////////////

    // // Sharing Access Setup
    $moduleInstance->setDefaultSharing();

    // Webservice Setup
    $moduleInstance->initWebservice();

    mkdir('modules/'.$MODULENAME); //crear en la carpeta modulo del vtiger la carpeta correspondiente al modulo que se creo
    echo "Modulo Creado\n";
?>