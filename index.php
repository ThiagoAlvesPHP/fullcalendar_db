<?php 
require 'classe.php'; 
$c = new Classe();

if (!empty($_POST)) {
  $c->set($_POST);
  header('Location: index.php');
}

?>

<html lang='pt-br'>
  <head>
    <meta charset='utf-8' />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <link href='lib/main.css' rel='stylesheet' />
    <script src='lib/main.js'></script>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');

          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
          });

          calendar.render();

          calendar.batchRendering(function() {
            calendar.changeView('dayGridMonth');
            $(document).ready(function(){
              $.ajax({
                url: 'ajax.php',
                dataType:'json',
                success:function(data){

                    for(line in data){
                        user = data[line]; 
                        calendar.addEvent({ title: user.evento, start: user.data });
                    }
                }
              });
            });
          });
      });
      
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <form method="POST">
            <label>Evento</label>
            <input type="text" name="evento" class="form-control" required="">
            <label>Data</label>
            <input type="date" name="data" class="form-control" required="">
            <br>
            <button class="btn btn-success">Adicionar Evento</button>
          </form>
        </div>
        <div class="col-sm-8">
          <div id='calendar'></div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  </body>
</html>