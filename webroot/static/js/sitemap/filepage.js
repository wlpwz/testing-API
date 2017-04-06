function showPage(id){
    var finfo = JSON.parse($("#finfo").text());
    var order = JSON.parse($("#order").text());
    var site = $('#site_query').val();
    data = {name:finfo["name"], min:finfo["min"], separator:finfo["separator"], order:order["order"], orderby:order["orderby"], page:id}
    if(site!=""){data["site"] = site}
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
                node += "<td>" + content[i][0] + "</td>";
                node += "<td>" + content[i][1] + "</td>";
                node += "<td>" + content[i][2] + "</td>";
                node += "<td>" + content[i][3] + " / "+ ((content[i][3]/content[i][1])*100).toFixed(2) +"% </td>";
                node += "<td>" + content[i][4] + " / "+ ((content[i][4]/content[i][1])*100).toFixed(2) +"% </td>";
                node += "<td><a href='?r=crawlstatus/detailcse&value=" + content[i][0] + "'>详情</a></td></tr>";
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

