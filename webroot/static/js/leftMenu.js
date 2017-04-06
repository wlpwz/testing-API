$(function(){
    //默认选中当前访问的url
    $(".dl-group dd a").each(function(){
        var url = window.location.href;
		var pattern = /(\?r=[\w|\/]+[#|&]{0,1})/;
        var rs = pattern.exec(url);
        var compare = (rs===null)?'':(rs[0].replace(/[#|&]$/,''));
		var uparam = url.split("?"); 			
		var	urlstr = decodeURIComponent("?" + uparam[1]);		

		if(urlstr != $(this).attr('href')){
			 // if(compare != $(this).attr('href')){
            $(this).removeClass("select");
        }else{
            $(this).addClass("select");
        }
        
    });
    

    //视图展开收起
    $(".navbox h2").click(function(){
        if($(this).hasClass("open")){
            $(this).removeClass("open");
            $(this).nextAll(".innerbox").slideUp();
        }else{
            $(this).addClass("open");
            $(this).nextAll(".innerbox").slideDown();
        }
        //setViewDefault('');   
    });
});
