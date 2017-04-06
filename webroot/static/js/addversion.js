$(document).ready(function(){
        $('#add-button').bind('click',function(){
            $('.add-form').toggle();
            return false;
        });
        $('#create').bind('click',function(){
                var sendData;
                var version = $('#EcVersionControl_version').val();
                var language = $('#EcVersionControl_language').val();
                var ecc_version = $('#EcVersionControl_ecc_version').val();
                var framework_version = $('#EcVersionControl_framework_version').val();
                var pagevalue_version = $('#EcVersionControl_pagevalue_version').val();
                var is_splited = $('#EcVersionControl_is_splited').val();
                sendData = {version: version, language: language, ecc_version: ecc_version,framework_version:framework_version,pagevalue_version:pagevalue_version,is_splited:is_splited};
                console.log(sendData);
                $.ajax({
            		type: "POST",
                    url: "/?r=version/create",
                    dataType: "json",
                    data: sendData,
                    success: function(data){
                        if(data.status == 1){
                            alert("保存成功！");
                            window.location.href="?r=version/index";
                        }else{
                            alert("保存失败！");
                        }
                    }    
				});
        });
    }); 
