<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=ADMIN_ASSERTS;?>css/timeline.css" rel="stylesheet">
<!--<link rel="stylesheet" href="<?=ADMIN_ASSERTS;?>css/weixinLinkWiFi.css?ver=1">-->

<div class="row row-offcanvas row-offcanvas-right">
    
    

    <div class="row col-xs-12 col-sm-12" id="sel_type">
        <?php foreach ($type_one as $item):?>
        <div class="col-xs-6 col-sm-4">
            <span><?=$item['name'];?></span>
            <ul>
            <?php foreach ($type_one as $val):?>
                <li><a><?=$val['name'];?></a></li>
            <?php endforeach;?>
            </ul>
        </div>
        <?php endforeach;?>
    </div>
    
<!--    <div class="col-xs-12 col-sm-3 pull-right">
        <div class="list-group">
            <a href="/admin/help" class="list-group-item">配置向导</a>
            <a href="/admin/help/wechatLinkWiFi" class="list-group-item active">微信连WiFi</a>
        </div>
    </div>-->
</div><!--/row-->