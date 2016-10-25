<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="alert <?=($code==0?'alert-success':'alert-danger');?>" role="alert">
    <h4><strong><?=$title;?></strong></h4>
    <p><?=$content;?></p>
    <p><a href="<?=site_url('/');?>" class="alert-link">返回首页</a>.</p>
</div>
