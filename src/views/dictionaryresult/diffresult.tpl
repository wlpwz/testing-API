				{%if $newold==1%}
				<div id="diff">
					<div class="panel panel-default" id="newolddiff">
						<div class="panel-heading">新旧版本DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td ><input style="display:none" id="copy4" value="{%$input_data%}"><a href="javascript:void(0);" id="btnCopy4" title="复制" onclick="toClipboard(this.id,'copy4')">{%$input_data%}</a></td>
							</tr>
							<tr>
								<td>新DC输出包地址：</td>
                                <td><input style="display:none" id="copy5" value="{%$output_data_new%}"><a href="javascript:void(0);" id="btnCopy5" title="复制" onclick="toClipboard(this.id,'copy5')">{%$output_data_new%}</a></td>
							</tr>
							<tr>
								<td>旧DC输出包地址：</td>
								<td><input style="display:none" id="copy6" value="{%$output_data_old%}"><a href="javascript:void(0);" id="btnCopy6" title="复制" onclick="toClipboard(this.id,'copy6')">	{%$output_data_old%}</a>	</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td>{%$diffid_newold%}&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=dcDiff/index&dt={%$time%}&id={%$diffid_newold%}">cachediff详情</a>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="http://pat.baidu.com/index.php?r=diff/resultanalysis&diffid={%$saver_diffid%}">saverdiff详情</a>
								</td>
                            </tr>	
						</table>
					</div>	
					
		</div>
	{%/if%}
			<!--END RIGHT CONTENT-->
