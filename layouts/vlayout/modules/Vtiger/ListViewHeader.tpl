{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
-->*}
{strip}
	<div class="listViewPageDiv">
		<div class="listViewTopMenuDiv noprint">
			<div class="listViewActionsDiv row-fluid">
				<span class="btn-toolbar span4">
					<span class="btn-group listViewMassActions">
						{if count($LISTVIEW_MASSACTIONS) gt 0 || $LISTVIEW_LINKS['LISTVIEW']|@count gt 0}
							<button class="btn dropdown-toggle" data-toggle="dropdown"><strong>{vtranslate('LBL_ACTIONS', $MODULE)}</strong>&nbsp;&nbsp;<i class="caret"></i></button>
							<ul class="dropdown-menu">
								{foreach item="LISTVIEW_MASSACTION" from=$LISTVIEW_MASSACTIONS name=actionCount}
									<li id="{$MODULE}_listView_massAction_{Vtiger_Util_Helper::replaceSpaceWithUnderScores($LISTVIEW_MASSACTION->getLabel())}">
										<a href="javascript:void(0);" {if stripos($LISTVIEW_MASSACTION->getUrl(), 'javascript:')===0}onclick='{$LISTVIEW_MASSACTION->getUrl()|substr:strlen("javascript:")};'{else} onclick="Vtiger_List_Js.triggerMassAction('{$LISTVIEW_MASSACTION->getUrl()}')"{/if} >{vtranslate($LISTVIEW_MASSACTION->getLabel(), $MODULE)}</a></li>
									{if $smarty.foreach.actionCount.last eq true}				
										<li class="divider"></li>
									{/if}
								{/foreach}	

								{if $LISTVIEW_LINKS['LISTVIEW']|@count gt 0}
									{foreach item=LISTVIEW_ADVANCEDACTIONS from=$LISTVIEW_LINKS['LISTVIEW']}
										<li id="{$MODULE}_listView_advancedAction_{Vtiger_Util_Helper::replaceSpaceWithUnderScores($LISTVIEW_ADVANCEDACTIONS->getLabel())}">
											<a {if stripos($LISTVIEW_ADVANCEDACTIONS->getUrl(), 'javascript:')===0} 
												href="javascript:void(0);" 
												onclick='{$LISTVIEW_ADVANCEDACTIONS->getUrl()|substr:strlen("javascript:")};'
												{else} 
												href='{$LISTVIEW_ADVANCEDACTIONS->getUrl()}' 
												{/if}>
												{vtranslate($LISTVIEW_ADVANCEDACTIONS->getLabel(), $MODULE)}
											</a>
										</li>
									{/foreach}

								{/if}
							</ul>
						{/if}
					</span>
					{foreach item=LISTVIEW_BASICACTION from=$LISTVIEW_LINKS['LISTVIEWBASIC']}
						<span class="btn-group">
							<button id="{$MODULE}_listView_basicAction_{Vtiger_Util_Helper::replaceSpaceWithUnderScores($LISTVIEW_BASICACTION->getLabel())}" class="btn addButton" {if stripos($LISTVIEW_BASICACTION->getUrl(), 'javascript:')===0} onclick='{$LISTVIEW_BASICACTION->getUrl()|substr:strlen("javascript:")};'{else} onclick='window.location.href="{$LISTVIEW_BASICACTION->getUrl()}"'{/if}><i class="icon-plus icon-white"></i>&nbsp;<strong>{vtranslate($LISTVIEW_BASICACTION->getLabel(), $MODULE)}</strong></button>								
			   		     
						</span>
					{/foreach}

					<!-- jmangarret BOTONES DE ACCION POR LOTE EN EL HEADER dic2015, ene2016 !-->				   
					{if $MODULE eq 'Localizadores' && $USER_MODEL->getParentRoleSequence()|count_characters<=18}
					<span class="btn-group">
							<a href="javascript:void(0);">
							<button id="{$MODULE}_listView_basicAction_Process" class="btn addButton">
								<i class="icon-plus icon-white"></i>&nbsp;
								<strong>Procesar</strong> 
							</button>
							</a>
					</span>
					<script type="text/javascript">										 
					 $(document).ready(function() {	
				 		$('#{$MODULE}_listView_basicAction_Process').click(function(){
					        var ids1 = new Array();						 
					        $("input[class=listViewEntriesCheckBox]:checked").each(function() {							   					        	
					            ids1.push($(this).val());						            
					        });												        
				            var ajax_data1 = {
				            "userid" : $("#current_user_id").val(),						
							"accion" : "procesarLocalizadores",					
							"id" : ids1					
							};		
							jQuery.ajax({
								data: ajax_data1,
								url: 'modules/Localizadores/ajaxProcesarList_Loc.php',
								type: 'get',
								success: function(response){														
									if (response!='')
									bootbox.alert(response);
								}
							});
					    });	
					});						
					</script>

					{/if}

					{if $MODULE eq 'Boletos' && $USER_MODEL->getParentRoleSequence()|count_characters<=18}
					<span class="btn-group">
							<a href="javascript:void(0);">
							<button id="{$MODULE}_listView_basicAction_Anular" class="btn addButton">
								<i class="icon-plus icon-white"></i>&nbsp;
								<strong>Anular</strong> 
							</button>
							</a>
					</span>
					<script type="text/javascript">
							$('#{$MODULE}_listView_basicAction_Anular').click(function(){
					        var ids2 = new Array();						 
					        $("input[class=listViewEntriesCheckBox]:checked").each(function() {							   
					            ids2.push($(this).val());						            
					        });												        
				            var ajax_data2 = {
				            "userid" : $("#current_user_id").val(),						
							"accion" : "anularBoletosPorLote",					
							"id" : ids2				
							};		
							jQuery.ajax({
								data: ajax_data2,
								url: 'modules/Boletos/ajaxProcesarList_Boletos.php',
								type: 'get',
								success: function(response){														
									if (response!='')
									bootbox.alert(response);
								}
							});
					    });
					</script>
					{/if}
				<!-- fin jmangarret dic2015, ene2016 !-->	

				</span>
			<span class="btn-toolbar span4">
				<span class="customFilterMainSpan btn-group">
					<!--Modified by jmangarret 16jun2015 -->
					{if $ROLEID<>'H9'}
					{if $CUSTOM_VIEWS|@count gt 0}

						<select id="customFilter" style="width:350px;">
							{foreach key=GROUP_LABEL item=GROUP_CUSTOM_VIEWS from=$CUSTOM_VIEWS}
							<optgroup label=' {if $GROUP_LABEL eq 'Mine'} &nbsp; {else if} {vtranslate($GROUP_LABEL)} {/if}' >
									{foreach item="CUSTOM_VIEW" from=$GROUP_CUSTOM_VIEWS}
										<option  data-editurl="{$CUSTOM_VIEW->getEditUrl()}" data-deleteurl="{$CUSTOM_VIEW->getDeleteUrl()}" data-approveurl="{$CUSTOM_VIEW->getApproveUrl()}" data-denyurl="{$CUSTOM_VIEW->getDenyUrl()}" data-editable="{$CUSTOM_VIEW->isEditable()}" data-deletable="{$CUSTOM_VIEW->isDeletable()}" data-pending="{$CUSTOM_VIEW->isPending()}" data-public="{$CUSTOM_VIEW->isPublic() && $CURRENT_USER_MODEL->isAdminUser()}" id="filterOptionId_{$CUSTOM_VIEW->get('cvid')}" value="{$CUSTOM_VIEW->get('cvid')}" data-id="{$CUSTOM_VIEW->get('cvid')}" {if $VIEWID neq '' && $VIEWID neq '0'  && $VIEWID == $CUSTOM_VIEW->getId()} selected="selected" {elseif ($VIEWID == '' or $VIEWID == '0')&& $CUSTOM_VIEW->isDefault() eq 'true'} selected="selected" {/if} class="filterOptionId_{$CUSTOM_VIEW->get('cvid')}">{if $CUSTOM_VIEW->get('viewname') eq 'All'}{vtranslate($CUSTOM_VIEW->get('viewname'), $MODULE)} {vtranslate($MODULE, $MODULE)}{else}{vtranslate($CUSTOM_VIEW->get('viewname'), $MODULE)}{/if}{if $GROUP_LABEL neq 'Mine'} [ {$CUSTOM_VIEW->getOwnerName()} ]  {/if}</option>
									{/foreach}
								</optgroup>
							{/foreach}
							{if $FOLDERS neq ''}
								<optgroup id="foldersBlock" label='{vtranslate('LBL_FOLDERS', $MODULE)}' >
									{foreach item=FOLDER from=$FOLDERS}
										<option data-foldername="{$FOLDER->getName()}" {if decode_html($FOLDER->getName()) eq $FOLDER_NAME} selected=""{/if} data-folderid="{$FOLDER->get('folderid')}" data-deletable="{!($FOLDER->hasDocuments())}" class="filterOptionId_folder{$FOLDER->get('folderid')} folderOption{if $FOLDER->getName() eq 'Default'} defaultFolder {/if}" id="filterOptionId_folder{$FOLDER->get('folderid')}" data-id="{$DEFAULT_CUSTOM_FILTER_ID}">{$FOLDER->getName()}</option>
									{/foreach}
								</optgroup>
							{/if}
						</select>
						<span class="filterActionsDiv hide">
							<hr>
							<ul class="filterActions">
								
								<li data-value="create" id="createFilter" data-createurl="{$CUSTOM_VIEW->getCreateUrl()}"><i class="icon-plus-sign"></i> {vtranslate('LBL_CREATE_NEW_FILTER')} </li>
								
							</ul>
						</span>
						<img class="filterImage" src="{'filter.png'|vimage_path}" style="display:none;height:13px;margin-right:2px;vertical-align: middle;">
					{else}
						<input type="hidden" value="0" id="customFilter" />
					{/if}
					{/if}
					<!-- fin jmangarret 16jun2015 !-->
				</span>
			</span>
			<span class="hide filterActionImages pull-right">
				<i title="{vtranslate('LBL_DENY', $MODULE)}" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i>
				<i title="{vtranslate('LBL_APPROVE', $MODULE)}" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i>
				<i title="{vtranslate('LBL_DELETE', $MODULE)}" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i>
				<i title="{vtranslate('LBL_EDIT', $MODULE)}" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right"></i>
			</span>
			<span class="span4 btn-toolbar">
				{include file='ListViewActions.tpl'|@vtemplate_path}
			</span>
		</div>
		</div>

	<div class="listViewContentDiv" id="listViewContents">

	<!-- jmangarret BUSQUEDA POR REPORTE PARA SATELITES feb2016!-->				   
	<!-- jmangarret BLOQUEO DE FILTROS PARA PERFIL SATELITES dic2016!-->				   
	{if $MODULE eq 'Localizadores' && $USER_MODEL->getParentRoleSequence()|count_characters<=18}	
		<form action="" name="frmBuscar" method="post" onSubmit="return false">
			<table class="table showInlineTable">
				<tr>
					<!--1/08/16 RURIEPE SELECT PARA TIPO DE VENTAS-->
					<td class="fieldLabel wide" >
						<span> Tipo de Venta: </span><br>
						<select class="tventa-select" id="tventa-select">
							<option value="1">Todas</option>
							<option value="2">Ventas Propias</option>
							<option value="3">Ventas Satélites</option>
							<option value="4">Ventas SOTO</option>
						</select>
					</td>
					<td class="fieldLabel wide">
						<span> Localizador: </span><br>
						<input name="text-localizador" id="text-localizador" >
					</td>
					<td class="fieldLabel wide">
						<span> Aerolínea: </span><br>
						<select class="aerolinea-select" id="aerolinea-select">
							<option value="">--Seleccione--</option>
						</select>
					</td>
					<!--<td class="fieldLabel wide">
						<span> Nº de Boleto: </span><br>
						<input type="text" name="text-boleto" id="text-boleto">
					</td>-->
					<td class="fieldLabel wide">
						<span> Asesores: </span><br>
						<select class="asesoras-select" id="asesoras-select">
							<option value="">--Seleccione--</option>
						</select>
					</td>
					<td class="fieldLabel wide">
						<span> Satelite: </span><br>
						<select class="chzn-single" id="chzn-single">
							<option value="">--Seleccione--</option>
						</select>
					</td>
					<td class="fieldLabel wide">
						<a href="javascript:void(0);">
						<button  id="{$MODULE}_listView_basicAction_Buscar" class="btn">								
						<strong>Buscar</strong> 
						</button>
						<div id="loader"></div>
						</a>
						<span id="searchIcon" class="add-on search-icon"><i class="icon-white icon-search "></i></span> 
					</td>
				</tr><tr>
					<td class="fieldLabel wide">
						<span> GDS: </span><br>
						<select class="gds-select" id="gds-select">
							<option value="">--Seleccione--</option>
						</select>
					</td>
					<td class="fieldLabel wide">
						<span> Estatus: </span><br>
						<select class="option-estatus" id="option-estatus">
							<option value="">--Seleccione--</option>
						</select>
					</td>
					<!--11/08/16 RURIEPE SELECT PARA TIPO DE VENTAS-->
					<td class="fieldLabel wide" >
						<span> Procesados: </span><br>
						<select class="procesado-select" id="procesado-select">
							<option value="">--Seleccione--</option>
							<option value="1">Procesado</option>
							<option value="0">No Procesado</option>
						</select>
					</td>
					<td class="fieldLabel wide">
						<span> Desde: </span><br>
						<input type="date" class="dateField" value="" data-date-format="dd-mm-yyyy" name="fechaemision1" id="fechaemision1"></td><td class="fieldLabel wide">
						<span> Hasta: </span><br>
						<input type="date" class="dateField" value="" data-date-format="dd-mm-yyyy" name="fechaemision2" id="fechaemision2">
					</td>
						
					<!--<td class="fieldLabel wide">
						<span> Procesados: </span>
						<input type="checkbox" name="checkbox-procesado" id="checkbox-procesado"> 
						</td>-->
						<td class="fieldLabel wide">
						<a href="javascript:void(0);" title="Busque y Marque los boletos a exportar">
						<button  id="{$MODULE}_listView_basicAction_Excel" class="btn">								
						<strong>Excel</strong> 
						</button>
						<div id="loader"></div>
						</a>
					</td>
						
				</tr>
			</table>	
		</form>	
		<script type="text/javascript">										 
		 $(document).ready(function() {	
		 		var ajax_data1 ={
		 			"accion": "select_satelite"
		 		};
		 		jQuery.ajax({
		 			data: ajax_data1,					
					url: 'modules/Localizadores/ajaxReporteSatelites.php',
					type: 'get',
					success: function(responses){								
						$("#chzn-single").append(responses);
					}
				});	

				var ajax_data2 ={
					"accion" : "select_gds"
				};
		 		jQuery.ajax({
		 			data: ajax_data2,	
					url: 'modules/Localizadores/ajaxReporteSatelites.php',
					type: 'get',
					success: function(responses){								
						$("#gds-select").append(responses);
					}
				});	
				var ajax_data3={
					"accion" : "select_status"
				};
				jQuery.ajax({
					data: ajax_data3,
					url: 'modules/Localizadores/ajaxReporteSatelites.php',
					type: 'get',
					success: function(responses){								
						$("#option-estatus").append(responses);
					}
				});

				var ajax_data4={
					"accion" : "select_asesoras"
				};
				jQuery.ajax({
					data: ajax_data4,
					url: 'modules/Localizadores/ajaxReporteSatelites.php',
					type: 'get',
					success: function(responses){								
						$("#asesoras-select").append(responses);
					}
				});
				var ajax_data5={
					"accion" : "select_aerolinea"
				};
				jQuery.ajax({
					data: ajax_data5,
					url: 'modules/Localizadores/ajaxReporteSatelites.php',
					type: 'get',
					success: function(responses){								
						$("#aerolinea-select").append(responses);
					}
				});

	 		$('#{$MODULE}_listView_basicAction_Buscar').click(function(){											        
	            var ajax_data = {
	            "userid"      : $("#current_user_id").val(),						
				"accion"      : "listarBusqueda",
				"satelite"    : $("#chzn-single").val(),
				"gds"  	 	  : $("#gds-select").val(),
				/*"proc"	  	  : $('#checkbox-procesado').is(':checked'),*/
				"fecha_desde" : $("#fechaemision1").val(),
				"fecha_hasta" : $("#fechaemision2").val(),
				"localizador" : $("#text-localizador").val(),
				/*"boleto"	  : $("#text-boleto").val(),*/
				"estatus"	  : $("#option-estatus").val(),
				"asesoras"	  : $("#asesoras-select").val(),
				"tventa"	  : $("#tventa-select").val(),
				"procesado"	  : $("#procesado-select").val(),
				"aerolinea"	  : $("#aerolinea-select").val()
				};	
				$('div.listViewEntriesDiv.contents-bottomscroll').html("<center><img src='themes/images/loading.gif'></center>");
				$.ajax({
					data: ajax_data,
					url: 'modules/Localizadores/ajaxReporteSatelites.php',
					type: 'get',
					success: function(response){								
						$("div.listViewEntriesDiv.contents-bottomscroll").html(response);
					}
				});
		    });	
		});						
		</script>
		<script type="text/javascript">										 
		 $(document).ready(function() {	
	 		$('#{$MODULE}_listView_basicAction_Excel').click(function(){
		        var idsArray = new Array();						 
		        $("input[class=listViewEntriesCheckBox]:checked").each(function() {				   					        	
		            idsArray.push($(this).attr('boleto-id'));						            
		        });				
		        var chequeados=idsArray.length;								        		       
		        if (chequeados>0){
		            var ajax_data1 = {
		            "userid" : $("#current_user_id").val(),						
					"accion" : "excelLocalizadores",					
					"id" : idsArray					
					};		
					jQuery.ajax({
						data: ajax_data1,
						url: 'modules/Localizadores/ajaxProcesarList_Loc.php',
						type: 'POST',
						success: function(response){														
							var url='data:application/vnd.ms-excel,'+encodeURIComponent(response);
							location.href=url;
							return false;
						}
					});
				}else{
					alert("Debe Buscar y Marcar los boletos a exportar...");
					return false;
				}
		    });	
		});						
		</script>


	{/if}
	<!--fin jmangarret BUSQUEDA POR REPORTE PARA SATELITES feb2016!-->	

	<!-- RURIEPE 1/08/16  - FILTROS(SELECT PARA LA BUSQUEDA DE INFORMACION)-->				   
	{if $MODULE eq 'ComisionSatelites'}	
		<form action="" name="frmBuscar" method="post" onSubmit="return false">
			<table class="table showInlineTable">
				<tr>
					<td class="fieldLabel" width="250">
						<span> Satélite: </span><br>
						<select class="option-satelite" id="option-satelite">
							<option value="">--Seleccione--</option>
						</select>
					</td>
					<td class="fieldLabel" width="250">
						<span> Tipo de Comisión: </span><br>
						<select class="option-tcomision" id="option-tcomision">
							<option value="">--Seleccione--</option>
						</select>
					</td>

					<td class="fieldLabel wide">
						<a href="javascript:void(0);">
							<button id="{$MODULE}_listView_basicAction_Buscar2" class="btn">	
						 		<strong>Buscar</strong> 
							</button>
						</a>
						<span id="searchIcon" class="add-on search-icon"><i class="icon-white icon-search "></i></span>
					</td>
				</tr>
			</table>	
		</form>	
		<script type="text/javascript">										 
		 $(document).ready(function() {	
		 		var ajax_data1 ={
		 			"accion": "select_satelite"
		 		};
		 		jQuery.ajax({
		 			data: ajax_data1,					
					url: 'modules/ComisionSatelites/ajaxReporteComisiones.php',
					type: 'get',
					success: function(responses){								
						$("#option-satelite").append(responses);
					}
				});	

				var ajax_data2={
					"accion" : "select_tcomision"
				};
				jQuery.ajax({
					data: ajax_data2,
					url: 'modules/ComisionSatelites/ajaxReporteComisiones.php',
					type: 'get',
					success: function(responses){								
						$("#option-tcomision").append(responses);
					}
				});


	 		$('#{$MODULE}_listView_basicAction_Buscar2').click(function(){											        
	            var ajax_data = {
	            "userid"      : $("#current_user_id").val(),						
				"accion"      : "listarBusqueda",
				"satelite"    : $("#option-satelite").val(),
				"tcomision"   : $("#option-tcomision").val()
				};	
				jQuery.ajax({
					data: ajax_data,
					url: 'modules/ComisionSatelites/ajaxReporteComisiones.php',
					type: 'post',
					success: function(response){								
						$("div.listViewEntriesDiv.contents-bottomscroll").html(response);
					}
				});
		    });	
		});						
		</script>

	{/if}			   
{/strip}