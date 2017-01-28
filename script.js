

//  ОТПРАВКА формы с помощью AJAX http://www.net-f.ru/item/php/94.html

function post_query(url, name, data){
    
    //alert('проверка!');
    var str = '';
    
    $.each(data.split('.'), function(key, val){// для каждого элемента data
        
        str += '&' + val + '=' + $('#'+val).val();// лепим строку из данных формы
        
    });
    
    //console.log(str);
    
    $.ajax({// отправляем её
            
            url: '/' + url,
            type: 'POST',
            data: name + '_f=' + str,
            cache: false,
            success: function(res){
                
                //alert(res);
                if(res)console.log(res);
                var obj = jQuery.parseJSON(res);
                //if(obj.go) location.href = '/' + obj.go;// редирект (мой вариант редиректа)
                if(obj.go) go(obj.go);// редирект
                else alert(obj.message);
                
                if(obj) console.log(obj);
                   
            }  
        })
}

function go(url){
    window.location.href='/'+url;
}
