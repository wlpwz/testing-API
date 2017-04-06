function showPage(id){
    var finfo = JSON.parse($("#finfo").text());
    var order = JSON.parse($("#order").text());
    var site = $('#site_query').val();
    data = {name:finfo["name"], min:finfo["min"], separator:finfo["separator"], order:order["order"], orderby:order["orderby"], page:id}
    if(site!=""){data["site"] = site;data["query_seq"]=1}
    $.ajax({
        url:"?r=crawlstatus/pages",
        type:"POST",
        data:data,
        success:function(data, status){
            var obj = JSON.parse(data);
            var content = obj["content"];
            var listtr = $("#allsite").find("tr");
            for(var i=0; i<listtr.length; i++){
                listtr[i].remove()
            }
            var node=""    
            for(var i=0; i<content.length; i++){
                node +="<tr>"
                for(var j=0; j<content[i].length; j++){
                    node += "<td>" + content[i][j] + "</td>";
                }
            }
            $("#allsite").html(node);
            $('#slidePage').html(obj["page"]);
        }
    
    });
    
};
function orderBySeq(id){
    var order = JSON.parse($("#order").text());
    if(order["orderby"]==id){
        if(order["order"]=="desc"){
            order["order"] ="asc";
        }else{
            order["order"] ="desc";
        }
    }else{
        order["orderby"]=id
        order["order"] ="desc";
    }
    var orderstr = JSON.stringify(order)
    $("#order").text(orderstr)
    showPage(1)
}

