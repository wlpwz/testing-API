
<?php
    $this->beginContent('/layouts/main',['current'=>'combined']);
?>

<!--<table width="100%">
<tr>
<td width="50%">
<ul class="nav nav-pills" style="margin-top:20px">
  <li class="active"><a href="?r=run/index">在线执行</a></li>
  <li><a href="?r=run/localrun">离线执行</a></li>
</ul>
</td>
</tr>
</table>-->

<script type="text/javascript" src="static/js/combined.js"></script>
<script type="text/javascript" src="static/js/bootstrap.js"></script>
<div style="margin-left:10%">
<div style="margin-top:20px">
<h4 class="text-success">编译</h4>
<table class="altrowstable">
    <body>
        <tr>
            <td>输入需要编译的新旧EC版本</td>
            <td width="90%">
            <table rules=none width="100%" style="font-size:13px; color:#333333">
                <tr>
                    <td width="50%">
                        <font>新EC版本</font>
                        <input type="text"  id="selectnewecbin" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="填写版本号，如：3.0.8.7">
                    </td>
                    <td width="50%">
                        <font>旧EC版本</font>
                        <input type="text"  id="selectoldecbin" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="填写版本号，如：3.0.8.7">
                    </td>
                </tr>
            </table>
            </td>
        </tr>
        <tr>
            <td>配置需要变化的编译依赖</td>
            <td  width="90%">
                <button  class="btn btn-default" style="height:32px;width:200px align:center" type='button' id='addlib'>新
 增 依 赖</button>
            </td>
        </tr>
	</body>
</table>
<h4 class="text-success">环境选择</h4>
<table class="altrowstable">
<body>
	<tr>
		<td>选择运行功能</td>
		<td style="width:90%;">
			<table rules=none width="100%" style="font-size:13px; color:#333333"><tr>
			<td width="50%">
				<input type="checkbox" name="consistentdiff" id="consistentdiff" value="1" checked="checked" onclick="diffcheck(this.id)">
				<font>比较新版一致性Diff</font>
			</td>
			<td>
				<input type="checkbox" name="newolddiff" id="newolddiff" value="1" checked="checked" onclick="diffcheck(this.id)">
				<font>比较新旧EC Diff</font>
			</td>
			</tr></table>
		</td>		
	</tr>
	<tr>
		<td>选择EC-BIN和CONF</td>
		<td style="width:90%;">
			<table rules=none id="table_binpattern" style="width:100%;font-size:13px; color:#333333">
			<body>
				<tr>
					<td width=50%>
					<input type="radio" name="binpattern1" id="productnewbinid" value="scm" checked  onchange="document.getElementById('table_newftp_define').style.display='none';document.getElementById('table_compile').style.display='none';" onclick="bincheck(this.value)">
                    <font>新EC-SCM&nbsp;&nbsp;</font>
					<input type="text"  id="new_scm" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="填写版本号，如：3.0.8.7">
						
						<br/>
					</td>
					<td>
						<input type="radio" id="productoldbinid" name="binpattern2" value="scm" checked  onchange="document.getElementById('table_oldftp_define').style.display='none';document.getElementById('table_compile').style.display='none';" onclick="bincheck(this.value)" <?php
                            if($compile_id!="null")
                                echo "disabled=\"disabled\"";
                            ?>>
                            <font>旧EC-SCM&nbsp;&nbsp;</font>
							<input type="text"  id="old_scm" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="填写版本号，如:3.0.8.7">
					
					<br/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" name="binpattern1" id="ftpnewbinid" value="ftp" id="ftpnewbinid" onchange="document.getElementById('table_newftp_define').style.display='';document.getElementById('table_compile').style.display='none';" onclick="bincheck(this.value)" <?php
                            if($compile_id!="null")
                                echo "disabled=\"disabled\"";
                            ?> >
                    	<font>新EC-FTP地址</font>
						<br>
						<table rules=none id="table_newftp_define" style="width: 400px;display:none;font-size:13px; color:#333333">
							<body>
							<tr>
								<td>新EC1的BIN地址:
									<div>
										<input type="text"  id="newecftp1" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~ ">
									</div>
								</td>
							</tr>
							
							<tr>
								<td>新EC2的BIN地址:
                            		<div>
                                		<input type="text"  id="newecftp2" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~ ">
									</div>
								</td>
							</tr>
							 <tr>
                                <td>新EC1的CONF地址:
                                    <div>
                                        <input type="text"  id="newecconf1" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>新EC2的CONF地址:
                                    <div>
                                        <input type="text"  id="newecconf2" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder=" 请填入ftp地址哦~">
                                    </div>
                                </td>
                            </tr>
							</body>
						</table>
						
                        
					</td>
					<td>
						<input type="radio" name="binpattern2" id="ftpoldbinid" value="ftp" id="ftpoldbinid" onchange="document.getElementById('table_oldftp_define').style.display='';document.getElementById('table_compile').style.display='none';" onclick="bincheck(this.value)">
                        <font>旧EC-FTP地址</font>
						<br>
						<table rules=none id="table_oldftp_define" style="width: 400px;display:none;font-size:13px; color:#333333" >
                            <body>
                            <tr>
                                <td>旧EC1的BIN地址:
                                    <div>
                                        <input type="text"  id="oldecftp1" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>旧EC2的BIN地址:
                                    <div>
                                        <input type="text"  id="oldecftp2" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~">
									</div>
                                </td>
                            </tr>
							<tr>
                                <td>旧EC1的CONF地址:
                                    <div>
                                        <input type="text"  id="oldecconf1" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>旧EC2的CONF地址:
                                    <div>
                                        <input type="text"  id="oldecconf2" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="请填入ftp地址哦~">
                                    </div>
                                </td>
                            </tr>
                            </body>
                        </table>
						
                        
					</td>
				</tr>
			</body>
			</table>
		</td>
	</tr>
	<tr>
		<td>选择EC类型</td>
		<td style="width:90%">
			<table rules=none width="100%" style="font-size:13px; color:#333333">
			<tr>
				<td width="50%">
				<input type="radio" name="ectype" value="chineseec" checked onclick="typecheck(this.value)">
                <font>中文EC</font>
				</td>
				<td>
				<input type="radio" name="ectype" value="internationalec" onclick="typecheck(this.value)">
                <font>国际化EC</font>
				</td>
			</tr>
			</table>
		</td>		
	</tr>

	<!--CONF-->
<!--	<tr>
		<td>选择EC配置文件(Conf)</td>
		<td style="width:90%">
			
			<table rules=none id="table_binpattern" style="width:100%;font-size:13px; color:#333333">
			<body>
				<tr>
					<td width=50%>
					<input type="radio" id="productnewconfid" name="congpattern1" value="product" checked  onchange="document.getElementById('table_newconf_define').style.display='none';" onclick="confcheck(this.value)">
                    <font>新EC-Conf使用产品库中的Conf&nbsp;&nbsp;</font>
						<input type="text"  id="selectnewecconf" style="width: 100px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="eg:3.0.8.7">
						<br/>
                        <br/>
					</td>
					<td>
						<input type="radio" id="productoldconfid"  name="congpattern2" value="product"checked onclick="confcheck(this.value)">
                        <font>旧EC-Conf使用产品库中的Conf&nbsp;&nbsp; </font>	
						<input type="text"  id="selectoldecconf" style="width: 100px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="eg:3.0.8.7">
						<br/>
                        <br/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" name="congpattern1" id="ftpnewconfid"  value="svn" onchange="document.getElementById('table_newconf_define').style.display='';"  onclick="confcheck(this.value)">
                    	<font>给出新EC Conf目录的FTP地址</font>
						<table rules=none id="table_newconf_define" style="width: 400px;display:none;font-size:13px; color:#333333">
							<body>
                            <tr>
                                <td>新EC1的CONF地址:
                                    <div>
                                        <input type="text"  id="newecconf1" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/pack.5000">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>新EC2的CONF地址:
                                    <div>
                                        <input type="text"  id="newecconf2" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/pack.5000">
                                    </div>
                                </td>
                            </tr>
                            </body>
						</table>
						<br/>
                        <br/>
					</td>
					<td>
                        <input type="radio" name="congpattern2" id="ftpoldconfid" value="svn" onchange="document.getElementById('table_oldconf_define').style.display='';"  onclick="confcheck(this.value)">
                        <font>给出旧EC Conf目录的FTP地址</font>
						<table rules=none id="table_oldconf_define" style="width: 400px;display:none;font-size:13px; color:#333333" >
                            <body>
                            <tr>
                                <td>旧EC1的CONF地址:
                                    <div>
                                        <input type="text"  id="oldecconf1" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/pack.5000">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>旧EC2的CONF地址:
                                    <div>
                                        <input type="text"  id="oldecconf2" style="width: 400px;height:30px;margin-left:0px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/pack.5000">
                                    </div>
                                </td>
                            </tr>
                            </body>
                        </table>
						<br/>
                        <br/>
                    </td>
				</tr>
				
			</body>
			</table>
		</td>
	</tr>	-->
</body>
</table>
<h4 class="text-success">输入数据选择</h4>
<table class="altrowstable">
	<body>
    <tr>
    <td>数据来源</td>
    <td style="width:90%;">
      &nbsp;<input type="radio" name="inputpattern" value="platform_data" checked
            onchange="document.getElementById('table_data_define').style.display='none';
                      document.getElementById('platform_data').style.display='';
       "	onclick="inputcheck(this.value)"/>使用产品库中的输入包
       <br/>
       <br/>
      <table rules=none id="platform_data" style="font-size:13px; color:#333333">
		<tr><td>
		<div align="center" class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="ecinputnum" value="none" style="height:30px;width:160px">数量 <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li onclick="refreshInputNum('none')" style="height:30px;width:100px"><a>数量 </a></li>
                        <li onclick="refreshInputNum('100')" value="100"><a>100</a></li>
						<li onclick="refreshInputNum('2000')" value="2000"><a>2000</a></li>
                        <li onclick="refreshInputNum('1W')" value="1W"><a>1W</a></li>
                        <li onclick="refreshInputNum('10W')" value="10W"><a>10W</a></li>
                    </ul>
                </div>
		</td></tr>
	  </table>
	<!-- <table rules=none id="platform_data" style="font-size:13px; color:#333333">
       <body>
           <tr>
               <td>DATA TYPE</td>
               <td>
					<div align="center" class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="ecinputproduct" value="none" style="margin-left:20px;width:200px;font-size:11px">选择EC输入数据 <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                <li onclick="refreshInput('none')" style="height:32px;width:300px"><a>选择EC输入数据 </a></li>
                 <?php
                  /*  $inputlist = split("&&",$input_pack_list);
                    for ($i = 0;$i < count($inputlist); $i++)
                    {
                       echo "<li onclick=\"refreshInput('".$inputlist[$i]."')\" value=\"".$inputlist[$i]."\"><a>".$inputlist[$i]."</a></li>";
                    }*/
                 ?>
                </ul>
                </div>
               </td>
           </tr>

           <tr>
               
               <td>
					<div align="center" class="btn-group">
                		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="ecinputnum" value="none" style="margin-left:20px;width:200px;font-size:11px">数量 <span class="caret"></span></button>
                		<ul class="dropdown-menu" role="menu">
                		<li onclick="refreshInputNum('none')" style="height:32px;width:300px"><a>数量 </a></li>
                		<li onclick="refreshInputNum('100')" value="100"><a>100</a></li>
						<li onclick="refreshInputNum('2000')" value="2000"><a>2000</a></li>
                		<li onclick="refreshInputNum('1W')" value="1W"><a>1W</a></li>
                		<li onclick="refreshInputNum('10W')" value="10W"><a>10W</a></li>
                		</ul>
                	</div>
                </td>
            </tr>
       </body>
       </table>-->
		<br/>
       &nbsp;<input type="radio" name="inputpattern" value="path" onclick="inputcheck(this.value)"  
            onchange="document.getElementById('table_data_define').style.display='';
                      document.getElementById('platform_data').style.display='none';
       "/>上传输入包（Mcpack）地址

        <br/>
        <br/>
        <table rules=none id="table_data_define" style="width: 800px;display:none;font-size:13px; color:#333333">
        <body>
            <tr>
                <td style="width:20%;">DATA的FTP地址</td>
                <td>
                    <input type="text"  style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" id='ecinputpath' placeholder='ftp://svn.baidu.com/ps/spider/tags/i18n-ec/i18n-ec/output/bin'>
                </td>
            </tr>
        </body>
        </table>

    </td>
    </tr>	
</body>
</table>
<h4 class="text-success">运行地址选择</h4>
<table class="altrowstable">
<body>
	<tr> 
		<td>运行地址</td>
		<td style="width:90%">
			&nbsp;<input type="radio" name="ecrunposition" value="default" checked  onclick="ecruncheck(this.value)"  onchange="document.getElementById('table_machine').style.display='none';">
            <font>使用默认地址（结果仅保存7天）</font>
			<br/>
			<br/>
			&nbsp;<input type="radio" name="ecrunposition" value="outside" onclick="ecruncheck(this.value)"  onchange="document.getElementById('table_machine').style.display='';">
            <font>使用自己的测试机</font>
			<br/>
			<br/>
			<table rules=none id="table_machine" style="width:800px;display:none;font-size:13px; color:#333333">
				<body>
					<tr>
						<td>测试机地址</td>
						<td style="width:80%;">
							<input id='ecrunhostname' style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;"  placeholder='spider@cq01-testing-ps7164.cq01.baidu.com'>
						</td>
					</tr>
					<tr>
						<td>输出数据路径</td>
						<td style="width:80%;">
							<input id='ecrunpath' style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;"  placeholder='/home/work/LibPP/Ec_run/result'>
						</td>
					</tr>
				</body>
			</table>
		</td>	
	</tr>
</body>
</table>
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 500px;margin-top: 20px;" id="subtn" onclick="Submit_Form(2)">运行</button></h4>
</div>
<!--<script type="text/javascript" src="static/js/run.js"></script>-->
<?php $this->endContent(); ?>
