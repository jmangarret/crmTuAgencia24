<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_UpdateLogo_Action extends Settings_Vtiger_Basic_Action {

    public function process(Vtiger_Request $request) {
        $qualifiedModuleName = $request->getModule();
        $moduleModel = MultiCompany4you_CompanyDetails_Model::getInstance();

        $saveLogo = $securityError = false;
        $logoDetails = $_FILES['logo'];
        $fileType = explode('/', $logoDetails['type']);
        $fileType = $fileType[1];

        $logoContent = file_get_contents($logoDetails['tmp_name']);
        if (preg_match('(<\?php?(.*?))', $imageContent) != 0) {
            $securityError = true;
        }

        if (!$securityError) {
            if ($logoDetails['size'] && in_array($fileType, MultiCompany4you_CompanyDetails_Model::$logoSupportedFormats)) {
                $saveLogo = true;
            }

            if ($saveLogo) {
                $moduleModel->saveLogo();
                $moduleModel->set('logoname', ltrim(basename(' ' . Vtiger_Util_Helper::sanitizeUploadFileName($logoDetails['name'], vglobal('upload_badext')))));
                $moduleModel->save();
            }
        }

        $reloadUrl = $moduleModel->getIndexViewUrl();
        if ($securityError) {
            $reloadUrl .= '&error=LBL_IMAGE_CORRUPTED';
        } else if (!$saveLogo) {
            $reloadUrl .= '&error=LBL_INVALID_IMAGE';
        }
        header('Location: ' . $reloadUrl);
    }

}
