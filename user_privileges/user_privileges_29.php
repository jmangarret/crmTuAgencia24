<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H5';

$current_user_parent_role_seq='H1::H2::H3::H4::H5';

$current_user_profiles=array(2,);

$profileGlobalPermission=array('1'=>0,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'13'=>0,'14'=>1,'15'=>0,'16'=>0,'18'=>0,'19'=>0,'20'=>1,'21'=>0,'22'=>0,'23'=>0,'24'=>0,'25'=>0,'26'=>0,'27'=>0,'30'=>0,'31'=>1,'32'=>0,'33'=>0,'34'=>0,'35'=>0,'36'=>0,'37'=>0,'38'=>1,'39'=>0,'40'=>1,'41'=>0,'42'=>1,'44'=>0,'45'=>0,'46'=>1,'47'=>1,'48'=>1,'49'=>1,'50'=>0,'51'=>1,'52'=>0,'53'=>0,'54'=>0,'55'=>0,'56'=>0,'57'=>1,'58'=>1,'59'=>1,'60'=>0,'61'=>0,'62'=>0,'28'=>0,);

$profileActionPermission=array(2=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),4=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,10=>0,),6=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,10=>0,),7=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,9=>0,10=>0,),8=>array(0=>0,1=>0,2=>1,3=>0,4=>0,6=>0,),9=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,),13=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,10=>0,),14=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>0,6=>0,10=>0,),15=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),16=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),18=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,10=>1,),19=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),20=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>0,6=>0,),21=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,),22=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,),23=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,),26=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),31=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>0,6=>0,10=>0,),33=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),35=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,8=>0,),42=>array(0=>0,1=>0,2=>1,3=>0,4=>0,),44=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>0,6=>0,10=>0,),45=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,10=>1,),46=>array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,10=>1,),47=>array(0=>1,1=>1,2=>1,3=>1,4=>1,),48=>array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,10=>1,),49=>array(0=>1,1=>1,2=>1,3=>1,4=>1,),50=>array(0=>1,1=>1,2=>1,3=>1,4=>0,5=>1,6=>1,8=>1,),51=>array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,8=>1,),52=>array(0=>0,1=>0,2=>1,3=>1,4=>0,5=>1,6=>1,8=>1,),60=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),61=>array(0=>0,1=>0,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),62=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,8=>1,),);

$current_user_groups=array(3,4,2,);

$subordinate_roles=array();

$parent_roles=array('H1','H2','H3','H4',);

$subordinate_roles_users=array();

$user_info=array('user_name'=>'wmarquez','is_admin'=>'off','user_password'=>'$1$wm000000$RsR9orHKxN/2cWEyIKVud1','confirm_password'=>'$1$wm000000$RsR9orHKxN/2cWEyIKVud1','first_name'=>'Wendy','last_name'=>'Marquez','roleid'=>'H5','email1'=>'wendyvenezuela@hotmail.com','status'=>'Active','activity_view'=>'Today','lead_view'=>'Today','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'','department'=>'','phone_mobile'=>'','reports_to_id'=>'','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd-mm-yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'CC9azLfrlHyEElP1','time_zone'=>'UTC','currency_id'=>'1','currency_grouping_pattern'=>'123,456,789','currency_decimal_separator'=>'.','currency_grouping_separator'=>',','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'es_es','reminder_interval'=>'','asterisk_extension'=>'','use_asterisk'=>'0','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'0','rowheight'=>'medium','ccurrency_name'=>'','currency_code'=>'USD','currency_symbol'=>'&#36;','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','currency_name'=>'USA, Dollars','id'=>'29');
?>