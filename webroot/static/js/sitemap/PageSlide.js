$(document).ready(function(){
		document.getElementById("display_num").value = '<?php echo $count_page?>';
		document.getElementById("condition_search").value = '<?php echo $condition;?>';
		var condition = document.getElementById("condition_search").value;
		var display_num = document.getElementById("display_num").value;
		display_num = Number(display_num);
		var CurrentPage = '<?php echo $CurrentPage;?>';
		CurrentPage = Number(CurrentPage);
		PrePage = CurrentPage - 1;
		if(PrePage == 0)
		{
			PrePage = 1;
			//alert("已到首页！");
		}
		var html = '<ul class="pageNum">';
		html += '<li class="" style="width: 100px;">共 <?php echo $COUNT;?> 条数据&nbsp;</li>'
		html += '<li class=""><a href="?r=cseplatform/index&page=1&display_num='+display_num+'&condition='+condition+'">首	页</a>&nbsp;</li>'
		html += '<li class=""><a href="?r=cseplatform/index&page='+PrePage+'&display_num='+display_num+'&condition='+condition+'" id="pre_page">上一页</a>&nbsp;</li>'
		
		var COUNT = '<?php echo $COUNT;?>';//数据库查询结果总数
		var itemNum = display_num;//每页显示多少条元素（即表格的行数）
		var maxNum = 5;//每次显示5页
		var MiddlePage = Math.ceil(maxNum/2);//中间页
		var CountPage = Math.ceil(COUNT/itemNum)//共多少页
		//var CurrentPage = 3;//当前页
		var total = (CountPage <= maxNum) ? CountPage : maxNum; //每次显示5页或全部页（全部页小于5）
		var OffsetPage = 0;
		if(CountPage > 1)
		{
			if(CountPage > maxNum)
			{
				(((CurrentPage - MiddlePage + maxNum)>CountPage) && (OffsetPage = CountPage - maxNum)) || ((CurrentPage > MiddlePage) && (OffsetPage = CurrentPage - MiddlePage));			
				
			}
			for(var i=1; i<=total; i++)
			{
				var n = i + OffsetPage;
				if(n == CurrentPage)
				{
					//html += '<li class="num active"><a href="?r=cseplatform/index&page='+n+'&display_num='+display_num+'&condition='+condition+'"> '+ n +' </a></li>';
					html += '<a href="?r=cseplatform/index&page='+n+'&display_num='+display_num+'&condition='+condition+'"><li class="num active"> '+n+ '</li></a>';
				}
				else
				{
					//html += '<li class="num"><a href="?r=cseplatform/index&page='+n+'"> '+ n +' </a></li>';
					html += '<a href="?r=cseplatform/index&page='+n+'&display_num='+display_num+'&condition='+condition+'"><li class="num"> '+n+ '</li></a>';
				}
			}
		}	
		NextPage = CurrentPage+1;
		if(NextPage > CountPage)
		{
			NextPage = CountPage;
			//alert("已是最后一页!");
		}
		html += '<li class="">&nbsp;<a href="?r=cseplatform/index&page='+ NextPage +'&display_num='+display_num+'&condition='+condition+'" id="next_page">下一页</a></li>';
		html += '<li class="">&nbsp;<a href="?r=cseplatform/index&page='+CountPage+'&display_num='+display_num+'&condition='+condition+'">尾	页</a></li>';
		html += '<li class="" style="width:150px;">当前'+CurrentPage+' 页，共 '+CountPage+' 页</li></ul>';
		$(".slidePage").html(html);
	
		var activePage = $(".pageNum li.active a").html();
		$("#pre_page").bind("click",function(){
			//var activePage = $(".pageNum li.active a").html();
			if(activePage == 1)
			{
				alert('已到首页！');
				return;
			}
			var pageNum = Number(activePage) - 1;
			location.href = '?r=cseplatform/index&page='+pageNum;
		});
		$("#next_page").click(function(){
			//var activePage = $(".pageNum li.active a").html();
			if(activePage == CountPage)
			{
				alert('已到尾页！');
				return;
			}
			var pageNum = Number(activePage) + 1;
			location.href = '?r=cseplatform/index&page='+pageNum;
		});
		
});


