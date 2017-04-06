<script type="text/javascript" src="static/js/esl.js"></script>
<script type="text/javascript" src="static/js/pchartsvars.js"></script>

<div class="container-fluid outer">
<div class="row-fluid">
<div class="span12  inner padding10">

<br>

<div class="row-fluid">
            <div class="box span12">
                                        <header>
                                             <div class="icons"><i class="icon-edit"></i></div>
                                            <div class="toolbar">
                                                <a href="#latter_Table" data-toggle="collapse" class="accordion-toggle minimize-box">
                                                    <i class="icon-chevron-up"></i>
                                                </a>
                                            </div>
                                        </header>
                                        <div id="latter_Table" class="body collapse in">
                                        <div class="span12">
                                            <?php  
                                            // $data["high_temperature"]="11, 11, 15, 13, 12, 13, 10";
                                            // $data["low_temperature"]="-2, 1, 2, 5, 3, 2, 0";
                                            // $options[ChartTPL::$CHART_OPTION_LABEL_X]="周一,周二,周三,周四,周五,周六,周日";
											ChartFactory::renderChart($chart_id,$chart_type, $data, $options,$height);
                                            ?>
           
        </div>

                                    </div>
                                </div>
        </div>

</div>
</div>
</div>
</div>
<script type="text/javascript" src="static/js/pexample.js"></script>
