<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">

</head>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link href="../css/starrr.css" rel=stylesheet />
<script src="../js/starrr.js"></script>


<body>
  <div class="container-fluid">
    <br />
    <div class="col-md-2"></div>
    <div class="col-md-2">
      <img class="thumbnail" src="img/el-bebe-jefazo.jpg" />
    </div>
    <div class="col-md-6" style="margin-left: 17px;">
      <h2>El bebé jefazo (2017)</h2>
      <span class="original"><strong>Título original:</strong> The Boss Baby</span>
      <br />
      Géneros: Animación, Comedia<br />

     
    
      Calificar: <span id="Estrellas"></span>
      
      Calificar: <span id="Estrellas2"></span>

        <h4> SINOPSIS</h4>
        Tim es un niño de 7 años que tiene los mejores padres del mundo. Su vida es perfecta hasta que un fatídico día todo cambia de forma radical. ¿El motivo? Ya no serán solo tres en la familia, porque ha llegado su nuevo hermanito, un adorable bebé, que hace que a sus padres se les caiga la baba.<br /><br />
        <iframe width="640" height="360" src="https://www.youtube.com/embed/2zI1OJzYSC8" frameborder="0" allowfullscreen></iframe>
      </p>
    </div>

    <div class="col-md-2"></div>

  </div>
  <script>
    $('#Estrellas').starrr({
      rating: 4,
      readOnly: true,
      change: function(e, valor) {
       // alert(valor);

      }

    });
    $('#Estrellas2').starrr({
      rating: 1,
      readOnly: true,
      change: function(e, valor) {
       // alert(valor);

      }

    });
  </script>
</body>

</html>