<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Notarweb</title>
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

    <form>
        <div class="form-group">

            <input type="text" class="form-control" id="localidadAutocomplete" placeholder="país">

        </div>


    </form>


    <script src="vendor/jqueryui/external/jquery/jquery.js"></script>
    <script src="vendor/jqueryui1/jquery-ui.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {



            $('#localidadAutocomplete').autocomplete({

                source: function(request, response) {
                    $.ajax({
                        url: "./php/country.php",
                        dataType: "json",
                        data: {
                            q: request.term
                        },
                        success: function(data) {
                            
                            response(data);
                        }

                    });
                },
                autoFocus: true,
                minLength: 1,
                select: function(event, ui) {
                    //alert("Selecciono: " + ui.item.label);
                }


            });




        });
    </script>
</body>

</html>