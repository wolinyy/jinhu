<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--<link href="<?=ASSETS;?>Jcrop/css/jquery.Jcrop.min.css" rel="stylesheet">-->

<style>
    .panel-title{
        padding: 5px 15px;
        font-size: 20px;
        font-weight: 700;
    }
</style>

<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="row panel-title">
                  <?=$title;?>
              </h3>
            </div>

            <div class="panel-body">
                <?php if(isset($imgs) && !empty($imgs)):?>
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach ($imgs as $key => $value):?>
                        <li data-target="#carousel" data-slide-to="<?=$key;?>" class="<?=$key==0?'active':'';?>"></li>
                      <?php endforeach;?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($imgs as $key => $value):?>
                            <div class="item <?=$key==0?'active':'';?>">
                              <img src="<?=IMG_URL . $value['path'];?>">
                            </div>
                        <?php endforeach;?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
                <?php endif;?>
                
                <dl class="dl-horizontal"></dl>
                
                <dl class="dl-horizontal" id="title">
                    <dt>标题：</dt>
                    <dd><?=$title;?></dd>
                </dl>
                
                <!--1-行文本 2-单选 3-多选 4-文本域 5-数值型行文本-->
                <dl class="dl-horizontal" id="attrs">
                    <?php if(isset($attrs) && !empty($attrs)) foreach ($attrs as $k => $item):?>
                    <dt><?=$item['name'];?>：</dt>
                    <dd>
                        <?php switch ($item['type']) {
                                case 1: 
                                    echo $item['attr_value_text'] . $item['value'];
                                    break;
                                case 2: 
                                    echo get_attrs_value($item['value'], $item['attr_value_text']);
                                    break;
                                case 3: 
                                    if(!empty($item['attr_value_text'])){
                                        echo get_attrs_value($item['value'], explode(',', $item['attr_value_text']));
                                    }else{
                                        echo '无';
                                    }
                                    break;
                                case 4: 
                                    echo $item['value'];
                                    break;
                                case 5: 
                                    echo $item['attr_value_float'] . $item['value'];
                                    break;
                                default:
                                break;
                                }
                        ?>
                    </dd>
                    
                    <?php endforeach;?>
                </dl>
                
                <dl class="dl-horizontal" id="lx_way">
                    <dt>联系人：</dt>
                    <dd data-ip='<?=$ip;?>'><?=$name;?></dd>
                    <dt>联系电话：</dt>
                    <dd><?=$phone;?></dd>
                    <?php if(!empty($addr_detail)):?>
                    <dt>详细地址：</dt>
                    <dd><?=$addr_detail;?></dd>
                    <?php endif;?>
                    <?php if(!empty($qq)):?>
                    <dt>联系QQ：</dt>
                    <dd><?=$qq;?> &nbsp;
                        <?php if(!empty($qq)):?>
                        <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$qq;?>&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?=ASSETS;?>img/qq_tail.jpg"></a>
                        <?php endif;?>
                    </dd>
                    <?php endif;?>
                    <?php if(!empty($email)):?>
                    <dt>电子邮箱：</dt>
                    <dd><?=$email;?></dd>
                    <?php endif;?>
                </dl>
                
                <dl class="dl-horizontal" id="xxxq">
                    <dt>信息详情：</dt>
                    <dd><?=str_replace("\n", '<br />', $content);?></dd>
                </dl>
                
		<h4 class="text-danger text-center">联系我时,请说是在&nbsp;<a href='<?=site_url();?>'><strong><?=WEB_SITE;?></strong></a>&nbsp;上看到的,谢谢!</h4>

                <div class="row">
                    <?php if(isset($imgs) && !empty($imgs)) foreach ($imgs as $key => $value):?>
                        <div class="col-xs-6">
                            <img src="<?=IMG_URL . $value['path'];?>" class="img-thumbnail">
                        </div>
                    <?php endforeach;?>
                </div>
            </div>   
        </div>
    </div>
</div>
