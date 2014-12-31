 <?php include_once('client_clients.php'); ?>
 <div class="span10">
   <div class="main-content">
    <div class="table-client">
    <a href="newclient.php">Захуячить нового</a> <br/>
    Топ: <a href="?page=2&amp;show=10">10</a> <a href="?page=2&amp;show=25">25</a> <a href="?page=2&amp;show=50">50</a> <a href="?page=2&amp;show=100">100</a> <a href="?page=2&amp;show=1000">1000</a>
           <table>
             <thead>
               <td>Номер карты</td>
               <td>ФИО</td>
               <td>Телефон</td>
               <td>Бонусы</td>
               <td>Покупок</td>
             </thead>
             <tbody>
              <?php 
                foreach ($clients as $client) {
                  $client->show();
                }
              ?>
             </tbody>
           </table>
   </div>
 </div>