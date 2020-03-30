<?php
/* @var $this yii\web\View */

?>

<!doctype html>

<html lang="es">
<head>
    <meta charset="utf-8">

    <title>RESULTADOS MUJERES CORREN</title>

    <meta name="viewport" content="initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body{
            background: #F5F5F5;
            margin: 0;
        }
        .buscador{


        }
        .title{
            color:#666;
            font-size: 13px;
            line-height: 1.6;
            font-weight: 200;
        }
        .encabezado{
            background-image: url("https://time.fotosdeaventura.com/admin/user_content/img/img_evento79.jpg");
        }
        .input{
            /*>border: 3px solid #c9b2ba;
            border-radius: 10px;*/
        }
        .jumbotron {
            background-image: url('https://time.fotosdeaventura.com/admin/user_content/img/img_evento79.jpg');
            background-size: cover;
            height: 350px;


        }
        .tiempo{
            font-weight: 600;
            font-family: roboto mono,monospace;
        }
        .numero{
            color:grey;
            font-size: 13px;
        }
        .nombre{
            font-weight: 600 !important;
            font-size: 16px;
            text-transform: capitalize;
        }

        @media screen and (max-width: 768px)
        {
            #buscador{
                display: none;
            }

        }

        @media (min-width: 992px) {
            #btnAbrirBuscador{
                display: none;
            }
        }

    </style>
</head>

<body>

<div class="jumbotron">
    <p  style=" margin-top:120px;color:white; text-align: center; font-weight: 700; font-size: 3rem;line-height:1.2;">MUJERES CORREN new 2020</p>
</div>
<div class="container">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'method' => 'get',
        'action' =>\yii\helpers\Url::to(['mujerescorren/new']),
    ]); ?>

    <button id="btnAbrirBuscador" type="button" class="btn btn-info btn-sm" style="cursor:pointer;">Click para abrir buscador</button>
    <br>
    <br>
    <div id="buscador">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-4 ">
                <div class="form-group">
                    <label class="title">Buscar</label>
                    <input placeholder="Nombre o Número de Corredor" name="nombre_numero" type="text" class="form-control input">

                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="form-group">
                    <label class="title">Carrera</label>
                    <select name="carrera" id="selectCarrera" class="form-control input">
                        <option value="equipo" <?php if($carreraSeleccionada=="equipo") echo 'selected' ?> >Equipos</option>
                        <option value="5kindividual" <?php if($carreraSeleccionada=="5kindividual") echo 'selected' ?>  >5K Individual</option>
                        <option value="10kindividual"  <?php if($carreraSeleccionada=="10kindividual") echo 'selected' ?>  >>10K Individual</option>

                    </select>

                </div>
            </div>
            <div class="col-sm-12 col-md-3">

                <label class="title">Categoria</label>
                <select name="categoria" id="selectCategoria" class="form-control input">
                    <option value="general">GENERAL</option>

                </select>
            </div>
            <div class="col-md-2">
                <br>
                <button class="btn btn-info" type="submit">Filtrar</button>

            </div>

        </div>
    </div>


    <?php \yii\widgets\ActiveForm::end(); ?>
</div>
<div class="container-fluid" style="background-color: white; border: 1px solid #FFFFFF">
    <div class="container">
        <div class="table-responsive">
            <table class="table" style="color:grey;">
                <thead>
                <tr>
                    <th style="font-weight: 600; font-size: 14px!important;">Posicion</th>
                    <th style="font-weight: 600; font-size: 14px!important;">Corredor</th>
                    <th style="font-weight: 600; font-size: 14px!important;">Categoria</th>
                    <th style="font-weight: 600; font-size: 14px!important;">Tiempo</th>
                </tr>


                </thead>
                <tbody>
                    <?php
                        $posicion=1;
                        foreach($corredores as $corredor){
                            //no es por equipos
                                if($corredor["idEquipo"]==null){
                                    ?>
                                    <tr>
                                        <td><?php echo $posicion; $posicion++ ?></td>
                                        <td><span class="numero">#<?php echo $corredor["numCorredor"];?></span> <strong
                                                    class="nombre"><?php echo $corredor["nombre"]?></strong></td>


                                        <td><?php echo $corredor["nombreCategoria"] ?></td>
                                        <td class="tiempo"><?php echo date("H:i:s", $corredor["tiempo"] / 1000); ?></td>
                                    </tr>

                                    <?php

                                }else{
                                    $equipo=\app\models\Equipo::findOne(['idEquipo'=>$corredor["idEquipo"]]);
                                    if($equipo->llegaronAmetaParticipantes()){
                                        ?>
                                        <tr>
                                            <td><?php echo $posicion; $posicion++?></td>
                                            <td><strong class="nombre"><?php echo $equipo->getNombreParticipantesEquipo(); ?></strong></td>
                                            <td><?php echo $corredor["nombreCategoria"];?></td>
                                            <td class="tiempo"><?php echo date("H:i:s", $corredor["tiempo"] / 1000); ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>


                                <?php
                                }
                            ?>


                    <?php
                        }
                    ?>

                </tbody>

            </table>

        </div>
    </div>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>

    $("#btnAbrirBuscador").on("click",function(){
        if(!$('#buscador').is(':visible'))
        {
            $("#buscador").show();
        }else{
            $("#buscador").hide();
        }

    });
    var carreraSeleccionada=getQueryStringValue ("carrera");
    cargarComboCarrera(carreraSeleccionada);

    if(carreraSeleccionada==""){
        cargarComboCarrera("5kindividual");
        //$("#selectCategoria").val(1);
    }
    //


    $("#selectCarrera").on("change",function(){
        var carreraSelec=$("#selectCarrera").val();

        cargarComboCarrera(carreraSelec);


    });

    function cargarComboCarrera(carrera){
        var categoriaSeleccionada=getQueryStringValue ("categoria");

        $.ajax({
            url: 'index.php?r=mujerescorren/categorias&carrera='+carrera,

            success: function(respuesta) {
                var data=JSON.parse(respuesta);

                $("#selectCategoria").empty();
                if($("#selectCarrera").val()!="equipo"){
                    $("#selectCategoria").append(`<option value="general">General</option>`);
                }

                $.each(data, function(index, item) {

                    $("#selectCategoria").append(`<option  value="${item.idCategoria}" ${categoriaSeleccionada==item.idCategoria ?"selected":""}>${item.nombreCategoria}</option>`);

                });


            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });


    }

    function getQueryStringValue (key) {
        return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
    }
    /*if(getQueryStringValue("carrera")==1 && getQueryStringValue("categoria")=="general"){
        //window.location.href = "/index.php?r=mujerescorren%2Findex&carrera="+ $("#selectCarrera").val()+"&categoria="+$("#selectCategoria").val();

    }*/



    /*$("#selectCarrera").on("change",function(){


        window.location.href = "/index.php?r=mujerescorren%2Findex&carrera="+ $("#selectCarrera").val()+"&categoria="+$("#selectCategoria").val();

    });

    $("#selectCategoria").on("change",function(){

        var valorSeleccionadoCategoria=$("#selectCategoria").val();

        window.location.href = "/index.php?r=mujerescorren%2Findex&carrera="+ $("#selectCarrera").val()+"&categoria="+$("#selectCategoria").val();
    });*/
</script>
</body>
</html>