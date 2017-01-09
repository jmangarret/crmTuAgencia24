<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

require_once('include/utils/utils.php');

class MultiCompany4youHandler extends VTEventHandler {

    public function handleEvent($handlerType, $entityData) {
        if ($entityData->focus->mode != 'edit') {
            $x0b = PearDatabase::getInstance();$x0c = $entityData->getModuleName();$x0e = vglobal('vtiger_current_version');$x0f = $x0b->pquery("S\105\114E\103\x54\x20\x76\145\x72sion F\x52\x4fM\040\151\164\x734y\157\165\137\x6d\x75\x6c\x74\x69\143\157\155\160\141\156\171\064\x79\x6f\165\x5fver\x73ion\040\x57HE\122E v\x65\162\163ion\075?", array($x0e));if ($x0f && $x0b->num_rows($x0f)) {$x10 = $x0b->pquery("\123E\x4c\105C\124 \164a\x62\151\144\x20FR\117M \x76\164\151\147\x65\162\137\164\141\x62\x20\x49\116N\x45R\x20\112OI\x4e\040\151t\1634you_mu\x6c\x74ic\157\155\160\x61\x6ey\064\x79\x6fu_\143\156\137\155o\144u\154\145\163\x20O\116\x20\x74\x61bid\x3dt\141\142\x5fid \127\x48E\x52\x45\040\x6e\x61\x6d\145=\x3f", array($x0c));if ($x0b->num_rows($x10) > 0) { $x11 = $x0b->fetchByAssoc($x10);$x12 = $x11['tabid'];$x13 = MultiCompany4you_CustomRecordNumbering_Model::getInstance($x0c, $x12);$x14 = $x13->setModuleSeqNumber("\151\156c\x72\x65\x6de\x6e\x74", $x0c, '', '', MultiCompany4you_CustomRecordNumbering_Model::getCompanyForUser($entityData->focus->column_fields['assigned_user_id']));if ($x14) {$x15 = $x0b->pquery("\x53E\x4c\x45\103T\x20\x63olum\156\x6e\x61m\x65 \106R\x4f\115\040vt\x69\x67\145\162\x5f\x66i\x65\154d\040W\110\105RE t\141\142\x69\144\x20\075 \077 \101ND\040uit\171pe\040\075\040\x34", Array($x12));$x16 = $x0b->fetchByAssoc($x15);$x0b->query("\125\120\x44\x41T\x45\040" . $entityData->focus->table_name . " \123ET\x20" . $x16['columnname'] . "='" . $x14 . "'\x20\x57\110\x45\122\105\x20" . $entityData->focus->table_index . "=" . $entityData->focus->id);$x13->decrementStandardNumbering($x0c);}}}
        }
    }
    
}
