<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_Save_Action extends Settings_Vtiger_Basic_Action {

    public function process(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();
        $qualifiedModuleName = $request->getModule();
        $moduleModel = MultiCompany4you_CompanyDetails_Model::getEditInstance($request);
        $status = false;

        if ($request->get('companyname')) {
            $saveLogo = $saveStamp = $status = true;
            if (!empty($_FILES['logo']['name'])) {
                $logoDetails = $_FILES['logo'];
                $fileType = explode('/', $logoDetails['type']);
                $fileType = $fileType[1];

                if (!$logoDetails['size'] || !in_array($fileType, MultiCompany4you_CompanyDetails_Model::$logoSupportedFormats)) {
                    $saveLogo = false;
                }
                // Check for php code injection
                $imageContents = file_get_contents($_FILES["logo"]["tmp_name"]);
                if (preg_match('/(<\?php?(.*?))/i', $imageContents) == 1) {
                    $saveLogo = false;
                }
                if ($saveLogo) {
                    $moduleModel->saveLogo();
                }
            } else {
                $saveLogo = true;
            }
            if (!empty($_FILES['stamp']['name'])) {
                $stampDetails = $_FILES['stamp'];
                $fileType = explode('/', $stampDetails['type']);
                $fileType = $fileType[1];

                if (!$stampDetails['size'] || !in_array($fileType, MultiCompany4you_CompanyDetails_Model::$logoSupportedFormats)) {
                    $saveStamp = false;
                }
                // Check for php code injection
                $imageContents = file_get_contents($_FILES["stamp"]["tmp_name"]);
                if (preg_match('/(<\?php?(.*?))/i', $imageContents) == 1) {
                    $saveStamp = false;
                }
                if ($saveStamp) {
                    $moduleModel->saveStamp();
                }
            } else {
                $saveStamp = true;
            }
            $fields = $moduleModel->getFields();
            foreach ($fields as $fieldName => $fieldType) {
                if($fieldName == 'stamp'){
                    continue;
                }
                $fieldValue = $request->get($fieldName);
                if ($fieldName === 'logoname') {
                    if (!empty($logoDetails['name'])) {
                        $fieldValue = ltrim(basename(" " . $logoDetails['name']));
                    } else {
                        $fieldValue = $moduleModel->get($fieldName);
                    }
                }
                if ($fieldName === 'stampname') {
                    if (!empty($stampDetails['name'])) {
                        $fieldValue = ltrim(basename(" " . $stampDetails['name']));
                    } else {
                        $fieldValue = $moduleModel->get($fieldName);
                    }
                }
                $moduleModel->set($fieldName, $fieldValue);
            }
            $moduleModel->save();
        }

        $reloadUrl = $moduleModel->getDetailViewUrl($request);
        if ($saveLogo && $saveStamp && $status) {
            
        } else if (!$saveLogo || !$saveStamp) {
            $reloadUrl .= '&error=LBL_INVALID_IMAGE';
        } else {
            $reloadUrl = $moduleModel->getEditViewUrl() . '&error=LBL_FIELDS_INFO_IS_EMPTY';
        }
        header('Location: ' . $reloadUrl);
    }

}
