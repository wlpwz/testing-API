
(function(){
     var Downstream = function(){
        this._init();
     }

     Downstream.prototype._init = function(){
        var _this = this; 
        _this.addExe();
     }
     Downstream.prototype.addExe = function(){
        $('#submit_task').bind('click', function(){
			var run_select = $('input:radio[name="radiobutton_machine"]:checked').val();
			if (document.getElementById("newolddiff").checked==true)
				var	 newolddiff_select = 1;
			else 
				var  newolddiff_select = 0;
			if (document.getElementById("newdiff").checked==true)
				var newdiff_select = 1;
			else
			    var newdiff_select = 0;
			if (document.getElementById("olddiff").checked==true)
				var olddiff_select = 1;
			else
				var olddiff_select = 0;
			if (document.getElementById("checkbox_memory").checked==true)
				var memory_select = 1;
			else
				var memory_select = 0;
			if (document.getElementById("checkbox_speed").checked==true)
				var speed_select = 1;
			else
				var speed_select = 0;
			var Valgrind_select = 0;		
	/*		if (document.getElementById("checkbox_Valgrind").checked==true)                       
				var Valgrind_select = 1;
			else
				var Valgrind_select = 0;*/
			var des=document.getElementById("des").value;
			if(des=='')
			{
				alert('请输入任务描述~');
				return;
			}
            var machine_select = $('input:radio[name="radiobutton_machine"]:checked').val();
			if(machine_select == 'default_machine'){
				var type_select = $('input:radio[name="radiobutton_type"]:checked').val();
				if (type_select == '')
				{
					alert('请选择新EC类型！');
					return;
				}
/*-----------------------------chinese strategy--------------------*/
				if(type_select == "0")
				{
					var new1_strategy_select=$('input:radio[name="new1_strategy"]:checked').val();
					var new1_strategy='';
					var new2_strategy='';
					var old1_strategy_select=$('input:radio[name="old1_strategy"]:checked').val();
                    var old1_strategy='';
                    var old2_strategy='';
					/*---------for new1 and old1------------*/
					if(new1_strategy_select == "1") // new2 and old2 can not chosen
					{
						if(document.getElementById("AreaTreeStg1").checked==true)
                        {       new1_strategy+='AreaTreeStg,'; }
						if(document.getElementById("IndexTypeStg1").checked==true)
                        {       new1_strategy+='IndexTypeStg,'; }
						if(document.getElementById("MultiSignStg1").checked==true)
                        {       new1_strategy+='MultiSignStg,'; }
                        if(document.getElementById("ParsePackStg1").checked==true)
                        {       new1_strategy+='ParsePackStg,'; }
                        if(document.getElementById("ArticleSignStg1").checked==true)
                        {       new1_strategy+='ArticleSignStg,'; }
                        if(document.getElementById("InnerPrStg1").checked==true)
                        {       new1_strategy+='InnerPrStg,'; }
                        if(document.getElementById("MyposStg1").checked==true)
                        {       new1_strategy+='MyposStg,'; }
                        if(document.getElementById("PoliticalFactorStg1").checked==true)
                        {       new1_strategy+='PoliticalFactorStg,'; }
                        if(document.getElementById("VhtmlTreeStg1").checked==true)
                        {       new1_strategy+='VhtmlTreeStg,'; }
                        if(document.getElementById("CodeLangStg1").checked==true)
                        {       new1_strategy+='CodeLangStg,'; }
                        if(document.getElementById("LinkStg1").checked==true)
                        {       new1_strategy+='LinkStg,'; }
                        if(document.getElementById("OrphanFieldStg1").checked==true)
                        {       new1_strategy+='OrphanFieldStg,'; }
                        if(document.getElementById("PopkitPageStg1").checked==true)
                        {       new1_strategy+='PopkitPageStg,'; }
                        if(document.getElementById("VideoPicStg1").checked==true)
                        {       new1_strategy+='VideoPicStg,'; }
                        if(document.getElementById("ContentTypeStg1").checked==true)
                        {       new1_strategy+='ContentTypeStg,'; }
                        if(document.getElementById("LinksWritePackStg1").checked==true)
                        {       new1_strategy+='LinksWritePackStg,'; }
                        if(document.getElementById("TitleContentStg1").checked==true)
                        {       new1_strategy+='TitleContentStg,'; }
                        if(document.getElementById("PublishTimeStg1").checked==true)
                        {       new1_strategy+='PublishTimeStg,'; }
                        if(document.getElementById("WiseMetaStg1").checked==true)
                        {       new1_strategy+='WiseMetaStg,'; }
                        if(document.getElementById("FanyeBindStg1").checked==true)
                        {       new1_strategy+='FanyeBindStg,'; }
						 if(document.getElementById("LongSentSignStg1").checked==true)
                        {       new1_strategy+='LongSentSignStg,'; }
                        if(document.getElementById("PagerankStg1").checked==true)
                        {       new1_strategy+='PagerankStg,'; }
                        if(document.getElementById("RSSMobileStg1").checked==true)
                        {       new1_strategy+='RSSMobileStg,'; }
                        if(document.getElementById("WordDictStg1").checked==true)
                        {       new1_strategy+='WordDictStg,'; }
                        if(document.getElementById("ImageAttrStg1").checked==true)
                        {       new1_strategy+='ImageAttrStg,'; }
                        if(document.getElementById("MetaInfoStg1").checked==true)
                        {       new1_strategy+='MetaInfoStg,'; }
                        if(document.getElementById("PageResourceStg1").checked==true)
                        {       new1_strategy+='PageResourceStg,'; }
                        if(document.getElementById("StatusStg1").checked==true)
                        {       new1_strategy+='StatusStg,'; }
						 if(document.getElementById("XpathStg1").checked==true)
                        {       new1_strategy+='XpathStg,'; }
                        if(document.getElementById("IndexFreshnessStg1").checked==true)
                        {       new1_strategy+='IndexFreshnessStg,'; }
                        if(document.getElementById("MetaRobotsStg1").checked==true)
                        {       new1_strategy+='MetaRobotsStg,'; }
                        if(document.getElementById("PageTypeStg1").checked==true)
                        {       new1_strategy+='PageTypeStg,'; }
                        if(document.getElementById("PageFeatureProducerStg1").checked==true)
                        {       new1_strategy+='PageFeatureProducerStg,'; }
						//alert("new1:"+new1_strategy);
						if(new1_strategy=='')
						{
							alert("请选择新版EC1自定义策略！");
							return;
						}

					}
/*---------------------old1-------------*/
					if(old1_strategy_select == "1") // old2 can not chosen
					{
						if(document.getElementById("AreaTreeStg3").checked==true)
                        {       old1_strategy+='AreaTreeStg,'; }
						if(document.getElementById("IndexTypeStg3").checked==true)
                        {       old1_strategy+='IndexTypeStg,'; }
						if(document.getElementById("MultiSignStg3").checked==true)
                        {       old1_strategy+='MultiSignStg,'; }
                        if(document.getElementById("ParsePackStg3").checked==true)
                        {       old1_strategy+='ParsePackStg,'; }
                        if(document.getElementById("ArticleSignStg3").checked==true)
                        {       old1_strategy+='ArticleSignStg,'; }
                        if(document.getElementById("InnerPrStg3").checked==true)
                        {       old1_strategy+='InnerPrStg,'; }
                        if(document.getElementById("MyposStg3").checked==true)
                        {       old1_strategy+='MyposStg,'; }
                        if(document.getElementById("PoliticalFactorStg3").checked==true)
                        {       old1_strategy+='PoliticalFactorStg,'; }
                        if(document.getElementById("VhtmlTreeStg3").checked==true)
                        {       old1_strategy+='VhtmlTreeStg,'; }
                        if(document.getElementById("CodeLangStg3").checked==true)
                        {       old1_strategy+='CodeLangStg,'; }
                        if(document.getElementById("LinkStg3").checked==true)
                        {       old1_strategy+='LinkStg,'; }
                        if(document.getElementById("OrphanFieldStg3").checked==true)
                        {       old1_strategy+='OrphanFieldStg,'; }
                        if(document.getElementById("PopkitPageStg3").checked==true)
                        {       old1_strategy+='PopkitPageStg,'; }
                        if(document.getElementById("VideoPicStg3").checked==true)
                        {       old1_strategy+='VideoPicStg,'; }
                        if(document.getElementById("ContentTypeStg3").checked==true)
                        {       old1_strategy+='ContentTypeStg,'; }
                        if(document.getElementById("LinksWritePackStg3").checked==true)
                        {       old1_strategy+='LinksWritePackStg,'; }
                        if(document.getElementById("TitleContentStg3").checked==true)
                        {       old1_strategy+='TitleContentStg,'; }
                        if(document.getElementById("PublishTimeStg3").checked==true)
                        {       old1_strategy+='PublishTimeStg,'; }
                        if(document.getElementById("WiseMetaStg3").checked==true)
                        {       old1_strategy+='WiseMetaStg,'; }
                        if(document.getElementById("FanyeBindStg3").checked==true)
                        {       old1_strategy+='FanyeBindStg,'; }
						 if(document.getElementById("LongSentSignStg3").checked==true)
                        {       old1_strategy+='LongSentSignStg,'; }
                        if(document.getElementById("PagerankStg3").checked==true)
                        {       old1_strategy+='PagerankStg,'; }
                        if(document.getElementById("RSSMobileStg3").checked==true)
                        {       old1_strategy+='RSSMobileStg,'; }
                        if(document.getElementById("WordDictStg3").checked==true)
                        {       old1_strategy+='WordDictStg,'; }
                        if(document.getElementById("ImageAttrStg3").checked==true)
                        {       old1_strategy+='ImageAttrStg,'; }
                        if(document.getElementById("MetaInfoStg3").checked==true)
                        {       old1_strategy+='MetaInfoStg,'; }
                        if(document.getElementById("PageResourceStg3").checked==true)
                        {       old1_strategy+='PageResourceStg,'; }
                        if(document.getElementById("StatusStg3").checked==true)
                        {       old1_strategy+='StatusStg,'; }
						 if(document.getElementById("XpathStg3").checked==true)
                        {       old1_strategy+='XpathStg,'; }
                        if(document.getElementById("IndexFreshnessStg3").checked==true)
                        {       old1_strategy+='IndexFreshnessStg,'; }
                        if(document.getElementById("MetaRobotsStg3").checked==true)
                        {       old1_strategy+='MetaRobotsStg,'; }
                        if(document.getElementById("PageTypeStg3").checked==true)
                        {       old1_strategy+='PageTypeStg,'; }
                        if(document.getElementById("PageFeatureProducerStg3").checked==true)
                        {       old1_strategy+='PageFeatureProducerStg,'; }
						//alert("old1:"+old1_strategy);
						if(old1_strategy=='')
						{
							alert("请选择旧版EC1自定义策略！");
							return;
						}

					}
					
					else if((new1_strategy_select == "0")&&(old1_strategy_select == "0")) // chose new2 and old 2
					{
						var new2_strategy_select=$('input:radio[name="new2_strategy"]:checked').val();
						if (new2_strategy_select == "1")
						{
							if(document.getElementById("AreaTreeStg2").checked==true)
                        	{       new2_strategy+='AreaTreeStg,'; }
							if(document.getElementById("ContentTypeStg2").checked==true)
                        	{       new2_strategy+='ContentTypeStg,'; }
                        	if(document.getElementById("PageResourceStg2").checked==true)
							{       new2_strategy+='PageResourceStg,'; }
                        	if(document.getElementById("ParsePackStg2").checked==true)
                        	{       new2_strategy+='ParsePackStg,'; }
                        	if(document.getElementById("VhtmlTreeStg2").checked==true)
                        	{       new2_strategy+='VhtmlTreeSt,'; }
                        	if(document.getElementById("WordsegStg2").checked==true)
                        	{       new2_strategy+='WordsegStg,'; }
                        	if(document.getElementById("CodeLangStg2").checked==true)
                        	{       new2_strategy+='CodeLangStg,'; }
                        	if(document.getElementById("LinkPVStg2").checked==true)
                        	{       new2_strategy+='LinkPVStg,'; }
                        	if(document.getElementById("PageValueStg2").checked==true)
                        	{       new2_strategy+='PageValueStg,'; }
                        	if(document.getElementById("TransPassStg2").checked==true)
                        	{       new2_strategy+='TransPassStg,'; }
                        	if(document.getElementById("WordDictStg2").checked==true)
                        	{       new2_strategy+='WordDictStg,'; }
                        	if(document.getElementById("SummaryStg2").checked==true)
                        	{       new2_strategy+='SummaryStg,'; }
							//alert("new2:"+new2_strategy);
                        	if(new2_strategy=='')
                        	{       
                            	alert("请选择新版EC2自定义策略！"); 
                            	return; 
                        	}       	
						}
						var old2_strategy_select=$('input:radio[name="old2_strategy"]:checked').val();
						if(old2_strategy_select == 1)
						{
							if(document.getElementById("AreaTreeStg4").checked==true)
                       		{       old2_strategy+='AreaTreeStg,'; }
							if(document.getElementById("ContentTypeStg4").checked==true)
                      		{       old2_strategy+='ContentTypeStg,'; }
                       		if(document.getElementById("PageResourceStg4").checked==true)
                       		{       old2_strategy+='PageResourceStg,'; }
                       		if(document.getElementById("ParsePackStg4").checked==true)
                       		{       old2_strategy+='ParsePackStg,'; }
                       		if(document.getElementById("VhtmlTreeStg4").checked==true)
                       		{       old2_strategy+='VhtmlTreeStg,'; }
                       		if(document.getElementById("WordsegStg4").checked==true)
                       		{       old2_strategy+='WordsegStg,'; }
                       		if(document.getElementById("CodeLangStg4").checked==true)
                       		{       old2_strategy+='CodeLangStg,'; }
                       		if(document.getElementById("LinkPVStg4").checked==true)
                       		{       old2_strategy+='LinkPVStg,'; }
                       		if(document.getElementById("PageValueStg4").checked==true)
                       		{       old2_strategy+='PageValueStg,'; }
							if(document.getElementById("StatusStg4").checked==true)
                            {       old2_strategy+='StatusStg,'; }	
                       		if(document.getElementById("TransPassStg4").checked==true)
                       		{       old2_strategy+='TransPassStg,'; }
                       		if(document.getElementById("WordDictStg4").checked==true)
                       		{       old2_strategy+='WordDictStg,'; }
                        	if(document.getElementById("SummaryStg4").checked==true)
                        	{       old2_strategy+='SummaryStg,'; }
						//		alert("old2:"+old2_strategy);
                       		if(old2_strategy=='')
                       		{       
                           		alert("请选择旧版EC2自定义策略！"); 
                           		return; 
                       		}
						}       	
					}
				}
/*-------------------------end chinese strategy--------------------*/
/*-----------------------international strategy--------------------*/
				if (type_select == "1")
				{
					var new_strategy_select=$('input:radio[name="new_strategy"]:checked').val();
					if(new_strategy_select == "1")
					{
						var new_strategy='';
						
						if(document.getElementById("CodeLangStg5").checked==true)
						{		new_strategy+='CodeLangStg,'; }
						if(document.getElementById("MetaInfoStg5").checked==true)
						{       new_strategy+='MetaInfoStg,';}
						if(document.getElementById("PageStrategyStg5").checked==true)
                        {       new_strategy+='PageStrategyStg,'; }
                        if(document.getElementById("RSSMobileStg5").checked==true)
                        {       new_strategy+='RSSMobileStg,';}
						if(document.getElementById("VareaMarkStg5").checked==true)
                        {       new_strategy+='VareaMarkStg,'; }
                        if(document.getElementById("ContentTypeStg5").checked==true)
                        {       new_strategy+='ContentTypeStg,';}
                        if(document.getElementById("MetaRobotsStg5").checked==true)
                        {       new_strategy+='MetaRobotsStg,'; }
                        if(document.getElementById("ParsePackStg5").checked==true)
                        {       new_strategy+='ParsePackStg,';}
						if(document.getElementById("StatusStg5").checked==true)
                        {       new_strategy+='StatusStg,';}  
                        if(document.getElementById("VhtmlTreeStg5").checked==true)
                        {       new_strategy+='VhtmlTreeStg,';}         
                        if(document.getElementById("IndexFreshnessStg5").checked==true)
                        {       new_strategy+='IndexFreshnessStg,';}
                        if(document.getElementById("MultiSignStg5").checked==true)
                        {       new_strategy+='MultiSignStg,';}         
                        if(document.getElementById("PoliticalFactorStg5").checked==true)
                        {       new_strategy+='PoliticalFactorStg,';}
                        if(document.getElementById("TitleContentStg5").checked==true)
                        {       new_strategy+='TitleContentStg,';}         
                        if(document.getElementById("WiseMetaStg5").checked==true)
                        {       new_strategy+='WiseMetaStg,';}
                        if(document.getElementById("LongSentSignStg5").checked==true)
                        {       new_strategy+='LongSentSignStg,';}         
                        if(document.getElementById("PublishTimeStg5").checked==true)
                        {       new_strategy+='PublishTimeStg,';}
                        if(document.getElementById("TransPassStg5").checked==true)
                        {       new_strategy+='TransPassStg,';}         
                        if(document.getElementById("WordDictStg5").checked==true)
                        {       new_strategy+='WordDictStg,';}
						//alert("new:"+new_strategy);
						if(new_strategy=='')
						{
							alert("请选择策略！");
							return;
						}
						
					}
					var old_strategy_select=$('input:radio[name="old_strategy"]:checked').val();
					if(old_strategy_select == "1")
					{
						var old_strategy='';
						
						if(document.getElementById("CodeLangStg6").checked==true)
						{		old_strategy+='CodeLangStg,'; }
						if(document.getElementById("MetaInfoStg6").checked==true)
						{       old_strategy+='MetaInfoStg,';}
						if(document.getElementById("PageStrategyStg6").checked==true)
                        {       old_strategy+='PageStrategyStg,'; }
                        if(document.getElementById("RSSMobileStg6").checked==true)
                        {       old_strategy+='RSSMobileStg,';}
						if(document.getElementById("VareaMarkStg6").checked==true)
                        {       old_strategy+='VareaMarkStg,'; }
						
                        if(document.getElementById("ContentTypeStg6").checked==true)
                        {       old_strategy+='ContentTypeStg,';}
                        if(document.getElementById("MetaRobotsStg6").checked==true)
                        {       old_strategy+='MetaRobotsStg,'; }
                        if(document.getElementById("ParsePackStg6").checked==true)
                        {       old_strategy+='ParsePackStg,';}
						if(document.getElementById("StatusStg6").checked==true)
                        {       old_strategy+='StatusStg,';}  
                        if(document.getElementById("VhtmlTreeStg6").checked==true)
                        {       old_strategy+='VhtmlTreeStg,';}         
                        if(document.getElementById("IndexFreshnessStg6").checked==true)
                        {       old_strategy+='IndexFreshnessStg,';}
                        if(document.getElementById("MultiSignStg6").checked==true)
                        {       old_strategy+='MultiSignStg,';}         
                        if(document.getElementById("PoliticalFactorStg6").checked==true)
                        {       old_strategy+='PoliticalFactorStg,';}
                        if(document.getElementById("TitleContentStg6").checked==true)
                        {       old_strategy+='TitleContentStg,';}         
                        if(document.getElementById("WiseMetaStg6").checked==true)
                        {       old_strategy+='WiseMetaStg,';}
                        if(document.getElementById("LongSentSignStg6").checked==true)
                        {       old_strategy+='LongSentSignStg,';}         
                        if(document.getElementById("PublishTimeStg6").checked==true)
                        {       old_strategy+='PublishTimeStg,';}
                        if(document.getElementById("TransPassStg6").checked==true)
                        {       old_strategy+='TransPassStg,';}         
                        if(document.getElementById("WordDictStg6").checked==true)
                        {       old_strategy+='WordDictStg,';}
						//alert("old"+old_strategy);
						if(old_strategy=='')
						{	alert('请选择策略！');
							return;
						}
					}
					
				}
 /*-----------------------end international strategy--------------------*/
				var thread_num = $('#thread_num').val();
				
				var new_code_select = $('input:radio[name="radiobutton_bin_new"]:checked').val();
				var old_code_select = $('input:radio[name="radiobutton_bin_old"]:checked').val();
				if (new_code_select == "product_new_code")
                {
					var product_new_version = $('#new_scm').val();
                    if( product_new_version == '' ){
                        alert('请输入新EC版本！');
                        return;
                    }
					if(old_code_select == "product_old_code")
                    {
						var product_old_version = $('#old_scm').val();
                        if( product_old_version == '' ){
                            alert('请输入旧EC版本！'); 
                            return;
                           }
						var data_select = $('input:radio[name="radiobutton_data"]:checked').val();
	                    if (data_select == "platform_data")
    	                {
        	                var platform_data_type = $('#platform_data_type').val();
            	            var platform_data_num  = $('#platform_data_num').val();
	
    	                    if(platform_data_type == '' ){
        	                    alert('请选择数据类型！');
            	                return;
                	        }
	
    	                    if(platform_data_num == '' ){
        	                    alert('请选择数据数量！');
            	                return;
                	        }
	
    	                    var param = {des:des,machine_select:machine_select,type_select:type_select,thread_num:thread_num,newolddiff_select:newolddiff_select,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,product_new_version:product_new_version,old_code_select:old_code_select,product_old_version:product_old_version,data_select:data_select,platform_data_type:platform_data_type,platform_data_num:platform_data_num,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};
							
        	            }
                	    if(data_select == "define_data")
            	        {
                    	    var define_data_ftp_path = $('#define_data_ftp_path').val();

                        	if(define_data_ftp_path == '' ){
                           		alert('请输入DATA的FTP地址！');
	                            return;
    	                    }
							var param = {des:des,machine_select:machine_select,type_select:type_select,thread_num:thread_num,newolddiff_select:newolddiff_select,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,product_new_version:product_new_version,old_code_select:old_code_select,product_old_version:product_old_version,data_select:data_select,define_data_ftp_path:define_data_ftp_path,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};
			
						}
						if(data_select == '' ){
							alert('请选择输入数据！');
						}
					}
					if(old_code_select == "define_old_code" )
					{
						var define_code_old_code_path = $('#define_code_old_code_path').val();
						if(define_code_old_code_path == '' )
						{
				            alert('请输入旧EC的FTP地址！');				         
							return;
			            }
						var data_select = $('input:radio[name="radiobutton_data"]:checked').val();
                    	if (data_select == "platform_data")
                    	{
                        	var platform_data_type = $('#platform_data_type').val();
                        	var platform_data_num  = $('#platform_data_num').val();

                        	if(platform_data_type == '' ){
                            	alert('请选择数据类型！');
                            	return;
                        	}

                        	if(platform_data_num == '' ){
                            	alert('请选择数据数量！');
                            	return;
                        	}

                        	var param = {des:des,machine_select:machine_select,type_select:type_select,newolddiff_select:newolddiff_select,thread_num:thread_num,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,product_new_version:product_new_version,old_code_select:old_code_select,define_code_old_code_path:define_code_old_code_path,data_select:data_select,platform_data_type:platform_data_type,platform_data_num:platform_data_num,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};

                    	}
                    	if(data_select == "define_data")
                    	{
                        	var define_data_ftp_path = $('#define_data_ftp_path').val();
							if(define_data_ftp_path == '' ){
                            alert('请输入DATA的FTP地址！');
                            return;
                        	}

                        	var param = {des:des,machine_select:machine_select,type_select:type_select,newolddiff_select:newolddiff_select,thread_num:thread_num,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,product_new_version:product_new_version,old_code_select:old_code_select,define_code_old_code_path:define_code_old_code_path,data_select:data_select,define_data_ftp_path:define_data_ftp_path,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};

                    	}

                    	if(data_select == '' ){
                        	alert('请选择输入数据！');
                        	return;
                    	}


                	}

				}
				else if(new_code_select == "define_new_code")
				{
					var define_code_new_code_path = $('#define_code_new_code_path').val();
               		
					if(define_code_new_code_path == '' ){
                        alert('请输入新EC的FTP地址！');
                        return;
                    } 
					if(old_code_select == "product_old_code")
                    {
						var product_old_version = $('#old_scm').val();
                        if( product_old_version == '' ){
                            alert('请输入旧EC版本！'); 
                            return;
                           }
						var data_select = $('input:radio[name="radiobutton_data"]:checked').val();
	                    if (data_select == "platform_data")
    	                {
        	                var platform_data_type = $('#platform_data_type').val();
            	            var platform_data_num  = $('#platform_data_num').val();
	
    	                    if(platform_data_type == '' ){
        	                    alert('请选择数据类型！');
            	                return;
                	        }
	
    	                    if(platform_data_num == '' ){
        	                    alert('请选择数据数量！');
            	                return;
                	        }
	
    	                    var param = {des:des,machine_select:machine_select,type_select:type_select,newolddiff_select:newolddiff_select,thread_num:thread_num,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,define_code_new_code_path:define_code_new_code_path,old_code_select:old_code_select,product_old_version:product_old_version,data_select:data_select,platform_data_type:platform_data_type,platform_data_num:platform_data_num,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};

        	            }
                	    if(data_select == "define_data")
            	        {
                    	    var define_data_ftp_path = $('#define_data_ftp_path').val();

                        	if(define_data_ftp_path == '' ){
                           		alert('请输入DATA的FTP地址！');
	                            return;
    	                    }
							var param = {des:des,machine_select:machine_select,type_select:type_select,newolddiff_select:newolddiff_select,thread_num:thread_num,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,define_code_new_code_path:define_code_new_code_path,old_code_select:old_code_select,product_old_version:product_old_version,data_select:data_select,define_data_ftp_path:define_data_ftp_path,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};
						}
						if(data_select == '' ){
                            alert('请选择输入数据！');
                            return; 
                        }    
					}
					if(old_code_select == "define_old_code" )
					{
						var define_code_old_code_path = $('#define_code_old_code_path').val();
						if(define_code_old_code_path == '' )
						{
				            alert('请输入旧EC的FTP地址！');				         
							return;
			            }
						var data_select = $('input:radio[name="radiobutton_data"]:checked').val();
                    	if (data_select == "platform_data")
                    	{
                        	var platform_data_type = $('#platform_data_type').val();
                        	var platform_data_num  = $('#platform_data_num').val();

                        	if(platform_data_type == '' ){
                            	alert('请选择数据类型！');
                            	return;
                        	}

                        	if(platform_data_num == '' ){
                            	alert('请选择数据数量！');
                            	return;
                        	}

                        	var param = {des:des,machine_select:machine_select,type_select:type_select,newolddiff_select:newolddiff_select,thread_num:thread_num,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,define_code_new_code_path:define_code_new_code_path,old_code_select:old_code_select,define_code_old_code_path:define_code_old_code_path,data_select:data_select,platform_data_type:platform_data_type,platform_data_num:platform_data_num,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};

                    	}
                    	if(data_select == "define_data")
                    	{
                        	var define_data_ftp_path = $('#define_data_ftp_path').val();
							if(define_data_ftp_path == '' ){
                            alert('请输入DATA的FTP地址！');
                            return;
                        	}

                        	var param = {des:des,machine_select:machine_select,type_select:type_select,newolddiff_select:newolddiff_select,thread_num:thread_num,newdiff_select:newdiff_select,olddiff_select:olddiff_select,memory_select:memory_select,speed_select:speed_select,Valgrind_select:Valgrind_select,new_code_select:new_code_select,define_code_new_code_path:define_code_new_code_path,old_code_select:old_code_select,define_code_old_code_path:define_code_old_code_path,data_select:data_select,define_data_ftp_path:define_data_ftp_path,new1_strategy_select:new1_strategy_select,new2_strategy_select:new2_strategy_select,old1_strategy_select:old1_strategy_select,old2_strategy_select:old2_strategy_select,new_strategy_select:new_strategy_select,old_strategy_select:old_strategy_select,new1_strategy:new1_strategy,new2_strategy:new2_strategy,old1_strategy:old1_strategy,old2_strategy:old2_strategy,new_strategy:new_strategy,old_strategy:old_strategy};

                    	}

                    	if(data_select == '' ){
                        	alert('请选择输入数据！');
                        	return;
                    	}


                	}
					
				}//end new_ftp

			}
			var reqUrl = "?r=run/localrun";
            $.ajax({
                type:"POST",
                async:true,
                url:reqUrl,
                data:param,
				
                success:function(ajaxObj){
							
                    var result = $.parseJSON(ajaxObj);
                    if (result.result== 1)
                    {
		                  var id=result.task_id
                          alert("任务启动成功，请在“任务列表-->离线运行任务”查看进度");
                    }



                },
                error:function(){
                    alert("请联系QA反馈您遇到的问题!");

                }
            });

		});
	}
new  Downstream();
})();
