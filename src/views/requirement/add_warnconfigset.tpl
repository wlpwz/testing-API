<div class="wrapper">
	<section class="column full first">
		<p>新需求</p>
		<form class="form-horizontal" method="POST" action="?r=requirement/addwarnconfigsetitem">
			<fieldset>
			<div class="control-group">
				<label class="control-label">监控项:</label>
				<div class="controls">
				    <input name="monitor_case" type="text" class="span2 inline" style="width:300px" value="" placeholder="监控项：例如default_warn" maxlength="30" required/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">监控项描述:</label>
				<div class="controls">
						<textarea name="descript" class="span2 inline" rows="5" style="width:300px" value="" placeholder="监控项描述：例如默认配置"></textarea>
				</div>
			</div>
            <div class="control-group">
                <label class="control-label">报警级别:</label>
                <div class="controls">
                    <select class="span2 mr10" name="warn_level">
                        <option value="fatal">fatal</option>
                        <option value="warn">warn</option>
                        <option value="stat">stat</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">邮件报警接收人：</label>
                <div class="controls">
                    <input name="msg_list" class="span2 inline" size="256" type="text" value="" style="width:300px" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">短信报警接收人：</label>
                <div class="controls">
                    <input name="gmsg_list" class="span2 inline" size="256" type="text" value="" style="width:300px"/>
                </div>
            </div>
			<div class="control-group">
				<label class="control-label">报警汇总:</label>
				<div class="controls">
					<input name="warn_merge" class="span2 inline" size="256" type="text" value="" style="width:300px" placeholder="报警汇总：例如warn_merge" />
				</div>
			</div>
            <div class="control-group">
                <label class="control-label">报警汇总退出:</label>
                <div class="controls">
                    <input name="warn_merge_quit" class="span2 inline" size="256" type="text" value="" style="width:300px"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">报警频率:</label>
                <div class="controls">
                    <input name="warn_times" class="span2 inline" size="256" type="text" value="" style="width:300px" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">短信报警汇总:</label>
                <div class="controls">
                    <input name="gwarn_merge" class="span2 inline" size="256" type="text" value="" style="width:300px" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">短信报警汇总退出:</label>
                <div class="controls">
                    <input name="gwarn_merge_quit" class="span2 inline" size="256" type="text" value="" style="width:300px"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">短信报警频率:</label>
                <div class="controls">
                    <input name="gwarn_times" class="span2 inline" size="256" type="text" value="" style="width:300px" />
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
