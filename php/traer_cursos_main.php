<?php
include('mysqli.php');
require('../vendor/autoload.php');
if (isset($_POST['operacion']) && isset($_POST['categoria']) && isset($_POST['subcategoria'])) {
    $operacion = $_POST['operacion'];
    $cat = $_POST['categoria'];
    $subcat = $_POST['subcategoria'];

    //echo $operacion." "."cat".$cat." subcat".$subcat;
    //die;

}
switch ($operacion) {
    case "todos":
        todos($cat, $subcat); //devolver todos los cursos de la BD
        break;
    case "comprados":
        comprados(); //devolver solo los comprados
        break;
    case "categoria":
        todos($cat, $subcat); //devolver los de una categoria y subcategoria especifica
        break;

    default:;
        break;
}


function todos($cat, $subcat)
{
    //echo "cat ".$cat."subcat ".$subcat;

    if ($cat != "" && $subcat != "") {
        $sql = MySQLDB::getInstance()->query("SELECT * FROM course WHERE category='$cat' AND subcategory='$subcat' ORDER BY creationdate DESC");
        //el caso de que queramos mostrar todos los cursos

    } else {
        $sql = MySQLDB::getInstance()->query("SELECT * FROM course ORDER BY creationdate DESC");
    }


    if ($sql->num_rows) {
        while ($rs = $sql->fetch_assoc()) {

            $codeVideoQuery = MySQLDB::getInstance()->query("SELECT videoscourse.name FROM videoscourse,themes,course WHERE course.id=" . $rs['id'] . " AND course.id=videoscourse.idcourse AND videoscourse.idtheme=themes.id AND themes.name='intro'");
            $codeVideoArray = $codeVideoQuery->fetch_assoc();
            $codeVideo=$codeVideoArray['name'];
            if (isset($_SESSION['id'])) {
                $sqlcheck = MySQLDB::getInstance()->query("SELECT id FROM courseuser WHERE idcourse= " . $rs['id'] . " AND iduser = " . $_SESSION['id'] . " ");
                $comprado = $sqlcheck->num_rows;
            } else {
                $comprado = false;
            }
            if ($comprado) {
                $stars = consultastar($rs['id']);
                $cursos[] = array(
                    'id' => $rs['id'], 'name' => $rs['name'], 'description' => $rs['description'],
                    'category' => $rs['category'], 'imgname' => $rs['imgname'], 'price' => $rs['price'], 'credentialid' => $rs['credentialid'], 'prom' => $stars[0]['prom'], 'cant' => $stars[0]['cant'], 'bought' => true, 'videoCode' => $codeVideo
                );
            } else {
                $stars = consultastar($rs['id']);
                $cursos[] = array(
                    "id" => $rs['id'], "name" => $rs['name'], "description" => $rs['description'],
                    "category" => $rs['category'], "imgname" => $rs['imgname'], 'price' => $rs['price'], 'credentialid' => $rs['credentialid'], 'prom' => $stars[0]['prom'], 'cant' => $stars[0]['cant'], 'bought' => false, 'videoCode' => $codeVideo //"preferenceid"=>$preference->id
                );
            }
        }
        //print_r($cursos);
        if (is_array($cursos)) {

            //print_r($cursos);
            echo json_encode($cursos);
            die;
        } else {
            echo "error";
        }
    } else {
        echo 0; //No hay cursos para mostrar
        die;
    }
}

function comprados()
{

    $sql = MySQLDB::getInstance()->query("SELECT course.id,name,description, category, imgname FROM course 
                                            INNER JOIN courseuser ON courseuser.idcourse = course.id
                                            WHERE courseuser.iduser = " . $_SESSION['id'] . " ORDER BY creationdate DESC");
    if ($sql->num_rows) {
        while ($rs = $sql->fetch_assoc()) {
            $codeVideoQuery = MySQLDB::getInstance()->query("SELECT videoscourse.name FROM videoscourse,themes,course WHERE course.id=" . $rs['id'] . " AND course.id=videoscourse.idcourse AND videoscourse.idtheme=themes.id AND themes.name='intro'");
            $codeVideoArray = $codeVideoQuery->fetch_assoc();
            $codeVideo=$codeVideoArray['name'];
            $stars = consultastar($rs['id']);
            $cursos[] = array(
                'id' => $rs['id'], 'name' => $rs['name'], 'description' => $rs['description'],
                'category' => $rs['category'], 'imgname' => $rs['imgname'], 'prom' => $stars[0]['prom'], 'cant' => $stars[0]['cant'], 'bought' => true, 'videoCode' => $codeVideo
            );
        }
        echo json_encode($cursos); //Array de cursos
    } else {
        echo 0; //No hay cursos para mostrar
        die;
    }
}
//cuenta las estrellas
function consultastar($idcourse)
{
    $sql1 = MySQLDB::getInstance()->query("SELECT * FROM starscourse WHERE courseid='$idcourse'");
    $cant = $sql1->num_rows;
    $aux = 0;
    if ($sql1->num_rows != 0) {
        while ($r = $sql1->fetch_assoc()) {
            if ($r['cant'] != 0) {
                $aux = $aux + $r['cant'];
            } else {
                $cant = $cant - 1;
            }
        }
    }
    if ($cant != 0) {

        $prom = $aux / $cant;


        $stars[] = array(
            'cant' => $cant, 'prom' => $prom
        );

        return $stars;
    } else {

        $stars[] = array(
            'cant' => 0, 'prom' => 0
        );

        return $stars;
    }
}
//recupera la cantidad de votos que hizo un user
function votoxid($iduser, $idcourse)
{
    $sql1 = MySQLDB::getInstance()->query("SELECT cant FROM starscourse WHERE courseid='$idcourse' AND userid='$iduser'");
    if ($sql1->num_rows != 0) {
        $userStar = $sql1->fetch_assoc();
        return $userStar['cant'];
    } else {
        return 0;
    }
}
