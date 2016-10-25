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
    
    .form-group div + div{
        margin-top: 10px;
    }
    
    @media (min-width: 768px) {
        .form-group label{
            padding: 0;
        }
    }
    
</style>

<div class="row" id="searchBox">
<!--  <div class="col-sm-3">
  </div>-->
  <form class="col-sm-6 col-sm-offset-3" action="<?=site_url('/info/search');?>" method="get">
    <div class="input-group has-success">
        <input type="text" class="form-control" placeholder="请输入信息标题中的关键词" name="key" value="<?=isset($key)?$key:'';?>">
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
    <li class="active">搜索</li>
</ol>

<div class="row" id="searchBox">
    <div class="col-md-4 col-md-push-8">
        <div class="panel panel-default">
        <div class="panel-heading">
            <strong>信息检索</strong>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group"> 
                <label for="name" class="col-sm-4 control-label">信息分类：</label>
                <div class="col-sm-6">
                    <select id="type_one_id" name="type_one_id" class="select-base form-control field" required
                            data-val ="<?=  isset($type_one_id)?$type_one_id:'';?>" data-url="/admin/info_type/getT1Name" data-def_text='一级分类'>
                        <option value="">一级分类</option>
                    </select>
                </div>
                <div class="col-sm-6 col-sm-offset-4">
                    <select id="type_two_id" name="type_two_id" class="select-base form-control field" required
                            data-val ="<?=isset($type_two_id)?$type_two_id:'';?>" data-def_text='二级分类'>
                        <option value="">二级分类</option>
                    </select>
                </div>
            </div>

            <div class="form-group"> 
                <label for="name" class="col-sm-4 control-label">区域查找：</label>
                <div class="col-sm-6 ">
                    <select id="addr_one_id" name="addr_one_id" class="select-base form-control field" required
                            data-val ="<?=isset($addr_one_id)?$addr_one_id:'';?>" data-url="/admin/region/getT1Name" data-def_text='镇'>
                        <option value="">镇</option>
                    </select>
                </div>
                <div class="col-sm-6 col-sm-offset-4">
                    <select id="addr_two_id" name="addr_two_id" class="select-base form-control field" 
                            data-val ="<?=isset($addr_two_id)?$addr_two_id:'';?>" data-def_text='乡村'>
                        <option value="">乡村</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group"> 
                <label for="title" class="col-sm-4 control-label">关键词：</label>
                <div class="col-sm-6">
                    <input class="form-control field" name="title" id="title" placeholder="关键词" value="<?=isset($key)?$key:'';?>">
                </div>
            </div>
            
            <div class="form-group"> 
                <!--<label for="" class="col-sm-3 control-label"></label>-->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="searchBtn">&nbsp;&nbsp;搜索&nbsp;&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-8 col-md-pull-4">
        <div class="panel panel-danger" id="infoNewPanel">
      <div class="panel-heading">
        <strong>搜索</strong>&nbsp;结果
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
                        <h4 class="media-heading"><a href="<?=site_url('info/details/'.$item['id']);?>"><?=searchKeyShow($item['title'], isset($key)?$key:'');?></a></h4>
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
    </div>
</div>

<script>
    var type = <?=json_encode($infoType);?>;
    var region = <?=json_encode($infoRegion);?>;
    var param = <?=json_encode($_GET);?>;
    delete param['pageNow'];
</script>
<script src="<?=ASSETS;?>jquery/jquery.scrollLoading.js"></script>
<script src="<?=HOME_ASSERTS;?>js/search.js"></script>