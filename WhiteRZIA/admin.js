function WhiterzPopup ( url , height ) {
    newwindow=window.open(url,"WhiterzPopupWindow","height="+height+",width=500");
    if (window.focus) {newwindow.focus()}
    return false;
}

jQuery(document).ready(function($){
    $.whiterz={};
    if($('.twp_box').length!=0){
        $.whiterz.modal_box = $('.twp_box');
        $.whiterz.default_html = $('.twp_box').html()
    }
    $('.single_account_status').live('click',function(){
        whiterz_show();
        var $data_id=$(this).attr('data-id');
        var $data_value=$(this).attr('data-value');
        var $target_obj=$(this).parent().parent().find('.span1').find('h2');
        var $whiterzAjaxUri=$('[name=WhiterzAjaxUrl]').val();
        var $this=$(this);
        jQuery.ajax({
            url:$whiterzAjaxUri,
            type:'GET',
            data:'action=WhiterzChangeStatus&accountID='+$data_id+'&Status='+$data_value,
            dataType:'json',
            success: function(WhiterzJson){
    
                if(WhiterzJson.status=='Success'){
                    if($data_value==1){
                        $target_obj.removeClass('icon-remove');
                        $target_obj.addClass('icon-ok');

                        $this.attr('data-value','0');
                        $this.text('Deactive');
                    }
                    if($data_value==0){
                        $target_obj.removeClass('icon-ok');
                        $target_obj.addClass('icon-remove');
                        $this.attr('data-value','1');
                        $this.text('Active');
                    }
                    whiterz_hide();
                }
            }
        });
        
        return false;
    })
    
    $('.whiterz_ajax_button').live('click',function(){
        whiterz_show();
        var $data_id=$(this).attr('data-id');
        var $data_action=$(this).attr('data-action');
        var $target_obj=$(this).parent().parent().parent().parent();
        var $whiterzAjaxUri=$('[name=WhiterzAjaxUrl]').val();
        var $this=$(this);
        jQuery.ajax({
            url:$whiterzAjaxUri,
            type:'GET',
            data:'action='+$data_action+'&accountID='+$data_id,
            dataType:'json',
            success: function(WhiterzJson){
                whiterz_complate();
                if(WhiterzJson.status=='Success'){
                    if($data_action=='WhiterzDeleteAccount'){
                        whiterz_hide();
                    $target_obj.fadeOut(500,function(){$target_obj.remove(); });
                }               
            }
                if(WhiterzJson.message){
                    whiterz_set(WhiterzJson.message)
                }
            },
            error:function(xhr, ajaxOptions, thrownError){
                whiterz_hide();
                whiterz_set('An unknown error has occurred.');
            }
        });
        
        return false;
    })
    function whiterz_show(){
        $('.whiterz_loader').show();
        $('.whiterz_loader').find('.load_image').show();
        $('.whiterz_loader').find('.loader_text_msg').html('Please Wait.');
    }
    function whiterz_hide(){
        $('.whiterz_loader').hide();
    }
    function whiterz_complate(){
        $('.whiterz_loader').find('.load_image').hide();
    }
    function whiterz_set(text){
        $('.whiterz_loader').find('.loader_text_msg').html(text);
    }
    
    $('.slct_all').click(function(){
        var current_div = $(this).parent().parent().parent().parent(); 
        
        $selected=current_div.find('input[type=checkbox]:checked').length;
        $total_cb=current_div.find('input[type=checkbox]').length
        if($selected==$total_cb){
            current_div.find('input[type=checkbox]').attr('checked',false);
            $(this).text('( All Select )');
        }else{
           current_div.find('input[type=checkbox]').attr('checked',true);
           $(this).text('( All Unselect )');
        }
        
    })
    
    
    
    $('#WhiterzPingManuel').click(function(){ 
        
        if($('.account_chbx:checked').length==0){
            return false;
        }
        
        $.whiterz.modal_box.html($.whiterz.default_html);
        $(".manuel_post_status" ).show();
        var modal_box=$('.twp_box');
        var default_html = modal_box.html();
        var $whiterzAjaxUri=$('[name=WhiterzAjaxUrl]').val();
        modal_box.find('h2').text('Retrieving account information.');
        var total_account=$('#ACCOUNT_COUNT');
        var sending_account = $('#POSTED_ACCOUNT');
        var pending_account = $('#PENDING_ACCOUNT');
        var error_account = $('#ERROR_ACCOUNT');
        var complate = $('#complate');
        var percent = $('#percent');
        var close = $('#twp_close');
        var title = $('.twp_box').find('h2');       
        var $_form_variables= $('#manuel_post').serialize();
        close.show();
        $total=$('.account_chbx:checked').length;
        pending_account.text($total);
        total_account.text($total);
        $('.account_chbx:checked').each(function(){
            var Account=$(this).val();
            jQuery.ajax({
            url:$whiterzAjaxUri,
            type:'GET',
            data:'action=WhiterzGetAccount&accountNAME='+Account,
            dataType:'json',
            success: function(WhiterzJson){
                
                title.html('Started !');
                jQuery.each(WhiterzJson,function($key,$val){
                    $('.updateds').html($val.social_address+' sending..');
                    var AccountID=$val.account_id;
                    jQuery.ajax({
                        url:$whiterzAjaxUri+'?action=WhiterzPing&AccountID='+AccountID,
                        type:'POST',
                        data:$_form_variables,
                        dataType:'json',
                        async:true,
                        success:function(PostJSON){
                            
                            $('.updateds').html($val.social_address+' complated..');
                            $content='<div class="ping_item">';
                            if(PostJSON.status=='success'){
                                $content+='<i class="icon icon-ok"></i> ';
                                sended=sending_account.html(parseInt( sending_account.html())+1);
                            }else{
                                $content+='<i class="icon icon-remove"></i> ';
                                errored=error_account.html(parseInt( error_account.html())+1);
                            }
                            $content+='<span><a href="'+PostJSON.url+'">'+PostJSON.url+'</a></span> ';
                            $content+='</div>';
                            $('.statues').prepend($content);
                            errored=parseInt( error_account.html());
                            sended=parseInt( sending_account.html());
                            
                            pending_account.html(parseInt(pending_account.text())-1);
                            var complated=Math.floor(((sended+errored)*100)/parseInt(total_account.html()));
                            complate.text( complated )
                            percent.css({'width':complated+'%'});
                            if(parseInt(pending_account.html())==0){
                                 title.html('Bookmarking Completed'); 
                                $('.animator').html('<i class="icon icon-ok"></i>'); 
                                
                            }
                        },
                        error:function(xhr, ajaxOptions, thrownError){
                           errored=error_account.html(parseInt( error_account.html())+1);
                           errored=parseInt( error_account.html());
                           sended=parseInt( sending_account.html());
                           if(parseInt(pending_account.html())==0){
                                    title.html('Bookmarking Completed'); 
                                   $('.animator').html('<i class="icon icon-ok"></i>'); 
                                
                            }
                        }
                    });
                    
                });
            },
            error:function(xhr, ajaxOptions, thrownError){
                
            },
            
        });
        });
          
    });
    $('#twp_close').live('click',function(){
        jQuery.ajaxStop();
        
    });
    
    if($('input[name=WhiterzRedirect]').length!=0){
        var total_account = $('.WhiterzAutoPoster').length;
        
        var sended=$('#ping_success');
        var failed=$('#ping_failed');
        var pending=$('#ping_pending');
        var return_url=$('[name=WhiterzRedirect]').val();
        var post_id=$('[name=WhiterzPostID]').val();
        pending.html(total_account);
        
        $('.WhiterzAutoPoster').each(function(){
            var random = Math.round(Math.random()*$(".dyn_p_title").length-1);
            var cur_title=$(".dyn_p_title").eq(random).html();
            var random = Math.round(Math.random()*$(".dyn_p_content").length-1);
            var cur_cont=$(".dyn_p_content").eq(random).html();
            $('input[name=title]').val(cur_title);
            $('textarea[name=content]').val(cur_cont);
            
            var $_form_variables= $('#manuel_post').serialize();
            var current_div=$(this);
            var $whiterzAjaxUri=$('[name=WhiterzAjaxUrl]').val();
            var AccountID= $(this).attr('data-id');
            var current_acct=current_div.find('input').val();
            
            jQuery.ajax({
                url:$whiterzAjaxUri+'?action=WhiterzPing&PostID='+post_id+'&AccountID='+AccountID,
                type:'POST',
                data:$_form_variables,
                dataType:'json',
                async:true,
                 beforeSend: function(){
                 current_div.find('.status_post').find('span').remove();
                 current_div.find('.status_post').append('<span class="label label-info">Sending..</span>');
                 $('#current_status').html('Sending : '+current_acct);
                },
                success:function(PostJSON){
                    if(PostJSON.status=='success'){
                        sends=parseInt(sended.html())+1;
                        current_div.find('.status_post').find('span').remove();
                        current_div.find('.status_post').append('<span class="label label-success">Sent</span>');
                        sended.html(sends);
                    }else{
                        fails=parseInt(failed.html())+1;
                        failed.html(fails);
                        current_div.find('.status_post').find('span').remove();
                        current_div.find('.status_post').append('<span class="label label-danger">Error</span>');
                    }
                    
                },
                error:function(xhr, ajaxOptions, thrownError){
                   fails=parseInt(failed.html())+1;
                   failed.html(fails);
                   current_div.find('.status_post').find('span').remove();
                    current_div.find('.status_post').append('<span class="label label-danger">Error</span>');
                },
                 complete :function(){
                    pending.html( parseInt(pending.html())-1 )
                    $('#current_status').html('Sending : '+current_acct);
                    if(pending.html()=='0'){
                         jQuery.ajax({ url:$whiterzAjaxUri, data:'action=WhiterzSetAccountPinged&PostID='+post_id});
                        $('#current_status').html('Bookmarking Completed<br /><span id="countd"></span> \n\
<a href="'+$('input[name=WhiterzRedirect]').val()+'" class="text_color_1">click</a> here! ');
                            countdown();
                    }
                }
            });
        })
    }
    
    function countdown() {
       
        if ( typeof countdown.counter == 'undefined' ) {
            countdown.counter = 5; 
            }
        if(countdown.counter > 0) {
                document.getElementById('countd').innerHTML = countdown.counter--;
            setTimeout(countdown, 1000);
        }
        if(countdown.counter == 0){
            location.href = $('input[name=WhiterzRedirect]').val();
        }
    }
     $('.stop_timer').live('click',function(){
         if ( typeof countdown.counter == 'undefined' ) {
            countdown.counter = -1; 
            }else{
               countdown.counter =-1;   
            }
    })
    
    



});
function alertactive()
{
alert("Account Activated");

}
function alertdeactive()
{
alert("Account Deactivated");
}
function alertdelete()
{
alert("Deleted");
}