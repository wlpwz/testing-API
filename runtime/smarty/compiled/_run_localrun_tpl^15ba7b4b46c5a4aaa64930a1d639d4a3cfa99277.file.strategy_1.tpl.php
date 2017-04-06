<?php /* Smarty version Smarty 3.1.4, created on 2016-12-21 15:27:18
         compiled from "/home/work/ec_test_service/src/views/run/strategy_1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2902538765444c3c7291ff6-18288830%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15ba7b4b46c5a4aaa64930a1d639d4a3cfa99277' => 
    array (
      0 => '/home/work/ec_test_service/src/views/run/strategy_1.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2902538765444c3c7291ff6-18288830',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5444c3c7389c1',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5444c3c7389c1')) {function content_5444c3c7389c1($_smarty_tpl) {?><tr>
	<td>策略执行</td>
	<td style="width:90%;">
    	<table id="chin_strategy1" style="width: 100%;font-size:14px; color:#333333;">
	        <tr>
               <td width="8%">新EC1</td>
               <td width="12%"><input type="radio" name="new1_strategy" value="0" id="new1_allstr_select" checked onchange="
					document.getElementById('new1_definestr_list1').style.display='none';
					document.getElementById('new1_definestr_list2').style.display='none';ec1check();
				"/>全部策略</td>
			   <td width="80%"></td>
            </tr>
            <tr>
   		       <td width="8%"></td>
               <td width="12%"><input type="radio" name="new1_strategy" id="new1_definestr_select" value="1" 	onchange="document.getElementById('new1_definestr_list1').style.display='';document.getElementById('new1_definestr_list2').style.display='';document.getElementById('new2_allstr_select').checked=true;document.getElementById('new2_definestr_list').style.display='none';
			ec1check();	"/>自定义策略</td>
				<td width="80%">
				<table  style="width: 100%;font-size:14px; color:#333333;display:none" id="new1_definestr_list1" >
				<tr>
					<td width="25%"><input type="checkbox"  id="AreaTreeStg1" value="AreaTreeStg" >AreaTreeStg</td>
          			<td width="25%">  <input type="checkbox"  id="IndexTypeStg1" value="IndexTypeStg" >IndexTypeStg</td>
					<td width="25%"><input type="checkbox"  id="MultiSignStg1" value="MultiSignStg" >MultiSignStg</td>
					<td width="25%"><input type="checkbox"  id="ParsePackStg1" value="ParsePackStg" >ParsePackStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="ArticleSignStg1" value="ArticleSignStg" >ArticleSignStg</td>
					<td width="25%"><input type="checkbox"  id="InnerPrStg1" value="InnerPrStg" >InnerPrStg</td>
					<td width="25%"><input type="checkbox"  id="MyposStg1" value="MyposStg" >MyposStg</td>
					<td width="25%"><input type="checkbox"  id="PoliticalFactorStg1" value="PoliticalFactorStg" >PoliticalFactorStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="VhtmlTreeStg1" value="VhtmlTreeStg" >VhtmlTreeStg</td>
                    <td width="25%"><input type="checkbox"  id="CodeLangStg1" value="CodeLangStg" >CodeLangStg</td>	
					<td width="25%"><input type="checkbox"  id="LinkStg1" value="LinkStg" >LinkStg</td>
					<td width="25%"><input type="checkbox"  id="OrphanFieldStg1" value="OrphanFieldStg" >OrphanFieldStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="PopkitPageStg1" value="PopkitPageStg" >PopkitPageStg</td>
                    <td><input type="checkbox"  id="VideoPicStg1" value="VideoPicStg" >VideoPicStg</td>
                    <td><input type="checkbox"  id="ContentTypeStg1" value="ContentTypeStg" >ContentTypeStg</td>
					<td><input type="checkbox"  id="LinksWritePackStg1" value="LinksWritePackStg" >LinksWritePackStg</td>
				</tr>
				<tr>
					 <td><input type="checkbox"  id="TitleContentStg1" value="TitleContentStg" >TitleContentStg</td>
					<td><input type="checkbox"  id="PublishTimeStg1" value="PublishTimeStg" >PublishTimeStg</td>
					<td><input type="checkbox"  id="WiseMetaStg1" value="WiseMetaStg" >WiseMetaStg</td>
					<td><input type="checkbox"  id="FanyeBindStg1" value="FanyeBindStg" >FanyeBindStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="LongSentSignStg1" value="LongSentSignStg" >LongSentSignStg</td>
					<td><input type="checkbox"  id="PagerankStg1" value="PagerankStg" >PagerankStg</td>
					<td><input type="checkbox"  id="RSSMobileStg1" value="RSSMobileStg" >RSSMobileStg</td>
					<td><input type="checkbox"  id="WordDictStg1" value="WordDictStg" >WordDictStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="ImageAttrStg1" value="ImageAttrStg" >ImageAttrStg</td>
					<td><input type="checkbox"  id="MetaInfoStg1" value="MetaInfoStg" >MetaInfoStg</td>
					<td><input type="checkbox"  id="PageResourceStg1" value="PageResourceStg" >PageResourceStg</td>
					<td><input type="checkbox"  id="StatusStg1" value="StatusStg" >StatusStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="XpathStg1" value="XpathStg" >XpathStg</td>
					<td><input type="checkbox"  id="IndexFreshnessStg1" value="IndexFreshnessStg" >IndexFreshnessStg</td>
					<td><input type="checkbox"  id="MetaRobotsStg1" value="MetaRobotsStg" >MetaRobotsStg</td>
					<td><input type="checkbox"  id="PageTypeStg1" value="PageTypeStg" >PageTypeStg</td>
				</tr>
				</table>
				<table style="width: 100%;font-size:14px; color:#333333;display:none" id="new1_definestr_list2">
				<tr>
					<td><input type="checkbox"  id="PageFeatureProducerStg1" value="PageFeatureProducerStg">PageFeatureProducerStg</td>
					
				</tr>
				</table>
               </td>   
            </tr>   
			<tr>
                    <td width="8%">旧EC1</td>
                    <td><input type="radio" name="old1_strategy" id="old1_allstr_select" value="0"  
						onchange="	document.getElementById('old1_definestr_list1').style.display='none';
									document.getElementById('old1_definestr_list2').style.display='none';
									ec1check();
        							"
					checked/>全部策略</td>
					<td></td>
             </tr>
            <tr>
                    <td></td>
                    <td><input type="radio" name="old1_strategy" value="1" id="old1_definestr_select" onchange="
		document.getElementById('old1_definestr_list1').style.display='';
		document.getElementById('old1_definestr_list2').style.display='';
		document.getElementById('old2_definestr_select').checked=true;
		document.getElementById('old2_definestr_list').style.display='none';ec1check();
"						
/>自定义策略</td>
					
				<td width="80%">
				<table  style="width: 100%;font-size:14px; color:#333333;display:none;" id="old1_definestr_list1">
				<tr>
					<td width="25%"><input type="checkbox"  id="AreaTreeStg3" value="AreaTreeStg" >AreaTreeStg</td>
          			<td width="25%">  <input type="checkbox"  id="IndexTypeStg3" value="IndexTypeStg" >IndexTypeStg</td>
					<td width="25%"><input type="checkbox"  id="MultiSignStg3" value="MultiSignStg" >MultiSignStg</td>
					<td width="25%"><input type="checkbox"  id="ParsePackStg3" value="ParsePackStg" >ParsePackStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="ArticleSignStg3" value="ArticleSignStg" >ArticleSignStg</td>
					<td width="25%"><input type="checkbox"  id="InnerPrStg3" value="InnerPrStg" >InnerPrStg</td>
					<td width="25%"><input type="checkbox"  id="MyposStg3" value="MyposStg" >MyposStg</td>
					<td width="25%"><input type="checkbox"  id="PoliticalFactorStg3" value="PoliticalFactorStg" >PoliticalFactorStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="VhtmlTreeStg3" value="VhtmlTreeStg" >VhtmlTreeStg</td>
                    <td width="25%"><input type="checkbox"  id="CodeLangStg3" value="CodeLangStg" >CodeLangStg</td>	
					<td width="25%"><input type="checkbox"  id="LinkStg3" value="LinkStg" >LinkStg</td>
					<td width="25%"><input type="checkbox"  id="OrphanFieldStg3" value="OrphanFieldStg" >OrphanFieldStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="PopkitPageStg3" value="PopkitPageStg" >PopkitPageStg</td>
                    <td><input type="checkbox"  id="VideoPicStg3" value="VideoPicStg" >VideoPicStg</td>
                    <td><input type="checkbox"  id="ContentTypeStg3" value="ContentTypeStg" >ContentTypeStg</td>
					<td><input type="checkbox"  id="LinksWritePackStg3" value="LinksWritePackStg" >LinksWritePackStg</td>
				</tr>
				<tr>
					 <td><input type="checkbox"  id="TitleContentStg3" value="TitleContentStg" >TitleContentStg</td>
					<td><input type="checkbox"  id="PublishTimeStg3" value="PublishTimeStg" >PublishTimeStg</td>
					<td><input type="checkbox"  id="WiseMetaStg3" value="WiseMetaStg" >WiseMetaStg</td>
					<td><input type="checkbox"  id="FanyeBindStg3" value="FanyeBindStg" >FanyeBindStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="LongSentSignStg3" value="LongSentSignStg" >LongSentSignStg</td>
					<td><input type="checkbox"  id="PagerankStg3" value="PagerankStg" >PagerankStg</td>
					<td><input type="checkbox"  id="RSSMobileStg3" value="RSSMobileStg" >RSSMobileStg</td>
					<td><input type="checkbox"  id="WordDictStg3" value="WordDictStg" >WordDictStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="ImageAttrStg3" value="ImageAttrStg" >ImageAttrStg</td>
					<td><input type="checkbox"  id="MetaInfoStg3" value="MetaInfoStg" >MetaInfoStg</td>
					<td><input type="checkbox"  id="PageResourceStg3" value="PageResourceStg" >PageResourceStg</td>
					<td><input type="checkbox"  id="StatusStg3" value="StatusStg" >StatusStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="XpathStg3" value="XpathStg" >XpathStg</td>
					<td><input type="checkbox"  id="IndexFreshnessStg3" value="IndexFreshnessStg" >IndexFreshnessStg</td>
					<td><input type="checkbox"  id="MetaRobotsStg3" value="MetaRobotsStg" >MetaRobotsStg</td>
					<td><input type="checkbox"  id="PageTypeStg3" value="PageTypeStg" >PageTypeStg</td>
				</tr>
				</table>
				<table style="width: 100%;font-size:14px; color:#333333; display:none" id="old1_definestr_list2">
				<tr>
					<td><input type="checkbox"  id="PageFeatureProducerStg3" value="PageFeatureProducerStg">PageFeatureProducerStg</td>
					
				</tr>
				</table>
               </td>   
            </tr>
			<tr>
               <td width="8%">新EC2</td>
               <td><input type="radio" name="new2_strategy" value="0" id="new2_allstr_select" onchange="document.getElementById('new2_definestr_list').style.display='none';ec1check();" checked/>全部策略</td> 
			   <td></td>
            </tr>   
            <tr>    
               <td></td>
               <td><input type="radio" name="new2_strategy" value="1" id="new2_definestr_select" 
					onchange="document.getElementById('new2_definestr_list').style.display='';ec1check();"
/>自定义策略</td>
				<td>
				<table  style="width: 100%;font-size:14px; color:#333333;display:none" id="new2_definestr_list">
				<tr>
					<td width="25%"><input type="checkbox"  id="AreaTreeStg2" value="AreaTreeStg" >AreaTreeStg</td>
					<td width="25%"><input type="checkbox"  id="ContentTypeStg2" value="ContentTypeStg" >ContentTypeStg</td>			
					<td width="25%"><input type="checkbox"  id="PageResourceStg2" value="PageResourceStg" >PageResourceStg</td>
					<td width="25%"><input type="checkbox"  id="ParsePackStg2" value="ParsePackStg" >ParsePackStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="VhtmlTreeStg2" value="VhtmlTreeStg" >VhtmlTreeStg</td>
					<td width="25%"><input type="checkbox"  id="WordsegStg2" value="WordsegStg" >WordsegStg</td>
					<td width="25%"><input type="checkbox"  id="CodeLangStg2" value="CodeLangStg" >CodeLangStg</td>
					<td width="25%"><input type="checkbox"  id="LinkPVStg2" value="LinkPVStg" >LinkPVStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="PageValueStg2" value="PageValueStg" >PageValueStg</td>
					<td><input type="checkbox"  id="StatusStg2" value="StatusStg" >StatusStg</td>
					<td><input type="checkbox"  id="TransPassStg2" value="TransPassStg" >TransPassStg</td>
					<td><input type="checkbox"  id="WordDictStg2" value="WordDictStg" >WordDictStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="SummaryStg2" value="SummaryStg" >SummaryStg</td>
				</tr>
				</table>
				</td>
			</tr>
            <tr>
                    <td>旧EC2</td>
                    <td><input type="radio" name="old2_strategy" value="0" id="old2_allstr_select" onchange="document.getElementById('old2_definestr_list').style.display='none';ec1check();" checked/>全部策略</td>
					<td></td>
            </tr>
            <tr>
                    <td></td>
                    <td><input type="radio" name="old2_strategy" value="1" id="old2_definestr_select" onchange="
						document.getElementById('old2_definestr_list').style.display='';ec1check();"/>自定义策略</td>
				<td>
				<table  style="width: 100%;font-size:14px; color:#333333;display:none;" id="old2_definestr_list">
				<tr>
					<td width="25%"><input type="checkbox"  id="AreaTreeStg4" value="AreaTreeStg" >AreaTreeStg</td>
					<td width="25%"><input type="checkbox"  id="ContentTypeStg4" value="ContentTypeStg" >ContentTypeStg</td>			
					<td width="25%"><input type="checkbox"  id="PageResourceStg4" value="PageResourceStg" >PageResourceStg</td>
					<td width="25%"><input type="checkbox"  id="ParsePackStg4" value="ParsePackStg" >ParsePackStg</td>
				</tr>
				<tr>
					<td width="25%"><input type="checkbox"  id="VhtmlTreeStg4" value="VhtmlTreeStg" >VhtmlTreeStg</td>
					<td width="25%"><input type="checkbox"  id="WordsegStg4" value="WordsegStg" >WordsegStg</td>
					<td width="25%"><input type="checkbox"  id="CodeLangStg4" value="CodeLangStg" >CodeLangStg</td>
					<td width="25%"><input type="checkbox"  id="LinkPVStg4" value="LinkPVStg" >LinkPVStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="PageValueStg4" value="PageValueStg" >PageValueStg</td>
					<td><input type="checkbox"  id="StatusStg4" value="StatusStg" >StatusStg</td>
					<td><input type="checkbox"  id="TransPassStg4" value="TransPassStg" >TransPassStg</td>
					<td><input type="checkbox"  id="WordDictStg4" value="WordDictStg" >WordDictStg</td>
				</tr>
				<tr>
					<td><input type="checkbox"  id="SummaryStg4" value="SummaryStg" >SummaryStg</td>
				</tr>
				</table>
				</td>
            </tr>
    	</table>
		<?php echo $_smarty_tpl->getSubTemplate ("strategy_2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</td>
</tr>
<script>
function ec1check()
{
	
	var new1_strategy_select=$('input:radio[name="new1_strategy"]:checked').val();
	var old1_strategy_select=$('input:radio[name="old1_strategy"]:checked').val();
	if(old1_strategy_select==1)
    {
            document.getElementById('old2_definestr_select').disabled=true;
            document.getElementById('new2_definestr_select').disabled=true;
            document.getElementById('new2_allstr_select').disabled=true;
            document.getElementById('old2_allstr_select').disabled=true;
    }
    if(new1_strategy_select==1)
    {
        document.getElementById('old2_definestr_select').disabled=true;
            document.getElementById('new2_definestr_select').disabled=true;
            document.getElementById('new2_allstr_select').disabled=true;
            document.getElementById('old2_allstr_select').disabled=true;
    }
	if( (new1_strategy_select==0) && (old1_strategy_select==1))
    {
        	document.getElementById('old2_definestr_select').disabled=true;
            document.getElementById('new2_definestr_select').disabled=true;
            document.getElementById('new2_allstr_select').disabled=true;
            document.getElementById('old2_allstr_select').disabled=true;
    }
	if( (new1_strategy_select==1) && (old1_strategy_select=0))
	{
		document.getElementById('old2_definestr_select').disabled=true;
            document.getElementById('new2_definestr_select').disabled=true;
            document.getElementById('new2_allstr_select').disabled=true;
            document.getElementById('old2_allstr_select').disabled=true;
	}
	if((old1_strategy_select==1) && (new1_strategy_select==1))
	{
		document.getElementById('old2_definestr_select').disabled=true;
            document.getElementById('new2_definestr_select').disabled=true;
            document.getElementById('new2_allstr_select').disabled=true;
            document.getElementById('old2_allstr_select').disabled=true;
	}
    if((old1_strategy_select == 0) && (new1_strategy_select ==0))
    {
                                    document.getElementById('old2_definestr_select').disabled=false;
                                    document.getElementById('new2_definestr_select').disabled=false;
                                    document.getElementById('new2_allstr_select').disabled=false;
                                    document.getElementById('old2_allstr_select').disabled=false;
    }
}
</script>
<?php }} ?>