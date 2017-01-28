<?php
top('Покупка услуг');

if(isset($_SESSION['disc'])) $disc = 1 - ($_SESSION['disc'] / 100);
else $disc = 1;
?>


<h1>Услуги</h1>




<table>
    <tr>
        <td>
            <input type="hidden" value="1" id="service_1" />
            <button onclick="post_query('buy','services','service_1')">Купить</button>
        </td>
        <td>Услуга 1</td>
        <td><?= servicesPrice('1') * $disc ?> руб.</td>
    </tr>
    <tr>
        <td>
            <input type="hidden" value="2" id="service_2" />
            <button onclick="post_query('buy','services','service_2')">Купить</button>
        </td>
        <td>Услуга 2</td>
        <td><?= servicesPrice('2') * $disc ?> руб.</td>
    </tr>
    <tr>
        <td>
            <input type="hidden" value="3" id="service_3" />
            <button onclick="post_query('buy','services','service_3')">Купить</button>
        </td>
        <td>Услуга 3</td>
        <td><?= servicesPrice('3') * $disc ?> руб.</td>
    </tr>
</table>
<br>
<br>
<h3>Получить скидку</h3>

<p><input type="text" id="code" placeholder="Ваш промокод"></p>
<p><button onclick="post_query('buy','promo','code')">Получить</button></p>





<?php

bottom();
?>