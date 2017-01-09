<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */
//error_reporting(63);ini_set('display_errors','On');
class MultiCompany4you_License_View extends Settings_Vtiger_Index_View {

    
    public function preProcess(Vtiger_Request $request, $display = true) {
        parent::preProcess($request, false);
        $MultiCompany4you = new MultiCompany4you_MultiCompany4you_Model();
        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();
        $viewer->assign('QUALIFIED_MODULE', $moduleName);

        $moduleName = $request->getModule();
        
        $linkParams = array('MODULE' => $moduleName, 'ACTION' => $request->get('view'));
        
        $viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('CURRENT_VIEW', $request->get('view'));
        
        if ($display) {
            $this->preProcessDisplay($request);
        }
    }
    
    public function process(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();
        
        $MultiCompany4you = new MultiCompany4you_MultiCompany4you_Model();

        $viewer = $this->getViewer($request);

        $mode = $request->get('mode');
        
        $viewer->assign("MODE", $mode);             
        
        $viewer->assign("LICENSE", $MultiCompany4you->GetLicenseKey());
        $viewer->assign("VERSION_TYPE", $MultiCompany4you->GetVersionType());            
        
        $viewer->view('License.tpl', 'MultiCompany4you');         
    }
}     