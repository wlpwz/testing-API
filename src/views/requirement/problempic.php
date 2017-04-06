<link href="static/echarts/src/asset/css/bootstrap-responsive.css" rel="stylesheet"/>
<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
			<!-- Left column/section -->
      <ul class="nav nav-tabs">
            <li><a href="?r=requirement/problemtab">问题列表</a></li>
            <li class="active"><a href="?r=requirement/problempic">图表分析</a></li>
      </ul>
			<section class="column full first">
				<iframe frameborder=0 scrolling=no width="100%" height=460px src="http://tservice.baidu.com/chart/apipie?data=
        <?php
          $i=0; 
          foreach($typeList as $type=>$count)
          {
           $i++;
           if(sizeof($typeList)!=$i)
           {echo $type.",".$count.";";}
           else{echo $type.",".$count;}
          } 
        ?>
        &height=360&legend_x=center&legend_y=right&legend_orient=horizontal"></iframe> 
        <iframe frameborder=0 scrolling=no width="100%" height=460px src="http://tservice.baidu.com/chart/apiline?data=问题统计,
        <?php
          foreach($timeList as $type=>$count)
          {
            echo $count.",";
          }
          echo "&label_x=";
          foreach($timeList as $type=>$count)
          {
            echo date("Y-m-d",$type).",";
          }
            echo "&height=300";
        ?>
        "></iframe>
			</section>
		</div>
</div>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

	});
</script>
