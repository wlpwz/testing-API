{%$this->beginContent('/layouts/main', ['current'=>'home'])%}
<!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.css" rel="stylesheet">
    <link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 
    <!-- Custom styles for this template -->
    <link href="static/css/carousel.css" rel="stylesheet">
  <style type="text/css" id="holderjs-style"></style></head>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
      <!--  <li data-target="#myCarousel" data-slide-to="0" class=""></li>-->
        <li class="active" data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
     <!--   <div class="item">
          <img src="pic/white.jpg" data-src="" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
				<div style="margin-bottom:100px"></div>
            </div>
          </div>
        </div>-->
        <div class="item active">
       <!--   <img src="pic/代码图.jpg" data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide">-->
		<img src="pic/code.jpg" data-src="" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
            	 <h1 style="font-family:'微软雅黑'">本地-在线运行    一触即达</h1>
                <div style="margin-bottom:100px"></div>
			</div>
          </div>
        </div>
        <div class="item">
          <img src="pic/blue.jpg" data-src="" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
                <div style="margin-bottom:100px"></div>
			</div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing" id="marketing">
		
      <!-- Three columns of text below the carousel -->
      <div class="row">
		<br>
		<h2 align="center" style="font-family:'微软雅黑'">主要功能</h2>
		<br>
		
        <div class="col-lg-4">
			<div align="center">
            	<div class="icon_imgwap icon_2" style=" width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
		     	<a href="/?r=run/index" ><i class="fa fa-rocket" style="font-size: 70px; padding-top: 25px;"></i></a>
				</div>
            	<h3 >轻松运行</h3>
			</div>
        </div>

<!-- /.col-lg-4 -->
<!--        <div class="col-lg-4">
			<div align="center">
				<div class="icon_imgwap icon_1" style="width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
             		<a href="/?r=combined/index" ><i class="fa fa-check" style="font-size: 70px; padding-top: 25px;"></i></a>
			 	</div>
          		<h3>联调一下</h3>
			</div>
        </div>--><!-- /.col-lg-4 -->
        <div class="col-lg-4">
  		<!--	<img src="" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140">-->
			<div align="center">
				<div class="icon_imgwap icon_3" style="width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
         			<a href="/?r=diff/index" ><i class="fa fa-bar-chart-o" style="font-size: 70px; padding-top: 25px;"></i></a>
				</div>
				<h3>效果分析</h3>
			</div>
        </div><!-- /.col-lg-4 -->
		<div class="col-lg-4">
		<!--  <img src="" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140"/>-->
		  	<div align="center">
				<div class="icon_imgwap icon_5" style="width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
             	<a href="/?r=version/index" ><i class="fa fa-gavel" style="font-size: 70px; padding-top: 25px;"></i></a>

          		</div>
		  		<h3>版本管理</h3>
			</div>
		 <!-- <p><a class="btn btn-primary" href="/?r=version/index" role="button">进入EC版本管理</a></p>-->
		</div>
<!--	</div>
	<div class="row">-->
		<div class="col-lg-4">
		<!--  <img src="" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140"/>-->
			<div align="center">
			  	<div class="icon_imgwap icon_4" style="width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
             	<a href="/?r=ecTask/runmission" ><i class="fa fa-list-ul" style="font-size: 70px; padding-top: 25px;"></i></a>

          		</div>
		  		<h3>任务列表</h3>
			</div>
		  <!--<p><a class="btn btn-primary" href="/?r=ecTask/dreport" role="button">任务列表</a></p>-->
		</div>
		<!--div class="col-lg-4">
         <img src="" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140"/>
			<div align="center">
          		<div class="icon_imgwap icon_6" style="width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
             	<a href="/?r=tools/index" ><i class="fa fa-wrench" style="font-size: 70px; padding-top: 25px;"></i></a>

          		</div>
          		<h3>实用工具</h3>
			</div>
        </div-->
	  
		<!--<div class="col-lg-4">
          	<div align="center">
				<div class="icon_imgwap icon_7" style=" width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
             	<a href="/?r=abstract/index" ><i class="fa fa-users" style="font-size: 70px; padding-top: 25px;"></i></a>

          		</div>
          		<h3>深入浅出</h3>
			</div>
        </div>-->
       </div><!-----------end row--->
	   <div class="row">
			<div class="col-lg-4">
        <!--  <img src="" style="width: 140px; height: 140px;" class="img-circle" data-src="holder.js/140x140" alt="140x140"/>-->
            <div align="center">
                <div class="icon_imgwap icon_6" style="width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
                <a href="/?r=tools/index" ><i class="fa fa-wrench" style="font-size: 70px; padding-top: 25px;"></i></a>

                </div>
                <h3>实用工具</h3>
            </div>      
          <!--<p><a class="btn btn-primary" href="/?r=ecTask/dreport" role="button">任务列表</a></p>-->
        </div>    
			<div class="col-lg-4">
				<div align="center">
				<div class="icon_imgwap icon_7" style=" width: 120px; height: 120px; -webkit-transform: rotate(360deg);">
					<a href="?r=ecmonitor/index" ><i class="fa fa-users" style="font-size: 70px; padding-top: 25px;"></i></a>
				</div>
				<h3>EC监控</h3>
				</div>
			</div>
	   </div>
	   <div class="row">
			<hr />
			<br><br>
			<h2 align="center" style="font-family:'微软雅黑'">操作指南</h2>
			<br><br>
			<div align="center">
			<img src="pic/step.png" style="width: 650px; height: 200px;" />
			</div>
	   </div>
	   <div class="row">
		<hr />
		   <br><br>
			<h2 align="center" style="font-family:'微软雅黑'">平台优势</h2>
			<br><br><br>
			<div align="center">
			<img src="pic/goodat.png" style="width: 700px; height: 400px;" />
			</div>
	   </div>
</div>
	

 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--script src="static/js/jquery.js"></script>
    <script src="static/js/bootstrap.js"></script>
    <script src="static/js/holder.js"></script-->


{%$this->endContent()%}
