<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=HOME_ASSERTS;?>css/index.css" rel="stylesheet">
<style>
    a:hover{
      text-decoration: none;
      color: red;
    }
    .list-inline > li{
        padding-top: 3px;
        padding-bottom: 3px;
    }
    .list-inline > li.active{
        background: #4CAE4C;
        color: #fff;
    }
    .list-inline > li.active a{
        color: #fff;
    }
</style>

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

<ol class="breadcrumb">
    <li><a href="<?=site_url('/');?>">首页</a></li>
    <?php if(1!=$typeInfo['pid']):?>
    <li><a href="<?=site_url('/info/category/'.$typeInfo['pid']);?>"><?=$typeInfo['pname'];?></a></li>
    <?php endif;?>
    <li class="active"><?=$typeInfo['name'];?></li>
</ol>

<div class="panel panel-default">
    <div class="panel-body form-horizontal">
        <?php if(isset($infoSubType) && !empty($infoSubType)):?>
        <div class="form-group"> 
            <label for="name" class="col-sm-3 control-label">二级分类：</label>
            <div class="col-sm-8">
                <ul class="list-inline">
                    <li class="active">不限</li>
                <?php foreach ($infoSubType as $k => $item):?>
                    <li><a href="<?=site_url('/info/category/'.$item['pid'].'/'.$item['id']);?>"><?=$item['name'];?></a></li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <?php endif;?>
        
        <?php if(isset($infoTypeAttr) && !empty($infoTypeAttr)) foreach ($infoTypeAttr as $k => $item):?>
        <div class="form-group"> 
            <label for="name" class="col-sm-3 control-label"><?=$item['name'];?>：</label>
            <div class="col-sm-8">
                <ul class="list-inline attr" data-id='<?=$item['id'];?>'>
                    <li class="<?=isset($attr[$item['id']])?'':'active';?>" data-val=''><a href="javascript:;">不限</a></li>
                    <?php foreach (get_attrs_arr($item['value']) as $k => $v):?>
                    <li class="<?=isset($attr[$item['id']]) && $attr[$item['id']]==$k?'active':'';?>" data-val='<?=$k;?>'><a href="javascript:;"><?=$v;?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <?php endforeach;?>
        
        <div class="form-group"> 
            <label for="name" class="col-sm-3 control-label">区域查找：</label>
            <div class="col-sm-8">
                <ul class="list-inline region" data-name='rpid'>
                    <li class="<?=(isset($region_pid) && !empty($region_pid))?'':'active';?>"><a href="javascript:;">不限</a></li>
                <?php foreach ($region_one as $k => $item):?>
                    <li class="<?=(isset($region_pid) && $region_pid==$item['id'])?'active':'';?>" data-id="<?=$item['id'];?>"><a href="javascript:;"><?=$item['name'];?></a></li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        
        <?php if(isset($region_two) && !empty($region_two)):?>
        <div class="form-group"> 
            <label for="name" class="col-sm-3 control-label"></label>
            <div class="col-sm-8">
                <ul class="list-inline region" data-name='rsid'>
                    <li class="<?=(isset($region_sid) && !empty($region_sid))?'':'active';?>"><a href="javascript:;">不限</a></li>
                <?php foreach ($region_two as $k => $item):?>
                    <li class="<?=(isset($region_sid) && $region_sid==$item['id'])?'active':'';?>" data-id="<?=$item['id'];?>"><a href="javascript:;"><?=$item['name'];?></a></li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>

<div class="panel panel-danger" id="infoNewPanel">
  <div class="panel-heading">
    <strong><?=$typeInfo['name'];?></strong>&nbsp;信息
  </div>
  <div class="panel-body">
      <ul class="media-list" id="infoList">
          <?php if(isset($infoNew) && !empty($infoNew)):?>
              <?php foreach ($infoNew as $k => $item):?>
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
                    <!--<span class="hidden-xs"><?=$item['t1_name'].'-'.$item['t2_name'];?>&nbsp;&nbsp;</span>-->
                    <span class="hidden-xs"><a href="<?=site_url('/info/category/'.$item['type_one_id']);?>"><?=$item['t1_name'];?></a>-<a href="<?=site_url('/info/category/'. $item['type_one_id'].'/'.$item['type_two_id']);?>"><?=$item['t2_name'];?></a>&nbsp;&nbsp;</span>
                    <span><?=$item['r1_name']. ($item['addr_two_id']==0?'':'-'.$item['r2_name']);?></span>&nbsp;&nbsp;
                    <span><?=timeShow($item['update_at']);?></span>
                  </div>
                </li>
                <?php endforeach;?>
            <?php else:?>
                <li class="media text-center">暂无信息</li>
            <?php endif;?>  
          
          <?php if( !($page['now']==1 && $page['now']==$page['pageCount']) && 0 != $page['total']):?>
          <nav>
            <ul class="pager">
                <li class="<?=($page['now']==1)?'disabled':'';?>" data-go="<?=($page['now']-1);?>"><a href="javascript:;">&larr; 上一页</a></li>
              <li class="<?=($page['now']<$page['pageCount'])?'':'disabled';?>" data-go="<?=($page['now']+1);?>"><a href="javascript:;">下一页 &rarr;</a></li>
            </ul>
          </nav>
          <?php endif;?>
      </ul>
  </div>
</div>

<script src="<?=ASSETS;?>jquery/jquery.scrollLoading.js"></script>
<script src="<?=HOME_ASSERTS;?>js/category.js"></script>