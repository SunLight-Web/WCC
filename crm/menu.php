<?php include_once('menu_items.php'); ?>
<?php include_once('../js/ordering.js'); ?>

       <div class="span10">
         <div class="main-content">
           <div class="menu-block">
                         <h4>Клиент:</h4>

              <form name='myForm' onsubmit="return false;">
              Card: <input type='text' maxlength="4" id='cardnum' onchange="retrieveCardData();" /> <br />

              </form>
              <div id='ajaxDiv'></div>
              <br/>
           <h3>Меню:</h3>
             <ul>
              <?php
                foreach ($menu as $key => $item) {
                  $item->show();
                }
              ?>
             </ul>
            </div>
              <div class="clear"></div>
            <div>
              <h3>Заказ:</h3> 

              <h4>Заказ клиента:</h4>
              <br/>
              <div id="shoplist"></div>  
           </div>
         </div>
       </div>