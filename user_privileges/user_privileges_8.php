<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H3';

$current_user_parent_role_seq='H1::H2::H3';

$current_user_profiles=array(5,);

$profileGlobalPermission=array('1'=>1,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'13'=>0,'14'=>0,'15'=>0,'16'=>0,'18'=>0,'19'=>0,'20'=>0,'21'=>0,'22'=>0,'23'=>0,'24'=>0,'25'=>0,'26'=>0,'27'=>0,'30'=>0,'31'=>0,'32'=>0,'33'=>0,'34'=>1,'35'=>1,'36'=>0,'37'=>1,'38'=>0,'39'=>1,'40'=>0,'41'=>1,'42'=>0,'44'=>0,'45'=>0,'46'=>0,'47'=>1,'48'=>1,'49'=>0,'50'=>0,'51'=>0,'52'=>0,'53'=>0,'54'=>0,'55'=>0,'56'=>0,'57'=>0,'58'=>0,'59'=>0,'60'=>0,'61'=>0,'62'=>1,'63'=>0,'64'=>0,'65'=>0,'66'=>0,'67'=>0,'68'=>0,'69'=>0,'70'=>0,'71'=>0,'72'=>0,'73'=>0,'74'=>0,'75'=>0,'28'=>0,'3'=>0,);

$profileActionPermission=array(2=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),4=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,10=>0,),6=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,10=>0,),7=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,9=>0,10=>0,),8=>array(0=>0,1=>0,2=>0,3=>0,4=>0,6=>0,),9=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,),13=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,10=>0,),14=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),15=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),16=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),18=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),19=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),20=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),21=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),22=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),23=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),26=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),31=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),33=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,10=>1,),35=>array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,8=>1,),42=>array(0=>0,1=>0,2=>1,3=>1,4=>0,),44=>array(0=>0,1=>0,2=>1,3=>1,4=>0,5=>1,6=>1,10=>1,),45=>array(0=>0,1=>0,2=>0,3=>1,4=>0,5=>1,6=>1,10=>1,),46=>array(0=>0,1=>0,2=>1,3=>1,4=>0,5=>1,6=>1,10=>1,),47=>array(0=>1,1=>1,2=>1,3=>1,4=>1,),48=>array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,10=>1,),49=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),50=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>1,),51=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,),52=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>0,),60=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),61=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),62=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),63=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),64=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),65=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,),66=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),67=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),68=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),69=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),70=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),71=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),72=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),73=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),74=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),);

$current_user_groups=array(3,);

$subordinate_roles=array('H4','H11','H5','H12','H13','H14','H15','H16','H17','H18','H19','H20','H21','H9','H6','H7','H8',);

$parent_roles=array('H1','H2',);

$subordinate_roles_users=array('H4'=>array(12,19,27,32,34,35,38,44,45,48,54,56,),'H11'=>array(),'H5'=>array(7,16,17,20,28,31,40,41,46,49,50,51,52,53,55,57,58,),'H12'=>array(61,),'H13'=>array(62,),'H14'=>array(63,),'H15'=>array(59,),'H16'=>array(65,),'H17'=>array(66,),'H18'=>array(67,),'H19'=>array(68,),'H20'=>array(69,),'H21'=>array(70,),'H9'=>array(64,),'H6'=>array(18,25,30,37,42,43,47,),'H7'=>array(26,36,),'H8'=>array(33,),);

$user_info=array('user_name'=>'roberto','is_admin'=>'off','user_password'=>'$1$ro000000$5sP0nfW4H7mdIEn8/I4rg0','confirm_password'=>'$1$ro000000$5sP0nfW4H7mdIEn8/I4rg0','first_name'=>'Roberto','last_name'=>'Somoza','roleid'=>'H3','email1'=>'roberto.somoza@tuagencia24.com','status'=>'Active','activity_view'=>'Today','lead_view'=>'Today','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'Asesor de Viajes','phone_work'=>'00582812818050','department'=>'Travel&amp;Tecnologia','phone_mobile'=>'00584128009482','reports_to_id'=>'','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd-mm-yyyy','signature'=>'Roberto Somoza','description'=>'','address_street'=>'Av. Principal de Lecheria, C.C. Los Delfines, PB1.','address_city'=>'Lecheria','address_state'=>'Anzoategui','address_postalcode'=>'','address_country'=>'Venezuela','accesskey'=>'YigwncBNwMlydoi2','time_zone'=>'UTC','currency_id'=>'2','currency_grouping_pattern'=>'123,456,789','currency_decimal_separator'=>'.','currency_grouping_separator'=>',','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'1','theme'=>'softed','language'=>'es_mx','reminder_interval'=>'','asterisk_extension'=>'','use_asterisk'=>'1','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'1','dayoftheweek'=>'Sunday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'1','rowheight'=>'medium','cedula'=>'788888','firma'=>'1007RSGS |##| BLAJ06403 |##|  1007 RS SU |##| 1007RSSU |##| BLAJ06406 |##| ','ccurrency_name'=>'','currency_code'=>'VEF','currency_symbol'=>'Bs','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','currency_name'=>'Venezuela, Bolivares Fuertes','id'=>'8');
?>