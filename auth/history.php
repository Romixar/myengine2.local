<?php

top('История');
$_SESSION['offset'] = 0;
?>

<b>Раздел история</b>

<script type="text/javascript">
    
    function loadHistory(){
        
        $.get('/loader',function(data){
            
            if(data != 'end') $('#space').append(data);            
            if(data == 'empty') $('#space').text('Список пуст...');
            

        });
        
        
    }

    $(document).ready(function(){
        loadHistory();
    })
</script>
<br/>
<button onclick="loadHistory()">Загрузить ещё</button>

<div id="space"></div>

<?php
bottom();
?>