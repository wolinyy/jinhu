/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#infoTypeBox').on('click', '.glyphicon', function(e){
    
    var isShow = false;
    var head = $(this).parents('.panel-heading');
    
    if(head.next().is(':visible')){
        isShow = true;
    }
    head.parent().parent().siblings().find('.panel-body').hide();
    head.parent().parent().siblings().find('.panel-heading i').removeClass('open');
    if(isShow){
        head.next().fadeOut();
        $(this).removeClass('open');
    }else{
        head.next().fadeIn();
        $(this).addClass('open');
    }
    
    return false;
})

$('#infoTypeBox').on('click', '.panel-heading', function(){
    window.location.href = '/info/category/'+$(this).data('id')+'.html';
})

$().ready(function(){
    $(".scrollLoading").scrollLoading();
});
