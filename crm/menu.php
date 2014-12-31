<?php include_once('menu_items.php'); ?>

<!-- React integration -->

<script src="../js/react/react.js"></script>
<script src="../js/react/JSXTransformer.js"></script>
<script type="text/jsx" src="../js/orderHandling.jsx"></script>


  <div class="span10">
    <div class="main-content">
      <div class="menu-block">		
      		<div id="tooltip">

          		<a onclick="this.parentNode.style.display = 'none';">x</a>
          		<div id="tooltipText"></div>
          	</div>
          <h3>Оформление заказа</h3>
          <div id="menu-react-mount"></div>

         </div>
       </div>
       </div>