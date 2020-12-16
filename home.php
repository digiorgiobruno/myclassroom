<?php
include("./php/directorio.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $nombre = $_SESSION['nombre'];
  $sesion = $_SESSION['rol'];
  $userid = $_SESSION['id'];

  if (isset($_POST['back_url'])) {
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    header("Location: " . $_POST['back_url']); /* Redirección del navegador */
  }
}


if (!isset($_SESSION['id'])) {
  header("Location: http://" . $directorio); /* Redirección del navegador */
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyClassroom</title>
  <!-- Custom styles for this template -->
  <link href="css/agency.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/vitalets-bootstrap-datepicker-c7af15b/css/datepicker.css" rel="stylesheet">
  <link href="css/home.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
  <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
  <link href="css/dropdown.css" rel="stylesheet">
  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
  <!--datables estilo bootstrap 4 CSS-->
  <link rel="stylesheet" type="text/css" href="vendor/DataTables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css">
  <!--tema grafico de jqueryui-->
  <link rel="stylesheet" type="text/css" href="vendor/jqueryui/jquery-ui.css">
  <!-- Deshabilitamos cache -->
  <meta http-equiv="expires" content="0">

  <meta http-equiv="Cache-Control" content="no-cache">

  <meta http-equiv="Pragma" CONTENT="no-cache">
  <script type="text/javascript">
    const tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
    document.write(unescape("<script src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript' %3E%3C/script%3E"));
  </script>

  <!-- Strarrrs -->
  <link href="css/starrr.css" rel=stylesheet />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
  <input type="hidden" id="role" name="" value="<?php echo $sesion ?>">
  <div class="navbar navbar-expand-md navbar-dark bg-dark mb-4 fixed-top" role="navigation" style="background: black !important">
    <a class="navbar-brand" href="#"><img src="img/logo.jpg" width="120" alt="logo"></a>
    <button id="btn-toggle" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul id='cat1' class="navbar-nav mr-auto">
        <div class=" ">

          <div class="g1 d-flex flex-row">
            <!--Item Inicio-->
            <li class="nav-item active">
              <a id="inicio" class="nav-link nav-element" href="#">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <!--Item Mis Cursos-->
            <li class="nav-item active">
              <a id="cursos_comprados" class="nav-link nav-element" href="#">Mis cursos</a>
            </li>
            <!--Item Mi perfil-->

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Mi Perfil
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item nav-element" id="datosPersonales">Datos personales</a>
              </div>
            </li>


            <!--Item Administrador-->
            <?php
            if ($_SESSION['rol'] == 0) {

            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Administrador
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item nav-element" id="ventas">Ventas</a>
                  <a class="dropdown-item nav-element" id="adminpanel">Subir cursos</a>
                  <a class="dropdown-item nav-element" id="subirvideo">Subir videos</a>
                  <a class="dropdown-item nav-element" id="asignarcurso">Asignar</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item nav-element" id="modificarcurso">Modificar cursos</a>
                  <a class="dropdown-item nav-element" id="credenciales">Credenciales de pago</a>
                </div>
              </li>
            <?php
            }
            ?>
          </div>
          <div class="g1 d-flex flex-row ">
            <!--Item Dropdown Cursos categoria-->
            <li id='cat2' class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorías</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown1">

                <!--Item categoria-->
                <li class="dropdown-item dropdown">

                  <a class="dropdown-toggle" id="dropdown1-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categoria 2</a>
                  <!--Item subcategoria-->
                  <ul class="dropdown-menu" aria-labelledby="dropdown1-1">
                    <li class="dropdown-item" href="#"><a>Subcategoria</a></li>

                  </ul>

                </li>

              </ul>
            </li>
            <!--Item Salir-->
            <li class="nav-item active">
              <a class="nav-link" href="php/cerrar_sesion.php">Salir</a>
            </li>
          </div>
        </div>
      </ul>


      <span class="navbar-text text-white">
        Contacto:
        <a href="mailto:soporte@myclassroom.com.ar">soporte@myclassroom.com.ar</a>
      </span>
    </div>
  </div>

  <div class="d-flex" id="wrapper">
    <!--INICIO DE CONTENIDO DE PAGINA -->

    <div id="page-content-wrapper" style="background: rgb(250,250,250);">



      <div class="jumbotron p-1" id="jumbotron">
        <div class="container text-right">
          <h1 class="">¡Hola <?php echo $nombre; ?>!
          </h1>
          <?php
          if ($sesion == 0) {
          ?>
            <h3 id="registradosTotales">
            </h3>
          <?php
          }
          ?>
        </div>
      </div>


      <!-- Modal -->

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Comprar Curso</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div id='pago' class="modal-body">



            </div>

            <!-- <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <button type="button" class="btn btn-primary">Save changes</button>

                            </div>-->

          </div>

        </div>

      </div>

      <div class="container-fluid">

        <!-- SKELETON -->

        <div id="carga_cursos" style="display:none;">

          <div class="row">

            <div class="col-xl-4 ">

              <div id="" class="ph-item" style="width: 18rem;">

                <div class="ph-col-12">

                  <div class="ph-picture"></div>

                  <div class="ph-row">

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-12"></div>

                    <div class="ph-col-12 empty"></div>

                    <div class="ph-col-12 big"></div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-xl-4 ">

              <div id="" class="ph-item" style="width: 18rem;">

                <div class="ph-col-12">

                  <div class="ph-picture"></div>

                  <div class="ph-row">

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-12"></div>

                    <div class="ph-col-12 empty"></div>

                    <div class="ph-col-12 big"></div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-xl-4 ">

              <div id="" class="ph-item" style="width: 18rem;">

                <div class="ph-col-12">

                  <div class="ph-picture"></div>

                  <div class="ph-row">

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-12"></div>

                    <div class="ph-col-12 empty"></div>

                    <div class="ph-col-12 big"></div>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-xl-4 ">

              <div id="" class="ph-item" style="width: 18rem;">

                <div class="ph-col-12">

                  <div class="ph-picture"></div>

                  <div class="ph-row">

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-12"></div>

                    <div class="ph-col-12 empty"></div>

                    <div class="ph-col-12 big"></div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-xl-4 ">

              <div id="" class="ph-item" style="width: 18rem;">

                <div class="ph-col-12">

                  <div class="ph-picture"></div>

                  <div class="ph-row">

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-12"></div>

                    <div class="ph-col-12 empty"></div>

                    <div class="ph-col-12 big"></div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-xl-4 ">

              <div id="" class="ph-item" style="width: 18rem;">

                <div class="ph-col-12">

                  <div class="ph-picture"></div>

                  <div class="ph-row">

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-12"></div>

                    <div class="ph-col-12 empty"></div>

                    <div class="ph-col-12 big"></div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <!-- RENDER COURSES BY JQUERY -->

        <div id="contenedor_home" class="mb-4">


        </div>

      </div>



    </div>

    <!--INICIO DE CONTENIDO DE PAGINA -->

  </div>

  <div class="modal fade bd-example-modal-lg" id="modalvideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <video id="video" controls style="width:100%;">
          Tu navegador no admite el elemento <code>video</code>.
          <source src="" type="video/mp4" preload="auto">
        </video>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; MyClassroom</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <!-- <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>-->
            <li class="list-inline-item">
              <a href="#" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/myclassroom_ok/" target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <script language="JavaScript" type="text/javascript">
            TrustLogo("https://micuenta.donweb.com/img/sectigo_positive_sm.png", "CL1", "none");
          </script>
          <a style="color:#fed136;" href="https://donweb.com/es-ar/certificados-ssl" id="comodoTL" title="Certificados SSL Argentina">Certificados SSL Argentina</a>
        </div>

      </div>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!--<script src="js/fontawesome-all.min.js"></script>-->
  <script src="js/home.js"></script>
  <script src="js/dropdown.js"></script>
  <script src="js/admin.js"></script>
  <script src="js/subirvideo.js"></script>
  <script src="js/sweetalert2.js"></script>

  <!-- datatables JS -->
  <script src="vendor/popper/popper.min.js"></script>
  <script type="text/javascript" src="vendor/DataTables/datatables.min.js"></script>
  <script src="vendor/DataTables/Buttons-1.6.3/js/dataTables.buttons.min.js"></script>
  <script src="vendor/DataTables/JSZip-2.5.0/jszip.min.js"></script>
  <script src="vendor/DataTables/Buttons-1.6.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="js/datatable-lanzador.js"></script>

</body>

</html>