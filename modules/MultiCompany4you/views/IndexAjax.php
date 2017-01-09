<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_IndexAjax_View extends Vtiger_Index_View {

    function __construct() {
        parent::__construct();
        $this->exposeMethod('editLicense');
    }

    function preProcess(Vtiger_Request $request) {
        return true;
    }

    function postProcess(Vtiger_Request $request) {
        return true;
    }

    function process(Vtiger_Request $request) {
        
        $mode = $request->get('mode');
        if(!empty($mode)) {
                $this->invokeExposedMethod($mode, $request);
                return;
        }
        
        $type = $request->get('type');
    }

    function editLicense(Vtiger_Request $request) {
        
        $MultiCompany4you = new MultiCompany4you_MultiCompany4you_Model();

        $viewer = $this->getViewer($request);

        $moduleName = $request->getModule();
       
        $type = $request->get('type');
        $viewer->assign("TYPE", $type);
        
        $key = $request->get('key');
        $viewer->assign("LICENSEKEY", $key);
        
        echo $viewer->view('EditLicense.tpl', 'MultiCompany4you', true);
    }
    
}