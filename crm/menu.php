<?php include_once('menu_items.php'); ?>
<?php include_once('../js/ordering.js'); ?>

<!-- React integration -->

<script src="../js/react/react.js"></script>
<script src="../js/react/JSXTransformer.js"></script>
<script type="text/jsx" src="../js/orderHandling.jsx"></script>


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
          <div id="menu"></div>
         </div>
       </div>
       </div>