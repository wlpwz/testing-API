<link rel="stylesheet" href="static/font-awesome-4.0.3/css/font-awesome.min.css" />
<style type="text/css">
</style>
     <form name="issue" action="?r=requirement/handled" method="post">  
       <div>
         问题ID：&nbsp;&nbsp;&nbsp;<input type="text" value=<?php echo "'".$alarm[0]['id']."'";?> disabled/>
         <input name="id" value=<?php echo "'".$alarm[0]['id']."'";?> style="display:none"/>
       </div>
       <div>
         所属平台：<input name="platform" type="text" value=<?php echo "'".$alarm[0]['plat']."'";?> disabled/>
       </div>
       <div>
         监控类别：<input name="category" type="text" value=<?php echo "'".$alarm[0]['alarm_type']."'";?> disabled/>
       </div>
       <div>
         监控名称：<input name="name" type="text" value=<?php echo "'".$alarm[0]['alarm_title']."'";?> disabled/>
       </div>
       <div>
         报警时间：<input name="time" type="text" value=<?php echo "'".$alarm[0]['alarm_time']."'";?> disabled/>
       </div>
       <div>
         报警内容：<textarea class="autogrow" rows="5" cols="40" name="content" type="text"><?php echo $alarm[0]['alarm_content'];?></textarea>
       </div>
        <div>
           <span>报警原因：</span>
           <select id="u1" name="reason">
             <option value="0">请选择</option>
             <option value="1">监控不稳定</option>
             <option value="2">误报</option>
             <option value="3">监控发现</option>
             <option value="4">监控未发现</option>
           </select>
        </div>
        <div>
           <span>处理状态：</span>
           <select id="u2" name="state">
             <option value="1">请选择</option>
             <option value="1">未跟进</option>
             <option value="2">跟进中</option>
             <option value="3">解决</option>
           </select>
        </div>
        <div>
           <span>问题级别：</span>
           <select id="u2" name="grade">
             <option value="0">请选择</option>
             <option value="1">严重</option>
             <option value="2">中等</option>
             <option value="3">较轻</option>
           </select>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                     
        <input style="height:22px;width:87px" class="btn-blue" type="submit" value="提交" />                                               
  <input type="button" style="height:22px;width:87px;margin-right:30%" class="btn-blue" value="退出" onclick="window.location.href='?r=requirement/index'"/>
      </form>
