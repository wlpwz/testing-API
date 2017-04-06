<?php /* Smarty version Smarty 3.1.4, created on 2014-12-11 13:46:41
         compiled from "/home/work/ec_test_service/src/views/jenkinsresult/apichart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188602955354892fc18fd941-82727311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21f7023152e99ed3bdc3de3a411de0dcac190bc6' => 
    array (
      0 => '/home/work/ec_test_service/src/views/jenkinsresult/apichart.tpl',
      1 => 1418276798,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188602955354892fc18fd941-82727311',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54892fc19d8ae',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54892fc19d8ae')) {function content_54892fc19d8ae($_smarty_tpl) {?><script src="/assets/js/esl/esl.js"></script>
<script src="/assets/js/pchartsvars.js"></script>


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
                                            <<?php ?>?php  
                                            // $data["high_temperature"]="11, 11, 15, 13, 12, 13, 10";
                                            // $data["low_temperature"]="-2, 1, 2, 5, 3, 2, 0";
                                            // $options[ChartTPL::$CHART_OPTION_LABEL_X]="周一,周二,周三,周四,周五,周六,周日";
                                            ChartFactory::renderChart($chart_id,$chart_type, $data, $options,$height); 
                                            ?<?php ?>>
           
        </div>

                                    </div>
                                </div>
        </div>

</div>
</div>
</div>
</div>
<script src="/assets/js/pexample.js"></script><?php }} ?>