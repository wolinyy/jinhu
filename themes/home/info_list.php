<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=HOME_ASSERTS;?>css/index.css" rel="stylesheet">

<div class="row" id="searchBox">
<!--  <div class="col-sm-3">
  </div>-->
  <div class="col-sm-6 col-sm-offset-3">
    <div class="input-group has-success">
        <input type="text" class="form-control" placeholder="请输入信息标题中的关键词">
      <span class="input-group-btn">
          <button class="btn btn-success" type="button">搜索</button>
      </span>
    </div>
  </div>
  <div class="col-sm-3 text-right">
      <a href="<?=  site_url('/info/info_add');?>" class="btn btn-danger" type="button">免费发布信息</a>
  </div>
</div>

<div class="panel panel-danger" id="infoNewPanel">
  <div class="panel-heading">
    淮安金湖县最新发布的<?=$limitCnt;?>条信息，首页免费展示！快点免费发布信息吧！
  </div>
  <div class="panel-body">
      <ul class="media-list" id="infoList">
          <?php if(isset($infoNew) && !empty($infoNew)) foreach ($infoNew as $k => $item):?>
          <li class="media">
              <a class="media-left" href="<?=site_url('info/details/'.$item['id']);?>">
                <?php if(isset($item['imgs']) && !empty($item['imgs'])):?>
                    <div class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php foreach ($item['imgs'] as $k => $v):?>
                            <div class="item <?=$k==0?'active':'';?>">
                                <img class="scrollLoading" data-url="<?=IMG_URL . $v['path'];?>" src="<?=ASSETS;?>img/nophoto.gif">
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php else:?>
                <img src="<?=ASSETS;?>img/nophoto.gif">
                <?php endif;?>
            </a>
            <div class="media-body">
              <h4 class="media-heading"><a href="<?=site_url('info/details/'.$item['id']);?>"><?=$item['title'];?></a></h4>
              <p><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?></p>
              <span class="hidden-xs"><?=$item['t1_name'].'-'.$item['t2_name'];?>&nbsp;&nbsp;</span>
              <span><?=$item['r1_name']. ($item['addr_two_id']==0?'':'-'.$item['r2_name']);?></span>&nbsp;&nbsp;
              <span><?=date('Y-m-d', $item['update_at']);?></span>
            </div>
          </li>
          <?php endforeach;?>
      </ul>
  </div>
</div>

<script src="<?=ASSETS;?>jquery/jquery.scrollLoading.js"></script>
<script src="<?=HOME_ASSERTS;?>js/index.js"></script>