<?php include_once('menu_items.php'); ?>
<?php include_once('../js/ordering.js'); ?>
  <div class="span10">
    <div class="main-content">

      <div class="menu-block">

        <div class="client-in-menu-block">
        <h4>Клиент</h4>

        <form name='myForm' onsubmit="return false;">
         Номер карты: 
         <input type='text' maxlength="4" id='cardnum' onchange="retrieveCardData();" /> <br />
        </form>

        <div id='ajax-in-client-menu'></div>
        </div>

        <div class="menu-items">
          <h4>Меню</h4>
             <ul>
              <?php
                foreach ($menu as $key => $item) {
                  $item->show();
                }
              ?>
             </ul>
             <div class="clear"></div>
         </div>

          <div class="menu-result">
             <h4>Заказ</h4> 

              <ul>
                <li>
                  <span>Латте</span> <strong>3</strong>
                <br>
                270мл
                <i>80.50 руб</i>

              </li>
                <li>12</li>
                <li>12</li>
              </ul>
            
              <div class="clear"></div>
              <br>

              <strong>Сумма заказа: 800 руб</strong>
<br><br>
              <input type="button" value="Удалить все к ебеням">
             <div id="shoplist"></div> 


           </div>

         </div>
       </div>
       </div>