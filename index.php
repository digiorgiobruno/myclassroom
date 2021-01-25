<?php
include("./php/directorio.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (isset($_SESSION['id'])) {
    header("Location: http://" . $directorio . "home.php");
  } else {

    $sesion = "";
  }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="Cursos de MyClassroom Mendoza" content="Create una cuenta para acceder a charlas y cursos gratuitos">
  <meta name="keywords" content="curso, MyClassroom, mendoza">
  <meta name="author" content="Di Giorgio Bruno">
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
  <script type="text/javascript">
    const tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
    document.write(unescape("<script src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript' %3E%3C/script%3E"));
  </script>
  <!-- Strarrrs -->
  <link href="css/starrr.css" rel=stylesheet />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!--tema grafico de jqueryui-->

  <link rel="stylesheet" type="text/css" href="vendor/jqueryui/jquery-ui.css">
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <!-- Deshabilitamos cache -->
  <meta http-equiv="expires" content="0">

  <meta http-equiv="Cache-Control" content="no-cache">

  <meta http-equiv="Pragma" CONTENT="no-cache">



</head>

<body>
  <input type="hidden" id="role" name="" value="<?php echo $sesion ?>">


  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper" style="background: black !important">

      <div class="sidebar-heading">
        <a class="navbar-brand" href="#"><img src="img/logo.jpg" width="120" alt="logo"></a>

      </div>
      <div class="list-group list-group-flush">

        <ul id='cat1' class="navbar-nav mr-auto">
          <!--Item Dropdown Cursos categoria-->
          <li id='cat2' class="nav-item dropdown list-group-item list-group-item-action">
            <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Categorías</a>
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
        </ul>
      </div>

    </div>

    <!--INICIO DE CONTENIDO DE PAGINA -->

    <div id="page-content-wrapper" style="background: rgb(250,250,250);">



      <!--nav -->
      <nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation" style="background: black !important">

        <button class="btn btn-primary mr-3" id="menu-toggle">Cursos</i></button>

        <button id="btn-toggle" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul id='cat1' class="navbar-nav mr-auto">


            <div class="g1 d-flex flex-row">
              <!--Item Inicio-->
              <li class="nav-item active">
                <a id="inicio" class="nav-link nav-element" href="#">Inicio <span class="sr-only">(current)</span></a>
              </li>
              <!--Item Mis Cursos-->
              <li class="nav-item active">
                <a id="login" class="nav-link nav-element" href="#">Iniciar sesión</a>
              </li>
              <!--Item registro-->
              <li class="nav-item active">
                <a id="" class="registrarse nav-link nav-element" href="#">Registrarse</a>
              </li>




            </div>


          </ul>


          <span class="navbar-text text-white">
            Contacto:
            <a href="mailto:soporte@myclassroom.com.ar">soporte@myclassroom.com.ar</a>
          </span>
        </div>
      </nav>

      <div class="jumbotron p-1" id="jumbotron">
        <div class="container text-right">
          <h3 class="">Nuestros cursos
          </h3>


        </div>
      </div>

      <!-- Register Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="registromodal modal-header">
              <h4 class="modal-title" style="color:#fff;">Registro</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col-6">
                  <input class="form-control" type="text" id="nameR" placeholder="Nombre">
                </div>
                <div class="col-6">
                  <input class="form-control" type="text" id="lastnameR" placeholder="Apellido">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-12">
                  <input class="form-control" type="text" id="localidadAutocomplete" placeholder="País">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-12">
                  <input class="form-control" type="email" id="emailR" placeholder="Email">
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-12">
                  <input class="form-control" type="password" id="passR" placeholder="Contraseña">
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-12">
                  <input class="form-control" type="password" id="passRe" placeholder="Confirmar Contraseña">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-12">
                  <input type="text" class="form-control datepicker" value="" placeholder="Fecha Nacimiento" data-date-format="mm/dd/yyyy" id="dp2">
                </div>
              </div>
              <div class="row mb-2 text-center">
                <div class="col-12">
                  <span id="validate_register" class="help-block text-danger" style="font-weight: bold;"></span>
                </div>
              </div>

              <div class="row text-xs-center">
                <div id="recaptcha1" class="g-recaptcha"></div>
              </div>


            </div>
            <div class="container d-flex justify-content-end mb-3 ">

              <button id="register_button" type="button" class="btn btn-md p-1  btn-primary mr-2 col-xs-12 col-xl-2">Aceptar</button>
              <button type="button" class="btn btn-outline-secondary mr-2 col-xs-12 col-xl-2" data-dismiss="modal">Cerrar</button>

            </div>
          </div>
        </div>
      </div>

      <!-- Reset Pass Modal-->
      <div class="modal fade" id="resetModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="registromodal modal-header">
              <h4 class="modal-title" style="color:#fff;">Recuperar contraseña</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col-12">
                  <p>Le enviaremos un mail a su correo con las instrucciones para recuperar su contraseña. Recuerde revisar su casilla de mensajes no deseados o spam.</p>
                </div>
                <div class="col-12">
                  <input class="form-control" type="email" id="emailR2" placeholder="Introduzca su correo">
                </div>
              </div>
              <div class="row mb-2 text-center">
                <div class="col-12">
                  <span id="validate_restore" class="help-block text-danger" style="font-weight: bold;"></span>
                </div>
              </div>
              <div class="row text-xs-center">
                <div id="recaptcha2" class="g-recaptcha"></div>
              </div>
            </div>
            <div class="modal-footer">

              <button id="pass_button" type="button" class="btn btn-primary">Aceptar</button>
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- login modal-->
      <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="registromodal modal-header">
              <h4 class="modal-title" style="color:#fff;">Iniciar sesión</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col-12">
                  <input class="form-control" id="email" type="email" placeholder="Correo" autocomplete="username" />
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-12">
                  <input class="form-control" id="pass" type="password" placeholder="Contraseña" autocomplete="current-password" />
                </div>
              </div>

            </div>

            <div class="modal-content mt-2">
              <div class="col-lg-12 col-sm-12 text-center">
                <button id="login_button" class="btn btn-warning btn-block text-uppercase mb-1" type="button"> Ingresar</button>
              </div>
              <div class="col-lg-12 col-sm-12 text-center">
                <button type="button" class="registrarse btn btn-outline-primary btn-block text-uppercase mb-1" data-toggle="modal" data-target="#exampleModalCenter">
                  ¡Registrate!
                </button>
              </div>
            </div>
            <div class="row mt-0">
              <div class="col-lg-12 text-center">
                <a href="#resetModalCenter" class="resetpass" data-toggle="modal" data-target="#resetModalCenter">
                  ¿Olvidó su contraseña?
                </a>
              </div>
            </div>

            <label id="validate" class="help-block text-danger text-center" style="font-weight: bold;"></label>

          </div>
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



          </div>

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

      <!-- Footer -->
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-4">
              <span class="copyright">Copyright &copy; MyClassroom</span>
            </div>
            <div class="col-md-4">
              <ul class="list-inline social-buttons">

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


    </div>

  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-video" role="document">
      <div class="modal-content">


        <div class="modal-body modal-body-video">

          <button type="button" class="close close-video" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
          </div>


        </div>

      </div>
    </div>
  </div>




  
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jqueryui/jquery-ui.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!--<script src="js/fontawesome-all.min.js"></script>-->
  <script src="js/home.js"></script>
  <script src="js/dropdown.js"></script>
  <script src="js/admin.js"></script>
  <script src="js/subirvideo.js"></script>
  <script src="js/sweetalert2.js"></script>
  <!-- recaptcha v2 JavaScript -->
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
  </script>
  <!-- datatables JS -->
  <script src="vendor/popper/popper.min.js"></script>
  <script type="text/javascript" src="vendor/DataTables/datatables.min.js"></script>
  <script src="vendor/DataTables/Buttons-1.6.3/js/dataTables.buttons.min.js"></script>
  <script src="vendor/DataTables/JSZip-2.5.0/jszip.min.js"></script>
  <script src="vendor/DataTables/Buttons-1.6.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="js/datatable-lanzador.js"></script>
  <script src="js/landing.js"></script>
</body>

</html>