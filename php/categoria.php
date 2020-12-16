<?php
include("mysqli.php");

//Si operacion igual a cargar devuelve las categorias y las subcategorias
if (isset($_POST['operacion']) && $_POST['operacion'] == 'cargar') {
    $s = MySQLDB::getInstance()->query("SELECT * FROM categories ");
    $sql1 = MySQLDB::getInstance()->query("SELECT * FROM categories ");
    if ($s->num_rows > 0) {

        $i = 0;
        $j = 0;

        $categorias1 = '';

        for ($i = 0; $i <= 4; $i++) {
            $rs1 = $sql1->fetch_assoc();
            $idcat = $rs1['id'];
            $pill = "";
            if ($idcat == 28) {
                $pill = '<span class=" ml-1 badge badge-pill badge-warning">Nuevo</span>';
            }
            $sql2 = MySQLDB::getInstance()->query("SELECT * FROM subcategories WHERE idcategory='$idcat'");
            if ($rs1['name'] != "") {
                $categorias1 .= '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ' . $rs1['name'] .$pill . '
            </a><div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                while ($rs2 = $sql2->fetch_assoc()) {

                    $categorias1 .= '
                <a class="dropdown-item nav-element subcategory" categoryname="' . $rs1['name'] . '" idcategory="' . $rs1['id'] . '" idsubcategory="' . $rs2['id'] . '">' . $rs2['name'] . '</a>
              ';
                }
            }

            $categorias1 .= '</div></li>';
            $j++;
        }
        $i = 0;
        $categorias = '<a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</a>
        <ul  class="dropdown-menu" aria-labelledby="dropdown1">';

        $l = $s->num_rows;
        //echo "for desde j =".$j." hasta l ".$l;
        while ($aux = $s->fetch_assoc()) {
            $rs[] = $aux;
        }
        //print_r($rs);
        //die;
        for ($i = $j; $i <= $l - 1; $i++) {
            //$rs = $s->fetch_assoc();
            $idcat = $rs[$i]['id'];
            $sql1 = MySQLDB::getInstance()->query("SELECT * FROM subcategories WHERE idcategory='$idcat'");
            //if ($sql1->num_rows>0) {
            $categorias .= '<li class="dropdown-item dropdown">
                            <a class="dropdown-toggle" id="dropdown1-' . $i . '"data-toggle="dropdown"'
                . 'aria-haspopup="true" aria-expanded="false">' . $rs[$i]['name'] . '</a>
                                <!--Item subcategoria-->
                                <ul class="dropdown-menu" aria-labelledby="dropdown1-' . $i . '">';


            while ($rs1 = $sql1->fetch_assoc()) {

                $categorias .= '<!--Item categoria-->
                    <li class="dropdown-item " href="#"><a categoryname="' . $rs[$i]['name'] . '" idcategory="' . $rs[$i]['id'] . '" idsubcategory="' . $rs1['id'] . '" class="subcategory nav-element">' . $rs1['name'] . '</a></li>
                                ';
            }
            $categorias .= '</li></ul>';
            //}

        }

        //$categorias.='';
    } else {
        $categorias = "No hay cursos cargados";
    }

    $cat[] = array(
        'cat1' => $categorias1,
        'cat2' => $categorias
    );
    echo json_encode($cat);
    die;
}

if (isset($_POST['categoria'])) {
    $categoria = trim(filter_var($_POST['categoria'], FILTER_SANITIZE_STRING));

    if (!($categoria)) { //Filtrado de variables
        echo 4; //Quiere romper algo
        die;
    }
}

if (isset($_POST['operacion']) && $_POST['operacion'] == 'agregaconsulta') {
    //Agregar categoria o consultar


    if ($categoria == "traer") {

        //Select las categorias
        echo buscarCategorias();
    } else {

        //Insertamos la nueva categoria
        //devolvemos categorias actulizadas
        $sql = MySQLDB::getInstance()->query("SELECT * FROM categories where name='$categoria' ");

        if ($sql->num_rows != 0) {
            echo 1; //categoria existente
            die;
        } else {
            //realizamos el insert de la nueva categoria        

            $sql = MySQLDB::getInstance()->query("INSERT INTO categories (name) VALUES ('$categoria')");
            echo buscarCategorias();
            die;
        }
    }
} else {

    $sql = MySQLDB::getInstance()->query("SELECT * FROM categories where name='$categoria' ");

    if ($sql->num_rows != 0) {
        //Eliminamos la categoria

        if (MySQLDB::getInstance()->query("DELETE FROM categories WHERE name ='$categoria'")) {
            echo buscarCategorias();
            die;
        } else {
            echo 2; //no puede borrar esta categoria por que esta asignada a al menos un video
        }
    } else {
        echo 3; //categoria inexistente
    }



    /*
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>*/
}



function buscarCategorias()
{

    //Select las categorias
    $sql = MySQLDB::getInstance()->query("SELECT * FROM categories ");
    if ($sql->num_rows) {
        $categorias = '<option selected>Seleccionar...</option>';
        while ($rs = $sql->fetch_assoc()) {
            $option = '<option value="' . $rs['id'] . '">' . $rs['name'] . '</option>';
            $categorias = $categorias . $option;
        }
    }

    return $categorias;
}
