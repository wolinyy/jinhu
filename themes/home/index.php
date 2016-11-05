<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=HOME_ASSERTS;?>css/index.css" rel="stylesheet">

<div class="row" id="searchBox">
<!--  <div class="col-sm-3">
  </div>-->
  <form class="col-sm-6 col-sm-offset-3" action="<?=site_url('/info/search');?>" method="get">
    <div class="input-group has-success">
        <input type="text" class="form-control" placeholder="请输入信息标题中的关键词" name="key">
      <span class="input-group-btn">
          <button class="btn btn-success" type="submit">搜索</button>
      </span>
    </div>
  </form>
  <div class="col-sm-3 text-right">
      <a href="<?=  site_url('/info/info_add');?>" class="btn btn-danger" type="button">免费发布信息</a>
  </div>
</div>

<div class="row" id="infoTypeBox">
    <?php $oldPid = -1; if(isset($infoType) && !empty($infoType)) foreach ($infoType as $k => $v):?>
        <?php
            if(!$oldPid || $oldPid != $v['pid']){
                $oldPid = $v['pid'];
            }else{
                continue;
            }
        ?>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" data-id='<?=$v['pid'];?>'>
                    <img src="<?=ASSETS;?>img/type/<?=$v['icon'];?>">
                    <span><?=$v['pname'];?></span>
                    <i class="glyphicon glyphicon-chevron-left" title="点击 展开/收起 子分类"></i>
                </div>
                <div class="panel-body row" style="display:none;">
                <?php if(isset($infoType) && !empty($infoType)) foreach ($infoType as $k => $item):?>
                    <?php if($oldPid == $item['pid']):?>
                    <div class="col-xs-6">
                        <a href="<?=  site_url('/info/category/'.$item['pid'].'/'.$item['id']);?>"><?=$item['name'];?></a>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>

<div class="panel panel-danger" id="infoNewPanel">
  <div class="panel-heading">
    <strong><?=WEB_SITE;?></strong>&nbsp;最新发布的&nbsp;<strong><?=$limitCnt;?></strong>&nbsp;条分类信息，首页免费展示！快点免费发布信息吧！
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
                <h4 class="media-heading">
                    <a href="<?=site_url('info/details/'.$item['id']);?>"><?=$item['title'];?></a>
                </h4>
                
              <p><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?><?=$item['content'];?></p>
              <span class="hidden-xs"><a href="<?=site_url('/info/category/'.$item['type_one_id']);?>"><?=$item['t1_name'];?></a>-<a href="<?=site_url('/info/category/'. $item['type_one_id'].'/'.$item['type_two_id']);?>"><?=$item['t2_name'];?></a>&nbsp;&nbsp;</span>
              <span><?=$item['r1_name']. ($item['addr_two_id']==0?'':'-'.$item['r2_name']);?></span>&nbsp;&nbsp;
              <span><?=timeShow($item['update_at']);?></span>
            </div>
          </li>
          <?php endforeach;?>
      </ul>
  </div>
</div>

<script src="<?=ASSETS;?>jquery/jquery.scrollLoading.js"></script>
<script src="<?=HOME_ASSERTS;?>js/index.js"></script>
