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

  <!-- Deshabilitamos cache -->
  <meta http-equiv="expires" content="0">

  <meta http-equiv="Cache-Control" content="no-cache">

  <meta http-equiv="Pragma" CONTENT="no-cache">

  <script src="https://www.paypal.com/sdk/js?client-id=AcOza97oiUXYV9EN2AcaxvirhxnDb4vAxOMBiTkbPqmHv8ig7Ri_xQteWqmuMlkcQFYCK-7TCrOijG4E&currency=USD"></script>

</head>

<body>



  <!-- en client-id deben colocar el id de su cuenta de sandbox yo coloque el mio como ejemplo pero deben colocar el de uds para que puedan ver la info de la transaccion en su cuenta de sandbox de paypal -->

  <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> con ese script podran visualizar los botones de paypal y tarjeta de credito-->

  <div id="paypal-button-container"></div>
  <div id="paypal-respuesta"> Respuesta</div>
  <script>
    let pagoTotal = '1';
    let clientID = 2; //recordar encriptar
    let productID = 163;
    let descripcion = "Curso numero 6"
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({


      style: {
        layout: 'horizontal',
        size: 'responsive', // small | medium | large | responsive
        shape: 'pill', // pill | rect
        label: 'pay' // checkout | credit | pay | buynow | generic


      },
      // Set up the transaction
      createOrder: function(data, actions) {
        return actions.order.create(
          {
            purchase_units: [{
              amount: {

                value: pagoTotal,
              },
              description: 'Compra de productos a la tienda por un valor de $ ' + pagoTotal + ' COP ',
              reference_id: productID + "#" + clientID
              //paypal en su documentacion nueva no utiliza custom pot que ahora utiliza reference_id, por eso se debe utilizar este capo
            }]
          }


        );
      },

      // Finalize the transaction
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          // Show a success message to the buyer
          //alert('Transaction completed by ' + details.payer.name.given_name + '!');
          // yo deje esta alerta para una mejor verificacion del codigo
          console.log(data);
          //con este codigo se muestran las variables de data depaypal  en el consola del explorador
          //window.location = "./php/verificador_paypal.php?facilitatorAccessToken=" + data.facilitatorAccessToken + "&orderID=" + data.orderID + "&payerID=" + data.payerID

          $.ajax({

            url: "./php/verificador_paypal.php",
            type: "post",
            data: {
              'facilitatorAccessToken': data.facilitatorAccessToken,
              'orderID': data.orderID,
              'payerID': data.payerID,
            },

            beforeSend: function() { //Previo a la peticion tenemos un cargando

            },
            error: function(error) { //Si ocurre un error en el ajax

            },
            complete: function() { //Al terminar la peticion, sacamos la "carga" visual

            },

            success: function(r) {
              console.log(r);


            }

          });
        });
      }


    }).render('#paypal-button-container');
  </script>



  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jqueryui/jquery-ui.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>