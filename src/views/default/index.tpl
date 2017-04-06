<!-- {%$this->beginContent('/layouts/column1', ['topic'=>$topic])%}

{%$manWhiteList = [
        'zhanghao15', 'baiyang03'
]%}  -->
<div class="page-title"><i class="i_icon"></i> EC 基本参数配置 </div>
  <div class="pd10 left">
    <div class="page-search"> 
      业务:  
      <select name="topic" class="select">
        <option value="">全部</option>
        {%html_options options=$topic_list selected=$topic%}
      </select>
      状态：      
      <select name="state" class="select">
        <option value="">全部</option>  
        {%html_options options=$state_list selected=$state%}
      </select>
      关键字：
      <input type="text" name="keyword" class="input" width="160" value="{%$keyword%}">
      <a href="javascript:;" class="btn btn-primary search"><i class="icon16 icon16-zoom"></i> 搜索</a> </div>
    <div class="page-operate mt10">
      {%if $topic > 0%}
        <a href="?r=site/edit&topic={%$topic%}" class="btn btn-primary">提测新项目</a>
      {%/if%}
     </div> 
      <div class="panel">
<div class="list-table" id="list-table">
</div>













</div>
<div class="list-page">
  <div class="i-list" id="slidePage"> 
    <!--     <span><</span>
         <span class="active">1</span>
         <a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">></a>  -->
  </div>
  <div class="clear"></div>
</div>
  </div>

<div style="display:none;">
    <p id="statListJson">{%json_encode($state_list)%}</p>
    <p id="topicListJson">{%json_encode($topic_list)%}</p>
    <p id="count">{%$data['count']%}</p>
    <p id="pagenum">{%$data['page']%}</p>
    <p id="pagesize">{%$data['pagesize']%}</p>
</div>
<script src="static/js/list.js" type="text/javascript"></script> 

{%$this->endContent()%}
