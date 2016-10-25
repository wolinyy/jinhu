<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--<link href="<?=ASSETS;?>Jcrop/css/jquery.Jcrop.min.css" rel="stylesheet">-->
<link href="<?=ASSETS;?>cropper/cropper.min.css" rel="stylesheet">

<style>
    .btnDelDiv {
        margin-top: -15px;
        padding-bottom: 10px;
    }
</style>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">编辑</span>
          <?php if(!isset($update_flag)):?>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
          <?php endif;?>
      </h3>
    </div>

    <form class="form-horizontal" id='form' data-url='/info/mng.html'>
        <div class="panel-body" data-url='/info/submit'>
            <input type="hidden" name='id' id="id" value="<?=isset($form['id'])?$form['id']:"";?>" data-first="<?=isset($form['id'])?1:0;?>">
            <input id="zoom" name="zoom" value="<?=isset($form['zoom'])?$form['zoom']:"";?>" type="hidden">
            <div class="form-group region require sr-only"> 
                <label class="col-sm-3 control-label">分类名称</label>
                <div class="col-sm-3 ">
                    <select id="type_one_id" name="type_one_id" class="select-base form-control" required
                            data-val ="<?=isset($form['type_one_id'])?$form['type_one_id']:"";?>"
                            data-url="/admin/info_type/getT1Name" data-def_text='一级分类'>
                        <option value="">一级分类</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select id="type_two_id" name="type_two_id" class="select-base form-control" required
                            data-val ="<?=isset($form['type_two_id'])?$form['type_two_id']:"";?>"
                            data-def_text='二级分类'>
                        <option value="">二级分类</option>
                    </select>
                </div>
            </div>
            <div class="form-group region require"> 
                <label class="col-sm-3 control-label">所属地区</label>
                <div class="col-sm-3 ">
                    <select id="addr_one_id" name="addr_one_id" class="select-base form-control" required
                            data-val ="<?=isset($form['addr_one_id'])?$form['addr_one_id']:"";?>"
                            data-url="/admin/region/getT1Name" data-def_text='镇'>
                        <option value="">镇</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select id="addr_two_id" name="addr_two_id" class="select-base form-control" 
                            data-val ="<?=isset($form['addr_two_id'])?$form['addr_two_id']:"";?>"
                            data-def_text='乡村'>
                        <option value="">乡村</option>
                    </select>
                </div>
            </div>
            <div class="form-group require">
                <label for="type" class="col-sm-3 control-label">有效期</label>
                <div class="col-sm-6">
                    <select class="form-control select-base" id="limit" name="limit"
                            data-val ="<?=isset($form['limit'])?$form['limit']:"";?>">
                        <option value="7">一周</option>
                        <option value="14">两周</option>
                        <option value="30">一个月</option>
                        <option value="90">三个月</option>
                    </select>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="name" class="col-sm-3 control-label">标题</label>
                <div class="col-sm-6">
                    <input class="form-control" name="title" id="title" value="<?=isset($form['title'])?$form['title']:"";?>" placeholder="标题" required>
                </div>
            </div>
            <div id="attr">
                <?php if(isset($form['attrs'])) foreach ($form['attrs'] as $key => $value):?>
                <?php
                    $tmpArr = explode("\n", $value['value']);
                    $len = count($tmpArr);
                ?>
                
                <div class="form-group require"> 
                    
                    <label for="name" class="col-xs-12 col-sm-3 control-label"><?=$value['name'];?></label>
                        <?php if(in_array($value['type'], [1,5])):?>
                        <div class="col-xs-8 col-sm-4">
                        <input class="form-control" name="attrs|<?=$value['attr_id'];?>|<?=$value['type'];?>" id="attrs|<?=$value['attr_id'];?>|<?=$value['type'];?>" value="<?=$value['type']==1?$value['attr_value_text']:$value['attr_value_float'];?>" placeholder="<?=$value['name'];?>" required>
                        </div>
                        <div class="col-xs-4  col-sm-2">
                            <p class="form-control-static"><?=$value['value'];?></p>
                        <!--</div>-->
                        <?php elseif ($value['type']==2 && $len==2):?>
                            <div class="col-sm-6">
                            <?php foreach ($tmpArr as $k => $v):?>
                            <?php
                                $Arr = explode(":", $v);
                            ?>
                            <label class="radio-inline">
                                <input name="attrs|<?=$value['attr_id'];?>|<?=$value['type'];?>" <?=($k==0?'id=\'attrs|'.$value['attr_id'].'|'.$value['type'].'\'':'');?> 
                                       type="radio" value="<?=$Arr[0];?>" <?=($value['attr_value_text']==$Arr[0]?'checked':'')?> > <?=$Arr[1];?>
                              </label>
                            <?php endforeach;?>
                        <?php elseif ($value['type']==2 && $len!=2):?>
                            <div class="col-sm-6">
                            <select class="form-control select-base" name="attrs|<?=$value['attr_id'];?>|<?=$value['type'];?>" 
                                    id="attrs|<?=$value['attr_id'];?>|<?=$value['type'];?>" data-val ="<?=$value['attr_value_text'];?>">
                                <?php foreach ($tmpArr as $k => $v):?>
                                <?php
                                    $Arr = explode(":", $v);
                                ?>
                                <option value="<?=$Arr[0];?>" <?=($Arr[0]==$value['attr_value_text']?'selected':'');?> ><?=$Arr[1];?></option>
                                <?php endforeach;?>
                            </select>
                        <?php elseif ($value['type']==3):?>
                            <div class="col-sm-6">
                            <?php foreach ($tmpArr as $k => $v):?>
                                <?php
                                    $Arr = explode(":", $v);
                                    $tmpArr = explode(",", $value['attr_value_text']);
                                ?>
                              <label class="checkbox-inline">
                                <input name="attrs|<?=$value['attr_id'];?>|<?=$value['type'];?>" <?=($k==0?'id=\'attrs|'.$value['attr_id'].'|'.$value['type'].'\'':'');?> 
                                       type="checkbox" value="<?=$Arr[0];?>" <?=(in_array($Arr[0], $tmpArr)?'checked':'')?> > <?=$Arr[1];?>
                              </label>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                                
                </div>
                                
                <?php endforeach;?>
            </div>
            <div class="form-group require"> 
                <label for="content" class="col-sm-3 control-label">内容详情</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="content" name="content" rows="11" placeholder="内容详情" value="" required maxlength="384"><?=isset($form['content'])?$form['content']:"";?></textarea>
                </div>
            </div>
            <div class="form-group"> 
                <label for="content" class="col-sm-3 control-label">添加图片</label>
                <div class="col-sm-6" id="imgAdd">
                    <div id="imgDrag">
                        <?php if(isset($form['imgs'])) foreach ($form['imgs'] as $key => $value):?>
                        <div class="col-xs-6 col-sm-12 col-md-6 col-lg-4">
                            <a href="javascript:;" class="thumbnail">
                                <img src="<?=IMG_URL . $value['path'];?>" class="img-thumbnail" data-id="<?=$value['id'];?>">
                            </a>
                            <div class="text-center btnDelDiv">
                                <button type="button" class="btn btn-default delImg">删除</button>
                                <!--&nbsp;&nbsp;<button type="button" class="btn btn-default dragImg">拖放</button>-->
                                &nbsp;&nbsp;<button type="button" class="btn btn-default updateImg">更新</button>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php if(!isset($form['imgs']) || count($form['imgs'])<6):?>
                        <div class="col-xs-6 col-sm-12 col-md-6 col-lg-4">
                            <a href="javascript:;" class="thumbnail">
                              <img src="/assets/img/add.fw.png" class="img-thumbnail">
                            </a>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-4 hide" id="imgAddBox">
                        <a href="javascript:;" class="btn btn-default" role="button" id="btnImgAdd">
                            添加图片
                            <input class="file" id="fileUpload" name="file" value="上传图片" accept="image/jpg,image/jpeg,image/png" type="file">
                        </a>&nbsp;&nbsp;
                        <img id="loading" src="<?=ASSETS;?>img/loadingimg.gif" style="display:none;"/>
                        <button type="button" class="btn btn-default" id="testShow">图片裁剪</button>
                    </div>
                </div>
            </div>
            <div id="lx_way">
                <div class="form-group require"> 
                    <label for="name" class="col-sm-3 control-label">联系人</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="name" id="name" value="<?=isset($form['name'])?$form['name']:"";?>" placeholder="联系人" required>
                    </div>
                </div>
                <div class="form-group require"> 
                    <label for="phone" class="col-sm-3 control-label">联系电话</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="phone" id="phone" value="<?=isset($form['phone'])?$form['phone']:"";?>" placeholder="联系电话" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">详细地址</label>
                    <div class="col-sm-6">
                        <input name="addr_detail" id="addr_detail" value="<?=isset($form['addr_detail'])?$form['addr_detail']:"";?>" class="form-control" placeholder="详细地址" type="text">
                    </div>
                </div>
                <div class="form-group"> 
                    <label for="qq" class="col-sm-3 control-label">联系QQ</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="qq" id="qq" value="<?=isset($form['qq'])?$form['qq']:"";?>" placeholder="联系QQ">
                    </div>
                </div>
                <div class="form-group"> 
                    <label for="email" class="col-sm-3 control-label">电子邮箱</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="email" name="email" id="email" value="<?=isset($form['email'])?$form['email']:"";?>" placeholder="电子邮箱">
                    </div>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="passwd" class="col-sm-3 control-label"> 管理密码</label>
                <div class="col-sm-6">
                    <input class="form-control" name="passwd" id="passwd" value="<?=isset($form['passwd'])?$form['passwd']:"";?>" placeholder=" 管理密码" required>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="vCode" class="col-xs-12 col-sm-3 control-label"> 验证码</label>
                <div class="col-xs-6 col-sm-3">
                    <input class="form-control" name="vCode" id="vCode" placeholder=" 验证码" required>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <img id="code" onclick="document.getElementById('code').src='<?=site_url('info/edit_verify_code?tm=');?>'+Math.random()" src="<?=site_url('info/edit_verify_code');?>" class="img-responsive img-rounded">
                </div>
            </div>
            <div class="form-group"> 
                <label for="" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <div class="alert alert-hint sr-only">
                        <strong></strong> <span></span>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="panel-footer row">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
</div>

<!--模态框-->
<div id="JcropModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">图片裁剪</h4>
      </div>
      <div class="modal-body form-horizontal text-center">
           <div id="imgCropDiv">
                <img src="" id="target" class="img-thumbnail">
            </div>
            <div id="coords" class="coords sr-only">
                <div class="inline-labels">
                    <label>X <input type="text" size="4" id="x" name="x" readonly /></label>
                    <label>Y <input type="text" size="4" id="y" name="y" readonly /></label>
                    <label>W <input type="text" size="4" id="w" name="w" readonly /></label>
                    <label>H <input type="text" size="4" id="h" name="h" readonly /></label>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="btnCropSure">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
<!--<script type="text/javascript" src="<?=BAIDU_MAP_JS;?>"></script>-->
<script id="test" type="text/html">
    <h1>{{title}}</h1>
    <ul>
        {{each list as value i}}
            <li>索引 {{i + 1}} ：{{value}}</li>
        {{/each}}
    </ul>
</script>

<script id="jsImgAdd" type="text/html">
    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-4">
        <a href="javascript:;" class="thumbnail">
          <img src="{{msg}}" class="img-thumbnail" data-id='{{id}}'>
        </a>
        <div class="text-center btnDelDiv">
            <button type="button" class="btn btn-default delImg">删除</button>
            <!--&nbsp;&nbsp;<button type="button" class="btn btn-default dragImg">拖放</button>-->
            &nbsp;&nbsp;<button type="button" class="btn btn-default updateImg">更新</button>
        </div>
    </div>
</script>

<script id="tmpAttr" type="text/html">
    {{each list as value i}}
    <div class="form-group require"> 
        <label for="name" class="col-xs-12 col-sm-3 control-label">{{value.name}}-{{value.type}}</label>
        
            {{if value.type == 1 || value.type == 5}}
            <div class="col-xs-8 col-sm-4">
            <input class="form-control" name="attrs|{{value.id}}|{{value.type}}" id="attrs|{{value.id}}|{{value.type}}" value="" placeholder="{{value.name}}" required>
            </div>
            <div class="col-xs-4  col-sm-2">
                <p class="form-control-static">{{value.value}}</p>
            <!--</div>-->
            {{else if value.type == 2 && value.len == 2}}
                <div class="col-sm-6">
                {{each value.obj as obj j}}
                {{if j == 0 }}
                <label class="radio-inline">
                    <input name="attrs|{{value.id}}|{{value.type}}" id="attrs|{{value.id}}|{{value.type}}" type="radio" value="{{obj.key}}"> {{obj.value}}
                  </label>
                {{else}}
                <label class="radio-inline">
                    <input name="attrs|{{value.id}}|{{value.type}}" type="radio" value="{{obj.key}}"> {{obj.value}}
                  </label>
                {{/if}}
                {{/each}}
            {{else if value.type == 2 && value.len != 2}}
                <div class="col-sm-6">
                <select class="form-control select-base" name="attrs|{{value.id}}|{{value.type}}" id="attrs|{{value.id}}|{{value.type}}">
                    {{each value.obj as obj j}}
                    <option value="{{obj.key}}">{{obj.value}}</option>
                    {{/each}}
                </select>
            {{else if value.type == 3}}
                <div class="col-sm-6">
                {{each value.obj as obj j}}
                  {{if j == 0 }}
                  <label class="checkbox-inline">
                    <input name="attrs|{{value.id}}|{{value.type}}" id="attrs|{{value.id}}|{{value.type}}" type="checkbox" value="{{obj.key}}"> {{obj.value}}
                  </label>
                  {{else}}
                  <label class="checkbox-inline">
                    <input name="attrs|{{value.id}}|{{value.type}}" type="checkbox" value="{{obj.key}}"> {{obj.value}}
                  </label>
                  {{/if}}
                {{/each}}
            {{/if}}
        </div>
    </div>
    {{/each}}
</script>

<script>
    var type = <?=json_encode($form['infoType']);?>;
    var region = <?=json_encode($form['infoRegion']);?>;
</script>
<script src="<?=ASSETS;?>cropper/cropper.min.js"></script>
<script src="<?=ASSETS;?>js/ajaxfileupload.js"></script>
<script src="<?=ASSETS;?>artTemplate/template.js"></script>

<script src="<?=ASSETS;?>jquery/validation/jquery.validate.min.js"></script>
<script src="<?=ASSETS;?>jquery/validation/localization/messages_zh.js"></script>
    
<script src="<?=HOME_ASSERTS;?>js/common.js"></script>
<script src="<?=HOME_ASSERTS;?>js/info_edit.js"></script>
