<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H8';

$current_user_parent_role_seq='H1::H2::H3::H4::H8';

$current_user_profiles=array(11,);

$profileGlobalPermission=array('1'=>0,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'13'=>0,'14'=>0,'15'=>0,'16'=>0,'18'=>0,'19'=>0,'20'=>0,'21'=>0,'22'=>0,'23'=>0,'24'=>0,'25'=>0,'26'=>0,'31'=>0,'33'=>0,'36'=>0,'38'=>0,'40'=>0,'42'=>0,'44'=>0,'45'=>0,'46'=>0,'48'=>0,'49'=>0,'50'=>0,'51'=>0,'52'=>0,'57'=>0,'58'=>0,'59'=>0,'60'=>0,'61'=>0,'62'=>0,'63'=>0,'64'=>0,'65'=>0,'66'=>0,'67'=>0,'68'=>0,'69'=>0,'70'=>0,'71'=>0,'72'=>0,'73'=>0,'74'=>0,'28'=>0,'3'=>0,);

$profileActionPermission=array(2=>array(0=>1,1=>1,2=>1,4=>0,),4=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,10=>0,),6=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,10=>0,),7=>array(0=>1,1=>1,2=>1,4=>0,),8=>array(0=>1,1=>1,2=>1,4=>0,6=>0,),9=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,),13=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,10=>0,),14=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,10=>0,),15=>array(0=>1,1=>1,2=>1,4=>0,),16=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,),18=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,10=>0,),19=>array(0=>1,1=>1,2=>1,4=>0,),20=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,),21=>array(0=>1,1=>1,2=>1,4=>0,),22=>array(0=>1,1=>1,2=>1,4=>0,),23=>array(0=>1,1=>1,2=>1,4=>0,),26=>array(0=>1,1=>1,2=>1,4=>0,),31=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,10=>0,),33=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,10=>1,),42=>array(0=>1,1=>1,2=>1,4=>0,),44=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,10=>0,),45=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,10=>0,),46=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,10=>1,),48=>array(0=>1,1=>1,2=>1,4=>0,),50=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,8=>1,),51=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,),52=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,),60=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,),61=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,),62=>array(0=>1,1=>1,2=>1,4=>0,5=>1,6=>1,8=>1,),63=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,),64=>array(0=>1,1=>1,2=>1,4=>0,5=>0,6=>0,8=>0,),65=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),66=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),67=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),68=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),69=>array(0=>1,1=>1,2=>1,3=>0,4=>0,),70=>array(0=>1,1=>1,2=>1,3=>0,4=>0,),71=>array(0=>1,1=>1,2=>1,3=>0,4=>0,),72=>array(0=>1,1=>1,2=>1,3=>0,4=>0,),73=>array(0=>1,1=>1,2=>1,3=>0,4=>0,),74=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),);

$current_user_groups=array(3,4,);

$subordinate_roles=array();

$parent_roles=array('H1','H2','H3','H4',);

$subordinate_roles_users=array();

$user_info=array('user_name'=>'consulta','is_admin'=>'off','user_password'=>'$1$co000000$koUURGmAnjGPUebe2ycT10','confirm_password'=>'$1$co000000$koUURGmAnjGPUebe2ycT10','first_name'=>'','last_name'=>'Consulta','roleid'=>'H8','email1'=>'informatica@tuagencia24.com','status'=>'Active','activity_view'=>'Today','lead_view'=>'Today','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'','department'=>'','phone_mobile'=>'','reports_to_id'=>'','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd-mm-yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'X4tC5vz5W1tsVfwP','time_zone'=>'UTC','currency_id'=>'2','currency_grouping_pattern'=>'123,456,789','currency_decimal_separator'=>'.','currency_grouping_separator'=>',','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'es_es','reminder_interval'=>'','asterisk_extension'=>'','use_asterisk'=>'0','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'1','rowheight'=>'medium','cedula'=>'','firma'=>'','ccurrency_name'=>'','currency_code'=>'VEF','currency_symbol'=>'Bs','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','currency_name'=>'Venezuela, Bolivares Fuertes','id'=>'33');
?>