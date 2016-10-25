<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=HOME_ASSERTS;?>css/mng.css" rel="stylesheet">

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">信息列表</span>
          
          <div class="btn-toolbar">
            <div class="btn-group btn-group-sm hide">
                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#search-div">
                    <span class="glyphicon glyphicon-search"></span> 搜索
                </button>
                <button type="button" class="btn btn-default refresh">
                    <span class="glyphicon glyphicon-refresh"></span> 刷新
                </button>
            </div>
            <div class="btn-group btn-group-sm">
                <a href="<?=  site_url('/info/info_add');?>" class="btn btn-danger" type="button">免费发布信息</a>
                <button type="button" id="batch_del" class="btn btn-default" data-url='/info/info_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead data-get='/info/get' data-uptime='/info/info_uptime'
               data-add='/info/add' data-edit='/admin/info/edit' data-del='/info/info_del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th>标题</th>
                <th class="hidden-xs hidden-sm">联系人</th>
                <th class="hidden-xs hidden-sm">联系电话</th>
                <th>状态</th>
                <th class="hidden-xs hidden-sm">创建时间</th>
                <th class="sort">更新时间</th>
                <th class="hidden-xs hidden-sm">有效时长</th>
                <th class="operation" style="min-width:50px;">操作</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php if(!empty($infoNew)):?>
                <?php foreach ($infoNew as $key => $value):?>
                <tr>
                    <td><label class="checkbox-inline">&nbsp;<input type="checkbox" value="<?=$value['id'];?>"><?=$key+1+($page['now']-1)*$page['size'];?></label></td>
                    <td><a href="<?=  site_url('info/details/'.$value['id']);?>"><?=$value['title'];?></a></td>
                    <td class="hidden-xs hidden-sm"><?=$value['name'];?></td>
                    <td class="hidden-xs hidden-sm"><?=$value['phone'];?></td>
                    <td><?=$status[$value['status']];?></td>
                    <td class="hidden-xs hidden-sm"><?=date('Y-m-d H:i', $value['create_at']);?></td>
                    <td><?=date('Y-m-d H:i', $value['update_at']);?></td>
                    <td class="hidden-xs hidden-sm"><?=$value['limit'] . '天';?></td>
                    <td>
                        <a href="<?=  site_url('/info/info_edit/' . $value['id']);?>" class="btn btn-primary btn-xs" type="button">编辑</a>
                        &nbsp;<button type="button" class="btn btn-success btn-xs update-btn">更新时间</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-xs del-btn">删除</button>
                    </td>
                </tr>
                <?php endforeach;?>
            <?php else:?>
            <?php endif;?>
        </tbody>
      </table>
    </div>
    <div class="panel-footer">
        <div class="dataTables_pagination">
            <div class="dataTables_info">
            </div>
            <ul id="Pagination" class="pagination">
            </ul>
        </div>
    </div>
</div>

<script>
    var page = <?=json_encode($page);?>;
</script>


<script id="tmpAttr" type="text/html">
    {{each infoNew as value i}}
        <tr>
        <td><label class="checkbox-inline">&nbsp;<input type="checkbox" value="{{value.id}}">{{i+1+(page.now-1)*page.size}}</label></td>
        <td><a href="<?=site_url('info/details/{{value.id}}');?>">{{value.title}}</a></td>
        <td class="hidden-xs hidden-sm">{{value.name}}</td>
        <td class="hidden-xs hidden-sm">{{value.phone}}</td>
        <td>{{status[value.status]}}</td>
        <td class="hidden-xs hidden-sm">{{value.create_at}}</td>
        <td>{{value.update_at}}</td>
        <td class="hidden-xs hidden-sm">{{value.limit}}</td>
        <td>
            <button type="button" class="btn btn-primary btn-xs show_edit-btn">编辑</button>
            &nbsp;<button type="button" class="btn btn-success btn-xs update-btn">更新时间</button>
            &nbsp;<button type="button" class="btn btn-danger btn-xs del-btn">删除</button>
        </td>
    </tr>
    {{/each}}
</script>

<script src="<?=ASSETS;?>jquery/jquery.pagination.js"></script>
<script src="<?=ASSETS;?>artTemplate/template.js"></script>

<script src="<?=HOME_ASSERTS;?>js/common.js"></script>
<script src="<?=HOME_ASSERTS;?>js/mng.js"></script>