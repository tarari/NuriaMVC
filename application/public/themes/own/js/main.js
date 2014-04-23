/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    if(!$.cookie('accept-cookies')){
        $('.cookie-banner').slideDown('slow');}
    //tabs
    $('.tabs > ul li a').on('click',function(){
        var that=$(this),
            tabs=that.parent().parent().parent(),
            target=$.trim(that.attr('href').substring(1)),
            items=tabs.find('ul li');
            items.removeClass('selected');
            items.find('a[href="#'+target+ '"]').parent().addClass('selected');
            var tabu_s=tabs.find('.tab.'+target);
        tabs.find('.tab.'+target).show();
        tabs.find('.tab:not(".'+target+'")').hide();
    });
    //slider
    var l = window.location;
    base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    $('.bxslider').bxSlider();
    //banner cookies
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "img/calendar.gif",
      buttonImageOnly: true
    });
    //dates
    $('form.ajax').on('submit',function(){
        
         var that=$(this),
            url=that.attr('action'),
            type=that.attr('method'),
            data={};
            that.find('[name]').each(function(index,value){
                var that=$(this),
                    name=that.attr('name'),
                    value=that.val();
                    data[name]=value;
            });
         $.ajax({
             url:url,
             type:type,
             data:data,
             beforeSend: function(){
                 $('#imgload').show();
             },
             success: function(output){
                 console.log(output);
                 console.log(output.redirect);
                 // si no exixsteix usuari agafar de cookie
                 // i si cookie és numèrica es tracta d'usuari anònim
                 if ($.cookie('usuari')!==undefined){
                     //possiblement una desconnexió o bé la primera vegada
                     var str=$.cookie('usuari');
                     if (((str.match(/^[0-9]/))!==null)||(str===null)){
                        $('#rlogin').html('<p>Anònim</p>');
                         
                        }else{
                            $('#rlogin').html('<p>'+str+'</p><a href="'+base_url+'/index/logout">|Desconnectar</a>');
                            output=null;
                        }
                    }
                    else{
                      $('#rlogin').html('<p>Anònim</p>');
                    }
                    // redirigir en funció del login
                    if(output){
                        var obj=eval('('+output+')');
                        var redirect=obj.redirect
                        window.location=redirect;
                    }
                    
             },
             error: function(){
                 
             }
         });
            
        return false;
    });
});
           
           
          