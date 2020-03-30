<?php
/* @var $this yii\web\View */
Yii::$app->request->csrfParam;
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
            text-transform: uppercase;
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
    <p  style=" margin-top:120px;color:white; text-align: center; font-weight: 700; font-size: 3rem;line-height:1.2;"><?php echo $evento->nombre;?></p>
</div>
<div class="container">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'method' => 'get',
        'action' =>\yii\helpers\Url::to(['resultado/index']),
    ]); ?>

    <button id="btnAbrirBuscador" type="button" class="btn btn-info btn-sm" style="cursor:pointer;">Click para abrir buscador</button>
    <br>
    <br>
    <div id="buscador">
        <div class="row mb-3">
            <!-- <div class="col-sm-12 col-md-4 ">

                <div class="form-group">
                    <label class="title">Buscar</label>
                    <input placeholder="Nombre o Número de Corredor" name="nombre_numero" type="text" class="form-control input">

                </div>



            </div>-->
            <input type="hidden" name="evento" value="<?php echo $_GET["evento"] ?>">
            <div class="col-sm-12 col-md-4">
                <div class="form-group">
                    <label class="title">Carrera</label>
                    <select name="carrera" id="carrera" class="form-control input">
                        <?php
                         foreach ($carreras as $carrera){
                             ?>
                             <option value="<?php echo $carrera->idCarrera?>"><?php echo $carrera->nombre?></option>
                        <?php
                         }
                        ?>

                    </select>

                </div>
            </div>
            <div class="col-sm-12 col-md-4">

                <label class="title">Categoria</label>
                <select name="categoria" id="selectCategoria" class="form-control input">

                </select>
            </div>
            <!--
            <div class="col-md-2">
                <br>
                <button class="btn btn-info" type="submit">Filtrar</button>

            </div>
            -->



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
                    <th style="font-weight: 600; font-size: 14px!important;">Pos</th>
                    <th style="font-weight: 600; font-size: 14px!important;">Corredoras</th>
                    <th>Cat</th>
                    <th style="font-weight: 600; font-size: 14px!important;">Tiempo</th>
                </tr>


                </thead>
                <tbody id="tableBody">

                </tbody>

            </table>

        </div>
    </div>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var carreraSeleccionada=$("#carrera").val();
        //SE CARGAN LAS CATEGORIAS SEGUN LA CARRERA
        cargarCategoria(carreraSeleccionada);
        //SE CARGA LOS RESULTADOS GENERALES DEPENDIENDO DEL ID CARRERA
        cargarGrillaResultadosGeneral(carreraSeleccionada);
        //#region <EVENTOS>
        $( "#carrera" ).change(function() {
            carreraSeleccionada=this.value;
            cargarCategoria(this.value);
            cargarGrillaResultadosGeneral(carreraSeleccionada);
        });

        $("#selectCategoria").change(function(){
            if(this.value=="general"){
                cargarGrillaResultadosGeneral(carreraSeleccionada);
            }
            cargarGrillaResultadoByCategoria(this.value);
        });
        //endregion



    });

    function cargarCategoria(carrera){
        $("#selectCategoria").empty();
        $.ajax({
            url: 'resultado/categorias?carrera='+carrera,

            success: function(respuesta) {
                var data=JSON.parse(respuesta);



                $("#selectCategoria").append(`<option value="general">General</option>`);
                $.each(data, function(index, item) {

                    $("#selectCategoria").append(`<option  value="${item.idCategoria}">${item.nombreCategoria}</option>`);

                });



            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
    }

    function cargarGrillaResultadosGeneral(carrera){
        var posicion=1;
        var tbody=$("#tableBody").empty();
        $.ajax({
            url: 'resultado/general?carrera='+carrera,

            success: function(respuesta) {
                var data=JSON.parse(respuesta);

                $.each(data, function(index, item) {

                     var template=
                         `<tr>
                             <td>${posicion}</td>
                             <td>
                                <span class="numero">#${item.numCorredor}</span>
                                <strong class="nombre">${item.nombre}</strong>

                            </td>
                             <td>${item.nombreCategoria}</td>
                             <td class="tiempo">${msToTime(item.tiempo)}</td>
                         <tr>`;

                     tbody.append(template);
                     posicion++;
                });
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });

    }
    function cargarGrillaResultadoByCategoria(categoria){
        var posicion=1;
        var tbody=$("#tableBody").empty();
        $.ajax({
            url: 'resultado/resultadocategoria?categoria='+categoria,

            success: function(respuesta) {
                var data=JSON.parse(respuesta);

                $.each(data, function(index, item) {
                    var template=
                        `<tr>
                             <td>${posicion}</td>
                             <td>
                                ${typeof (item.numCorredor)!='undefined'?`<span class="numero">#${item.numCorredor}</span>` :''}
                                <strong class="nombre">${item.nombre}</strong>
                              </td>
                             <td>${item.nombreCategoria}</td>
                             <td class="tiempo">${msToTime(item.tiempo)}</td>
                         <tr>`;
                    tbody.append(template);
                    posicion++;

                });
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
    }
    /*HELPERS*/
    function msToTime(duration) {
        var milliseconds = parseInt((duration%1000))
            , seconds = parseInt((duration/1000)%60)
            , minutes = parseInt((duration/(1000*60))%60)
            , hours = parseInt((duration/(1000*60*60))%24);

        hours = (hours < 10) ? "0" + hours : hours;
        minutes = (minutes < 10) ? "0" + minutes : minutes;
        seconds = (seconds < 10) ? "0" + seconds : seconds;

        return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
    }
    /*var tbody=$("#tableBody");
    var template=`<tr>
                    <td>Hola</td>
                  <tr>`;

    tbody.append(template);*/

</script>


</body>
</html>