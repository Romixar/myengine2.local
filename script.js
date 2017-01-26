

//  ОТПРАВКА формы с помощью AJAX http://www.net-f.ru/item/php/94.html

function post_query(url, name, data){
    
    //alert('проверка!');
    var str = '';
    
    $.each(data.split('.'), function(key, val){// для каждого элемента data
        
        str += '&' + val + '=' + $('#'+val).val();
        
    });
    
    $.ajax({
            
            url: '/' + url,
            type: 'POST',
            data: name + '_f=' + str,
            cache: false,
            success: function(res){
                
                //alert(res);
                var obj = jQuery.parseJSON(res);
                if(obj.go) location.href = '/' + obj.go;// редирект
                if(obj) console.log(obj);// редирект
                if(obj.message) alert(obj.message);
                
            }

            
        })
    
    //alert(str);
}
