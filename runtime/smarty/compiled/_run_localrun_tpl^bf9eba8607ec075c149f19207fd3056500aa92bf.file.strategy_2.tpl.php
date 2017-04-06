<?php /* Smarty version Smarty 3.1.4, created on 2016-12-21 15:27:18
         compiled from "/home/work/ec_test_service/src/views/run/strategy_2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9864270715444c3c738cd79-55045332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf9eba8607ec075c149f19207fd3056500aa92bf' => 
    array (
      0 => '/home/work/ec_test_service/src/views/run/strategy_2.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9864270715444c3c738cd79-55045332',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5444c3c73cefd',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5444c3c73cefd')) {function content_5444c3c73cefd($_smarty_tpl) {?><table id="inter_strategy1" style="width: 100%;font-size:14px; color:#333333;display:none">
	<tr>
		<td width="8%">新EC</td>
        <td width="12%"><input type="radio" name="new_strategy" value="0" id="new_allstr_select" onchange="
		document.getElementById('new_definestr_list').style.display='none';"

		checked/>全部策略</td> 
        <td width="80%"></td>
	</tr>
	<tr>
		<td width="8%"></td>
        <td width="12%"><input type="radio" name="new_strategy" value="1" id="new_definestr_select"   onchange="document.getElementById('new_definestr_list').style.display='';"/>自定义策略：</td>
        <td width="80%">
        	<table  style="width: 100%;font-size:14px; color:#333333;display:none" id="new_definestr_list">
                <tr>    
                    <td width="25%"><input type="checkbox"  id="CodeLangStg5" value="1" checked >CodeLangStg</td>
                    <td width="25%">  <input type="checkbox"  id="MetaInfoStg5" value="MetaInfoStg" >MetaInfoStg</td>
                    <td width="25%"><input type="checkbox"  id="PageStrategyStg5" value="PageStrategyStg" >PageStrategyStg</td>
                    <td width="25%"><input type="checkbox"  id="RSSMobileStg5" value="RSSMobileStg" >RSSMobileStg</td>
                </tr>
				<tr>
                    <td width="25%"><input type="checkbox"  id="VareaMarkStg5" value="VareaMarkStg" >VareaMarkStg</td>
                    <td width="25%">  <input type="checkbox"  id="ContentTypeStg5" value="ContentTypeStg" >ContentTypeStg</td>
                    <td width="25%"><input type="checkbox"  id="MetaRobotsStg5" value="MetaRobotsStg" >MetaRobotsStg</td>
                    <td width="25%"><input type="checkbox"  id="ParsePackStg5" value="ParsePackStg" >ParsePackStg</td>
                </tr>
				<tr>
                    <td width="25%"><input type="checkbox"  id="StatusStg5" value="StatusStg" >StatusStg</td>
                    <td width="25%">  <input type="checkbox"  id="VhtmlTreeStg5" value="VhtmlTreeStg" >VhtmlTreeStg</td>
                    <td width="25%"><input type="checkbox"  id="IndexFreshnessStg5" value="IndexFreshnessStg" >IndexFreshnessStg</td>
                    <td width="25%"><input type="checkbox"  id="MultiSignStg5" value="MultiSignStg" >MultiSignStg</td>
                </tr>
                <tr>
                    <td width="25%"><input type="checkbox"  id="PoliticalFactorStg5" value="PoliticalFactorStg" >PoliticalFactorStg</td>
                    <td width="25%">  <input type="checkbox"  id="TitleContentStg5" value="TitleContentStg" >TitleContentStg</td>
                    <td width="25%"><input type="checkbox"  id="WiseMetaStg5" value="WiseMetaStg" >WiseMetaStg</td>
                    <td width="25%"><input type="checkbox"  id="LongSentSignStg5" value="LongSentSignStg" >LongSentSignStg</td>
                </tr>
				<tr>
                    <td width="25%"><input type="checkbox"  id="PublishTimeStg5" value="PublishTimeStg" >PublishTimeStg</td>
                    <td width="25%">  <input type="checkbox"  id="TransPassStg5" value="TransPassStg" >TransPassStg</td>
                    <td width="25%"><input type="checkbox"  id="WordDictStg5" value="WordDictStg" >WordDictStg</td>
                </tr>
			</table>
		</td>       
	</tr>
	    <tr>    
        <td width="8%">旧EC</td>
        <td width="12%"><input type="radio" name="old_strategy" value="0" id="old_allstr_select" onchange="document.getElementById('old_definestr_list').style.display='none';" checked/>全部策略</td> 
        <td width="80%"></td>
    </tr>   
    <tr>    
		<td width="8%"></td>
        <td width="12%"><input type="radio" name="old_strategy" value="1" id="old_definestr_select" onchange="document.getElementById('old_definestr_list').style.display='';"/>自定义策略：</td>
        <td width="80%">
        	<table  style="width: 100%;font-size:14px; color:#333333;display:none" id="old_definestr_list">
                <tr>    
                    <td width="25%"><input type="checkbox"  id="CodeLangStg6" value="CodeLangStg" >CodeLangStg</td>
                    <td width="25%">  <input type="checkbox"  id="MetaInfoStg6" value="MetaInfoStg" >MetaInfoStg</td>
                    <td width="25%"><input type="checkbox"  id="PageStrategyStg6" value="PageStrategyStg" >PageStrategyStg</td>
                    <td width="25%"><input type="checkbox"  id="RSSMobileStg6" value="RSSMobileStg" >RSSMobileStg</td>
                </tr>
				<tr>
                    <td width="25%"><input type="checkbox"  id="VareaMarkStg6" value="VareaMarkStg" >VareaMarkStg</td>
                    <td width="25%">  <input type="checkbox"  id="ContentTypeStg6" value="ContentTypeStg" >ContentTypeStg</td>
                    <td width="25%"><input type="checkbox"  id="MetaRobotsStg6" value="MetaRobotsStg" >MetaRobotsStg</td>
                    <td width="25%"><input type="checkbox"  id="ParsePackStg6" value="ParsePackStg" >ParsePackStg</td>
                </tr>
				<tr>
                    <td width="25%"><input type="checkbox"  id="StatusStg6" value="StatusStg" >StatusStg</td>
                    <td width="25%">  <input type="checkbox"  id="VhtmlTreeStg6" value="VhtmlTreeStg" >VhtmlTreeStg</td>
                    <td width="25%"><input type="checkbox"  id="IndexFreshnessStg6" value="IndexFreshnessStg" >IndexFreshnessStg</td>
                    <td width="25%"><input type="checkbox"  id="MultiSignStg6" value="MultiSignStg" >MultiSignStg</td>
                </tr>
                <tr>
                    <td width="25%"><input type="checkbox"  id="PoliticalFactorStg6" value="PoliticalFactorStg" >PoliticalFactorStg</td>
                    <td width="25%">  <input type="checkbox"  id="TitleContentStg6" value="TitleContentStg" >TitleContentStg</td>
                    <td width="25%"><input type="checkbox"  id="WiseMetaStg6" value="WiseMetaStg" >WiseMetaStg</td>
                    <td width="25%"><input type="checkbox"  id="LongSentSignStg6" value="LongSentSignStg" >LongSentSignStg</td>
                </tr>
				<tr>
                    <td width="25%"><input type="checkbox"  id="PublishTimeStg6" value="PublishTimeStg" >PublishTimeStg</td>
                    <td width="25%">  <input type="checkbox"  id="TransPassStg6" value="TransPassStg" >TransPassStg</td>
                    <td width="25%"><input type="checkbox"  id="WordDictStg6" value="WordDictStg" >WordDictStg</td>
                </tr>
			</table>
		</td>       
    </tr>   
	</table>
<?php }} ?>