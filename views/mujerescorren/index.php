<?php
/* @var $this yii\web\View */

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>RESULTADOS MUJERES CORREN</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

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
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron ">
            <p  style=" margin-top:120px;color:white; text-align: center; font-weight: 700; font-size: 3rem;line-height:1.2;">MUJERES CORREN 2020</p>
        </div>
    </div>

    <div class="container">
        <div class="row">


                <div class="col-sm-12 col-md-4 ">
                    <div class="form-group">
                        <label class="title">Buscar</label>
                        <input placeholder="Nombre o Número de Corredor" type="text" class="form-control input">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="title">Carrera</label>
                        <select class="form-control input">
                            <option>Equipos</option>
                            <option>5K</option>
                            <option>10K</option>

                        </select>

                    </div>
                </div>
                <div class="col-md-4">

                    <label class="title">Categoria</label>
                    <select class="form-control input">
                        <option>Equipos</option>
                        <option>5K</option>
                        <option>10K</option>

                    </select>
                </div>

            </div>


    </div>

    <div class="containerfluid mt-3" style="background: white">
        <div class="container">
            <section>
                <table class="table table-condensed" style="color:grey">
                    <thead>
                    <tr>
                        <th style="font-weight: 600; font-size: 14px!important;">Posicion</th>
                        <th style="font-weight: 600; font-size: 14px!important;">Corredor</th>
                        <th style="font-weight: 600; font-size: 14px!important;">Carrera</th>
                        <th style="font-weight: 600; font-size: 14px!important;">Categoria</th>
                        <th style="font-weight: 600; font-size: 14px!important;">Tiempo</th>
                    </tr>


                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><span class="numero">#333</span> <strong class="nombre">Martina Diaz</strong></td>
                            <td>5KM</td>
                            <td>5KM 18 A 29</td>
                            <td class="tiempo">00:24:30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><span class="numero">#333</span> <strong class="nombre">Martina Diaz</strong></td>
                            <td>5KM</td>
                            <td>5KM 18 A 29</td>
                            <td class="tiempo">00:24:30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><span class="numero">#333</span> <strong class="nombre">Martina Diaz</strong></td>
                            <td>5KM</td>
                            <td>5KM 18 A 29</td>
                            <td class="tiempo">00:24:30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><span class="numero">#333</span> <strong class="nombre">Martina Diaz</strong></td>
                            <td>5KM</td>
                            <td>5KM 18 A 29</td>
                            <td class="tiempo">00:24:30</td>
                        </tr>
                    </tbody>

                </table>
            </section>

        </div>

    </div>






    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>