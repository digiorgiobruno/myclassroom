<script src="https://www.paypal.com/sdk/js?client-id=AbOGjNXVyFMzVF4vVoDcG9qT0zjp97Tplvm5CFiQWmQim5DDYdvub_QdUHWzVkHd3cRk1iBFrRxzPMOb&currency=USD"></script>

 <!-- en client-id deben colocar el id de su cuenta de sandbox yo coloque el mio como ejemplo pero deben colocar el de uds para que puedan ver la info de la transaccion en su cuenta de sandbox de paypal -->
    
 <script src="https://www.paypalobjects.com/api/checkout.js"></script> <!-- con ese script podran visualizar los botones de paypal y tarjeta de credito-->

<script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
           

            style: {
                size: 'responsive',
                shape: 'pill',
                label: 'pay'

            },
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            
                            value: '<?php echo $total;?>',                            
                        },
                        description: 'Compra de productos a la tienda por un valor de $ <?php echo number_format($total); ?> COP ',
                        reference_id: "<?php echo $SID; ?>#<?php echo openssl_encrypt($idVenta,COD,KEY);?>"
  //paypal en su documentacion nueva no utiliza custom pot que ahora utiliza reference_id, por eso se debe utilizar este capo
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
 // yo deje esta alerta para una mejor verificacion del codigo
                    console.log(data);
 //con este codigo se muestran las variables de data depaypal  en el consola del explorador
                    window.location="verificador.php?facilitatorAccessToken="+data.facilitatorAccessToken+"&orderID="+data.orderID+"&payerID="+data.payerID

                });
            }


        }).render('#paypal-button-container');
    </script>

//a continuacion veremos como queda el codigo del archivo verificador.php segun la nueva documentacion de paypal desde febrero del 2019 

<?php 
    //print_r($_GET);//imprime en pantalla las variables que se pasan por $_GET de la pagina pagar.php
    
    $ClientID="AbOGjNXVyFMzVF4vVoDcG9qT0zjp97Tplvm5CFiQWmQim5DDYdvub_QdUHWzVkHd3cRk1iBFrRxzPMOb";//identidad del cliente del app sandbox paypal
 //ojo que es el mio, porfavor utiliza tu id
    $Secret="EFUenWaTPldWz3TKukell_dGWXtzO9WeuqNiv__xL-btcMJoqG5TIogHWBXujeCGNeMrv_446N7it-ug";//clave secreta del cliente del app sandbox paypal
 //! ojo que es mi clave, porfavor utiliza la tuya!

    //----obtener el token de acceso para consultar la informacion del pago 

    $Login= curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");

            curl_setopt($Login,CURLOPT_RETURNTRANSFER,TRUE);

            curl_setopt($Login,CURLOPT_USERPWD,$ClientID.":".$Secret);

            curl_setopt($Login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");

    $Respuesta=curl_exec($Login);    

    $objRespuesta=json_decode($Respuesta);

    $AccessToken=$objRespuesta->access_token;
 // en esta variable almacenamos el token de acceso que nos retorna la peticion que realizamos
    
    //print_r($AccessToken); //Se imprime el token de acceso obtenido de paypal

    //---- codigo para obtener el detalle del pago de la venta
    
    /* Sandbox: https://api-m.sandbox.paypal.com
        Live: https://api-m.paypal.com */

    $Venta=curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders/".$_GET['orderID']);
 // ya no se utiliza paymentsID sino orderID
    

            curl_setopt($Venta,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer ".$AccessToken));

            curl_setopt($Venta,CURLOPT_RETURNTRANSFER, TRUE);

            curl_setopt($Venta,CURLOPT_POST, FALSE);          

            curl_setopt($Venta,CURLOPT_SSL_VERIFYPEER, FALSE);

    $RespuestaVenta=curl_exec($Venta);

    //print_r($RespuestaVenta); //se imprime en pantalla el detalle de la transaccion realizada

    $objDatosTransaccion=json_decode($RespuestaVenta);

    //print_r($objDatosTransaccion-); // imprimimos los datos del objeto que recibe los detalles de la venta
 

    //print_r($objDatosTransaccion->purchase_units[0]->reference_id); //forma de imprimir el detalle de una variable que esta dentro de un array del objeto


    // ------ asi era como se localizaban los datos en la vieja documentacion ------
    //$total=$objDatosTransaccion->transactions[0]->amount->total;
    //$currency=$objDatosTransaccion->transactions[0]->amount->currency;
    //$custom=$objDatosTransaccion->transactions[0]->custom;

    
    //------ como la estructura del json que devuelve paypal cambio, ahora se deben localizar los datos de la siguiente forma -----
  
    $status=$objDatosTransaccion->status;
    $email=$objDatosTransaccion->payer->email_address;
    $total=$objDatosTransaccion->purchase_units[0]->amount->value;
    $currency=$objDatosTransaccion->purchase_units[0]->amount->currency_code;
    $reference_id=$objDatosTransaccion->purchase_units[0]->reference_id;

    // ---- aqui imprimimos los datos recuperados del objeto que paypal nos retorna -----
    echo $status."<br>";
    echo $email."<br>";
    echo $total."<br>";
    echo $currency."<br>";
    echo $reference_id;

?>