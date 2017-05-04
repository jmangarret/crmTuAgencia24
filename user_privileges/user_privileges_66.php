<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H17';

$current_user_parent_role_seq='H1::H2::H3::H4::H5::H17';

$current_user_profiles=array(14,);

$profileGlobalPermission=array('1'=>1,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>1,'4'=>0,'6'=>0,'7'=>1,'8'=>0,'9'=>1,'10'=>1,'13'=>0,'14'=>1,'15'=>0,'16'=>1,'18'=>1,'19'=>1,'20'=>1,'21'=>1,'22'=>1,'23'=>1,'24'=>1,'25'=>1,'26'=>1,'31'=>1,'33'=>1,'36'=>1,'38'=>1,'40'=>1,'42'=>0,'44'=>1,'45'=>1,'46'=>1,'48'=>1,'49'=>1,'50'=>1,'51'=>1,'52'=>1,'57'=>1,'58'=>1,'59'=>1,'60'=>1,'61'=>1,'62'=>1,'63'=>1,'64'=>1,'65'=>1,'66'=>1,'67'=>1,'68'=>1,'69'=>1,'70'=>1,'71'=>1,'72'=>1,'73'=>1,'74'=>1,'75'=>1,'76'=>0,'28'=>1,'3'=>0,);

$profileActionPermission=array(2=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),4=>array(0=>0,1=>0,2=>1,4=>0,5=>0,6=>0,8=>0,10=>0,),6=>array(0=>0,1=>0,2=>1,4=>0,5=>0,6=>0,8=>0,10=>0,),7=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,9=>0,10=>0,),8=>array(0=>1,1=>1,2=>1,4=>0,6=>0,),9=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,),13=>array(0=>0,1=>0,2=>1,4=>0,5=>0,6=>0,8=>0,10=>0,),14=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),15=>array(0=>1,1=>1,2=>1,4=>0,),16=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,),18=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),20=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,),21=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,),22=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,),23=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,),31=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),33=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),42=>array(0=>0,1=>0,2=>1,4=>0,),44=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),45=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),46=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),48=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,10=>0,),50=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),51=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),52=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),60=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),61=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),62=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),63=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),64=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),65=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),66=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),67=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),68=>array(0=>1,1=>1,2=>1,4=>1,5=>0,6=>0,8=>0,),76=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),);

$current_user_groups=array(60,);

$subordinate_roles=array();

$parent_roles=array('H1','H2','H3','H4','H5',);

$subordinate_roles_users=array();

$user_info=array('user_name'=>'turistour','is_admin'=>'off','user_password'=>'$1$tu000000$wF.dEieo0LHPWZ30v2CMi1','confirm_password'=>'$1$tu000000$wF.dEieo0LHPWZ30v2CMi1','first_name'=>'Turistour','last_name'=>'Satelite','roleid'=>'H17','email1'=>'reservasturistour.ve@gmail.com','status'=>'Active','activity_view'=>'Today','lead_view'=>'Today','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'0281-6351045','department'=>'','phone_mobile'=>'','reports_to_id'=>'','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd-mm-yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'bXmcnhi6WgK4GDAE','time_zone'=>'Pacific/Midway','currency_id'=>'2','currency_grouping_pattern'=>'123,456,789','currency_decimal_separator'=>'.','currency_grouping_separator'=>',','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'es_es','reminder_interval'=>'','asterisk_extension'=>'','use_asterisk'=>'0','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'0','rowheight'=>'medium','cedula'=>'J-40401420-9','firma'=>'','ccurrency_name'=>'','currency_code'=>'VEF','currency_symbol'=>'Bs','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','currency_name'=>'Venezuela, Bolivares Fuertes','id'=>'66');
?>