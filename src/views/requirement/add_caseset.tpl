<div class="wrapper">
	<section class="column full first">
		<p>新需求</p>
		<form class="form-horizontal" method="POST" action="?r=requirement/addcasesetitem">
			<fieldset>
			<div class="control-group">
				<label class="control-label">case名称:</label>
				<div class="controls">
				    <input name="case_name" type="text" class="span2 inline" style="width:300px" value="" placeholder="case名称：例如bdshare_total_pv_wave" maxlength="30" required/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">case描述:</label>
				<div class="controls">
				    <textarea name="descript" class="span2 inline" rows="5" style="width:300px" value=""></textarea>
				</div>
			</div>
            <div class="control-group">
                <label class="control-label">环路:</label>
                <div class="controls">
                    <input name="circle" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">产品线：</label>
                <div class="controls">
                    <select class="span2 mr10" name="product"><option value="bdshare">bdshare</option><option value="sitemap">sitemap</option><option value="sitemap_tool">sitemap_tool</option><option value="case">cse</option></select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">case级别:</label>
                <div class="controls">
                    <input name="level" class="span2 inline" size="256" type="text" value="" style="width:200px" required/>
                </div>
            </div>
			<div class="control-group">
				<label class="control-label">报警配置:</label>
				<div class="controls">
					<select class="span2 mr10" name="warnconfig_id">
                    {%foreach $warnconfig_id as $item%}
                        <option value="{%$item['id']%}">{%$item['id']%}:{%$item['monitor_case']%}</option>
                    {%/foreach%}
                    </select>
				</div>
			</div>
            <div class="control-group">
                <label class="control-label">crontab配置:</label>
                <div class="controls">
                    <input name="crontab_conf" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">对应模块:</label>
                <div class="controls">
                    <input name="module" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">对应机器:</label>
                <div class="controls">
                    <input name="machine" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">展现url:</label>
                <div class="controls">
                    <input name="url" class="span2 inline" size="256" type="text" value="" style="width:320px" placeholder="URL：例如http://www.sitemap-qa.baidu.com" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">检查周期:</label>
                <div class="controls">
                    <select class="span2 mr10" name="time_level"><option value="5min">5min</option><option value="1hour">1hour</option><option value="1day">1day</option><option value="1week">1week</option><option value="1month">1month</option><option value="1year">1year</option></select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">数据源选取条件:</label>
                <div class="controls">
                    <input name="data_source" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">状态判断条件:</label>
                <div class="controls">
                    <textarea name="status_condition" class="span2 inline" rows="5" style="width:300px" value=""></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">报警条件:</label>
                <div class="controls">
                    <input name="warn_condition" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">环境:</label>
                <div class="controls">
                    <select class="span2 mr10" name="env"><option value="online">online</option><option value="sandbox">sandbox</option></select>
                </div>
            </div>
			<div class="control-group">
				<div class="controls">
					<button class="btn btn-mini btn-primary reset_btn" id="btn_save" type="submit">保存</button>
					<button class="btn btn-mini reset_btn_gray" id="btn_cancel" type="button">取消</button>
				</div>
			</div>
			</fieldset>
		</form>
	</section>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#btn_cancel').bind('click', function(){
        window.location.href = "?r=requirement/addcaseset";
    });
</script>
