<?php

    include_once ('vtlib/Vtiger/Module.php');

    $Vtiger_Utils_Log = true;

    $MODULENAME = 'Aeropuerto';
    $TABLENAME = 'vtiger_aeropuerto';

    /////////////////////////INICIO MODULO///////////////////////////

    $moduleInstance = new Vtiger_Module(); 
    $moduleInstance->name = $MODULENAME;     
    $moduleInstance->parent= 'General';
    $moduleInstance->save();			  

    //Schema Setup
    $moduleInstance->initTables(); 		 

    $menuInstance = Vtiger_Menu::getInstance('General');  
    $menuInstance->addModule($moduleInstance);			

    /////////////////////////FIN MODULO///////////////////////////

    /////////////////////////INICIO BLOQUE///////////////////////////

    // Field Setup
    $blockInstance = new Vtiger_Block();					
	$blockInstance->label = 'LBL_AIRPORT_INFORMATION';		
    $moduleInstance->addBlock($blockInstance);				

    $blockInstance2 = new Vtiger_Block();					
    $blockInstance2->label = 'LBL_CUSTOM_INFORMATION';		
    $moduleInstance->addBlock($blockInstance2);				

    /////////////////////////FIN BLOQUE///////////////////////////

    /////////////////////////INICIO CAMPOS///////////////////////////

    $fieldInstance1  = new Vtiger_Field();                          
    $fieldInstance1->name = 'aeropuerto';                                       
    $fieldInstance1->label = 'Aeropuerto';                                      
    $fieldInstance1->table = $TABLENAME;                      
    $fieldInstance1->uitype = 1;                                            
    $fieldInstance1->column = 'aeropuerto';                                     
    $fieldInstance1->columntype = 'VARCHAR(100)';           
    $fieldInstance1->typeofdata = 'V~M';                            
    $blockInstance->addField($fieldInstance1);                      

    $fieldInstance2  = new Vtiger_Field();                          
    $fieldInstance2->name = 'tipodevuelo';                                     
    $fieldInstance2->label = 'Tipo';                            
    $fieldInstance2->table = $TABLENAME;                      
    $fieldInstance2->uitype = 16;//picklist no basado en roles                                         
    $fieldInstance2->column = 'tipo';                           
    $fieldInstance2->columntype = 'VARCHAR(100)';           
    $fieldInstance2->typeofdata = 'V~M';                             
    $blockInstance->addField($fieldInstance2); 

    /*$fieldInstance3  = new Vtiger_Field();
    $fieldInstance3->name = 'mailingcity';
    $fieldInstance3->label = 'Ciudad';
    $fieldInstance3->table = $TABLENAME;
    $fieldInstance3->uitype = 16;
    $fieldInstance3->column = 'ciudad';
    $fieldInstance3->columntype = 'VARCHAR(100)';           
    $fieldInstance3->typeofdata = 'V~M';   
    $blockInstance->addField($fieldInstance3);*/

    $fieldInstance4  = new Vtiger_Field();
    $fieldInstance4->name = 'presence';
    $fieldInstance4->label = 'Presence';
    $fieldInstance4->table = $TABLENAME;
    $fieldInstance4->uitype = 16;
    $fieldInstance4->column = 'presence';
    $fieldInstance4->columntype = 'Int(11)';           
    $fieldInstance4->typeofdata = 'I~O'; 
    $fieldInstance4->displaytype = 3;    
    $blockInstance->addField($fieldInstance4);

    $fieldInstance5  = new Vtiger_Field();
    $fieldInstance5->name = 'picklist_valueid';
    $fieldInstance5->label = 'Picklist Value';
    $fieldInstance5->table = $TABLENAME;
    $fieldInstance5->uitype = 16;
    $fieldInstance5->column = 'picklist_valueid';
    $fieldInstance5->columntype = 'Int(11)';           
    $fieldInstance5->typeofdata = 'I~O';   
    $fieldInstance5->displaytype = 3;  
    $blockInstance->addField($fieldInstance5);

    $fieldInstance6  = new Vtiger_Field();
    $fieldInstance6->name = 'sortorderid';
    $fieldInstance6->label = 'Sortorde';
    $fieldInstance6->table = $TABLENAME;
    $fieldInstance6->uitype = 16;
    $fieldInstance6->column = 'sortorderid';
    $fieldInstance6->columntype = 'Int(11)';           
    $fieldInstance6->typeofdata = 'I~O';  
    $fieldInstance6->displaytype = 3;   
    $blockInstance->addField($fieldInstance6);

    $moduleInstance->setEntityIdentifier($fieldInstance1);  //Define cual es el campo por el cual se realizaran las busquedas

    /////////////////////////FIN CAMPOS///////////////////////////

    /////////////////////////INICIO CAMPOS OBLIGATORIOS ///////////////////////////

    //Recommended common fields every Entity module should have (linked to core table)
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

    //Filter Setup
    $filter1 = new Vtiger_Filter();
    $filter1->name = 'All';
    $filter1->isdefault = true;
    $moduleInstance->addFilter($filter1);
    $filter1->addField($fieldInstance1)->addField($fieldInstance2, 1)->addField($mfield1, 2)->addField($mfield2, 3)->addField($mfield3, 4); //campos que se agregaran al filtro

    /////////////////////////FIN FILTRO OBLIGATORIO ///////////////////////////

    // // Sharing Access Setup
    $moduleInstance->setDefaultSharing();

    // Webservice Setup
    $moduleInstance->initWebservice();

    mkdir('modules/'.$MODULENAME); //crear en la carpeta modulo del vtiger la carpeta correspondiente al modulo que se creo
    echo "Creado Modulo\n";
?>