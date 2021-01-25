<?php

header("HTTP/1.2 200 OK");
include("mysqli.php");
$event = file_get_contents('php://input');
$eventDecode = json_decode($event);
$objDatosTransaccion;
if (isset($eventDecode->resource_type)) {
    //RESPUESTA WEBHOOK
    //generamos un log
    $logFile = fopen("logpaypalWebhook.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' ' . $event) or die("Error escribiendo en el archivo");
    fclose($logFile);
    $objDatosTransaccion = $eventDecode->resource;
} else {
    //RESPUESTA INMEDIATA
    //Generamos log

    $logFile = fopen("logpaypal.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' ' . $event) or die("Error escribiendo en el archivo");
    fclose($logFile);

    $orderID = $_POST['orderID'];

    $clientID = "AcOza97oiUXYV9EN2AcaxvirhxnDb4vAxOMBiTkbPqmHv8ig7Ri_xQteWqmuMlkcQFYCK-7TCrOijG4E";
    $secret = "ENKQKkA8ywcEZ-Eaa5aF-R3w-77oX3iD3QPSQH889W1LJN_MvokmHQK5RN5_4KNjTk1qVuKZyuKVAx-1";
    $URL = "https://api-m.sandbox.paypal.com"; // produccion -> https://api-m.paypal.com
    $login = curl_init($URL . "/v1/oauth2/token");
    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($login, CURLOPT_USERPWD, $clientID . ":" . $secret);
    curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $respuesta = curl_exec($login);
    $objRespuesta = json_decode($respuesta);
    $accessToken = $objRespuesta->access_token;
    //echo "AT: " . $accessToken . "\n";

    $venta = curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders/" . $orderID);
    curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $accessToken));
    curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($venta, CURLOPT_POST, FALSE);
    curl_setopt($venta, CURLOPT_SSL_VERIFYPEER, FALSE);

    $respuestaVenta = curl_exec($venta);

    //print_r($respuestaVenta); //se imprime en pantalla el detalle de la transaccion realizada

    $objDatosTransaccion = json_decode($respuestaVenta);
    //echo "debug terminado";
    //die;
}

//print_r($objDatosTransaccion); //imprimimos el objeto de la transaccion
//------ como la estructura del json que devuelve paypal cambio, ahora se deben localizar los datos de la siguiente forma -----

$status = $objDatosTransaccion->purchase_units[0]->payments->captures[0]->status;
$email = $objDatosTransaccion->payer->email_address;
$totalPagado = $objDatosTransaccion->purchase_units[0]->amount->value;
$currency = $objDatosTransaccion->purchase_units[0]->amount->currency_code;
$reference_id = $objDatosTransaccion->purchase_units[0]->reference_id;



$ids = explode("#", $reference_id);
$idcourse = $ids[0];
$iduser = $ids[1];

curl_close($venta);
curl_close($login);



$q = MySQLDB::getInstance()->query("SELECT price, name FROM course WHERE id=" . $idcourse . "");
$r = $q->fetch_assoc();
$monto = $r['price'];
$nombre = $r['name'];
//echo "\ntotal pagado:".$totalPagado.">= monto :".$monto."\n";
if ($status == "COMPLETED" && $totalPagado >= $monto) {

    $sql = MySQLDB::getInstance()->query("SELECT * FROM courseuser WHERE idcourse = $idcourse AND iduser = " . $iduser . " ");
    if ($sql->num_rows != 0) {
        echo "el curso ya fue comprado";
        die;
    } else {
        $sql1 = MySQLDB::getInstance()->query("INSERT INTO courseuser (idcourse,iduser,saledate,paymentmethod) VALUES ('$idcourse','$iduser',now(),2)");
        if ($sql1) {
            $respuesta = array(
                'nombre' => $nombre, "status"=>"$status",'type'=>"paypal"// se completo el pago con exito
            );
            echo json_encode($respuesta);
            die;
        } else {
            echo "error al insertar";
            die;
        }
    }
} else {
    //if ($status == "APPROVED") {

    
    echo "Debe esperar a que se apruebe el pago";
    die;
    //}
}

die;

/*
//para debug
$as="Estado de compra:" . $status . "
Correo de comprador: " . $email . "
Total Pagado :<b>" . $totalPagado . "
Moneda: <b>" . $currency . "
Referencia_id: <b>" . $reference_id ;


$logFile = fopen("logpaypalWebhook.txt", 'a') or die("Error creando archivo");
fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' ' . $as) or die("Error escribiendo en el archivo");
fclose($logFile);
die;
*/