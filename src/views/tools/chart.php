<script type="text/javascript" src="static/js/esl.js"></script>
<script type="text/javascript" src="static/js/pchartsvars.js"></script>
<div class="container-fluid outer">
<div class="row-fluid">
<div class="span12  inner padding10">

<br>
<div>
<div class="row-fluid" style="float:left">
	<div class="box span12">
	 <header style="width: 800px;">
		<div class="icons"><i class="icon-edit"></i></div>
		<div class="toolbar">
			<a href="#latter_Table" data-toggle="collapse" class="accordion-toggle minimize-box"><i class="icon-chevron-up"></i></a>
		</div>
	</header>
	<div id="latter_Table" class="body collapse in" style="width: 800px;">
		<div class="span12">
			<?php  
				ChartFactory::renderChart($chart_id,$chart_type, $data, $options,$height); 
			?>
		</div>
	</div>
</div>
</div>

<div style="float:right;margin-right: 798px;margin-top: 120px;">
		<td>MAX:<?php echo $maxmemory ?></td>
		<br>
		<td>MIN:<?php echo $minmemory ?></td>
</div>

</div>

</div>
</div>
</div>

<script type="text/javascript" src="static/js/pexample.js"></script>
