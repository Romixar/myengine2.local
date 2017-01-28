<?php
top('Покупка услуг');


?>


<h1>Услуги</h1>




<table>
    <tr>
        <td>
            <input type="hidden" value="1" id="service_1" />
            <button onclick="post_query('buy','services','service_1')">Купить</button>
        </td>
        <td>Услуга 1</td>
        <td><?= servicesPrice('1') ?> руб.</td>
    </tr>
    <tr>
        <td>
            <input type="hidden" value="2" id="service_2" />
            <button onclick="post_query('buy','services','service_2')">Купить</button>
        </td>
        <td>Услуга 2</td>
        <td><?= servicesPrice('2') ?> руб.</td>
    </tr>
    <tr>
        <td>
            <input type="hidden" value="3" id="service_3" />
            <button onclick="post_query('buy','services','service_3')">Купить</button>
        </td>
        <td>Услуга 3</td>
        <td><?= servicesPrice('3') ?> руб.</td>
    </tr>
</table>





<?php

bottom();
?>