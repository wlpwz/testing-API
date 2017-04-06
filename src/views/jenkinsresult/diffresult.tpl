			<div id="diff">
				{%if $newolddiff==1%}
					<div class="panel panel-default" id="newolddiff">
						<div class="panel-heading">新旧版本DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><input style="display:none" id="copy4" value="{%$input_data%}"><a 
href="javascript:void(0);" id="btnCopy4" title="复制" onclick="toClipboard(this.id,'copy4')">{%$input_data%}</a></td>
							</tr>
							<tr>
								<td>新EC输出包地址：</td>
                                <td width="80%"><input style="display:none" id="copy5" value="{%$output_data_new_a%}"><a href="javascript:void(0);" id="btnCopy5" title="复制" onclick="toClipboard(this.id,'copy5')">{%$output_data_new_a%}</a></td>
							</tr>
							<tr>
								<td>旧EC输出包地址：</td>
								<td width="80%"><input style="display:none" id="copy6" value="{%$output_data_old_a%}"><a href="javascript:void(0);" id="btnCopy6" title="复制" onclick="toClipboard(this.id,'copy6')">    {%$output_data_old_a%}</a>
								</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td width="80%">{%$diffid_newold%}&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=diff/resultanalysis&diffid={%$diffid_newold%}">diff详情</a>
								</td>
                            </tr>	
						</table>
					</div>	
					{%/if%}
					{%if $newdiff==1%}
					<div class="panel panel-default" id="consistentdiff">
						<div class="panel-heading">新版一致性DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><input style="display:none" id="copy7" value="{%$int_data%}"><a href="jabascript:void(0);" id="btnCopy7" title="复制" onclick="toClipboard(this.id,'copy7')">{%$input_data%}</a></td>
                            </tr>
							<tr>
								<td>新EC1输出包地址：</td>
                                <td width="80%"><input style="display:none" id="copy8" value="{%$output_data_new_b%}"><a href="jabascript:void(0);" id="btnCopy8" title="复制" onclick="toClipboard(this.id,'copy8')">{%$output_data_new_b%}</a></td>
							</tr>
							<tr>
								<td>新EC2输出包地址：</td>
								<td width="80%"><input style="display:none" id="copy9" value="{%$output_data_new_2_b%}"><a href="jabascript:void(0);" id="btnCopy9" title="复制" onclick="toClipboard(this.id,'copy9')">   {%$output_data_new_2_b%}</a>	
								</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td width="80%">{%$diffid_new%}&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=diff/resultanalysis&diffid={%$diffid_new%}">diff详情</a>
								</td>
                            </tr>	

						</table>
					</div>
					{%/if%}
					{%if $olddiff==1%}
					<div class="panel panel-default" id="olddiff">
						<div class="panel-heading">旧版一致性DIFF概况</div>
						<table width="100%" class="table table-bordered table-striped"style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><input style="display:none" id="copy10" value="{%$input_data%}"><a href="jabascript:void(0);" id="btnCopy10" title="复制" onclick="toClipboard(this.id,'copy10')"> {%$input_data%}</a></td>
							</tr>
							<tr>
								<td>旧EC1输出包地址：</td>
                                <td width="80%"><input style="display:none" id="copy11" value="{%$output_data_old_c%}"><a href="jabascript:void(0);" id="btnCopy11" title="复制" onclick="toClipboard(this.id,'copy11')">{%$output_data_old_c%}</a></td>
							</tr>
							<tr>
								<td>旧EC2输出包地址：</td>
								<td width="80%"><input style="display:none" id="copy12" value="{%$output_data_old_2_c%}"><a href="jabascript:void(0);" id="btnCopy12" title="复制" onclick="toClipboard(this.id,'copy12')">{%$output_data_old_2_c%}</a>
								</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td width="80%">{%$diffid_old%}&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=diff/resultanalysis&diffid={%$diffid_old%}">diff详情</a>
								</td>
                            </tr>	

						</table>
					</div>
				{%/if%}
		</div>
			<!--END RIGHT CONTENT-->
