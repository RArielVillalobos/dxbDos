<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl . "/css/main.css"?>">
    <title>DXB</title>
</head>
<body data-spy="scroll" data-target="#navbar" data-offset="87">
<!--HEADER -->
<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?php echo Yii::$app->request->baseUrl . "/images/logo.png"?>" alt="logo-unco">

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#main">Sobre la app</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#eventos">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <?php
                     if(Yii::$app->user->isGuest){
                         ?>
                         <a class="nav-link" target="_blank" href="index.php?r=site%2Flogin">Iniciar Sesión</a>

                    <?php
                     }

                    ?>


                </li>



            </ul>

        </div>
    </div>
</nav>
<!--END HEADER-->
<!--MAIN-->
<sectiion id="main">

    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo Yii::$app->request->baseUrl . "/images/carousel/8.jpg"?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo Yii::$app->request->baseUrl . "/images/carousel/dxb.jpg"?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo Yii::$app->request->baseUrl . "/images/carousel/5.jpg"?>" class=" d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo Yii::$app->request->baseUrl . "/images/carousel/7.jpg"?>" class=" d-block w-100" alt="...">
            </div>
            <div class="overlay">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 offset-md-6 text-center text-md-right">
                            <h1>DXB</h1>
                            <p class="d-none d-md-block">Aplicación móvil para cronometrar eventos deportivos</p>
                            <a href="#contacto" class="btn btn-outline-light">Quiero usarla</a>

                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>
</sectiion>
<!--END MAIN-->
<!-- EVENTOS -->
<section id="eventos" class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col text-center text-uppercase">
                <small>Ellos  usaron dxb</small>
                <h2>Eventos</h2>
            </div>

        </div>
        <div class="row">
            <?php
             foreach ($eventos as $evento){
                 ?>
                 <div class="col-md-4 mb-4">
                     <div class="card">
                         <img style="object-fit: cover;" height="204px" width="348px" src="<?php echo ($evento->imagen) ? Yii::$app->request->baseUrl . "/images/".$evento->imagen :Yii::$app->request->baseUrl . "/images/nopic.jpg" ?>" class="card-img-top" alt="...">
                         <div class="card-body">
                             <h5 class="card-title mb-0"><?php echo $evento->nombre; ?></h5>
                             <!--
                             <div class="badges">
                                 <span class="badge badge-warning">JS</span>
                                 <span class="badge badge-info">REACT</span>

                             </div>
                             -->

                             <p class="card-text"></p>
                             <a target="_blank" href="<?php echo "resultado?evento=". $evento->idEvento;?>"class="btn btn-dark">Ver Resultados</a>
                         </div>
                     </div>
                 </div>
            <?php
             }
            ?>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo Yii::$app->request->baseUrl . "/images/dxb.png"?>" style="object-fit: cover;" height="204px" width="348px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-0">DESAFIO X BARDAS 2019</h5>
                        <p class="card-text"></p>
                        <a target="_blank" href="https://dxb.fi.uncoma.edu.ar/dxb2019/index.php?r=result%2Fresultados" class="btn btn-dark">Ver Resultados</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
<!--END EVENTOS-->

<!--CONSULTAS-->
<section id="contacto" class="pt-3 pb-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-uppercase text-center">Contacto</small>

            </div>

        </div>
        <div class="row">
            <div class="col text-center">
                Consultas sobre la aplicación
            </div>


        </div>
        <div class="row">
            <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2 pt-2">
                <form>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <textarea name="text" class="form-control form-control-lg" placeholder="Escribe tu consulta"></textarea>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <button type="button" class="btn btn-dark btn-block">Enviar</button>
                        </div>


                    </div>

                </form>

            </div>

        </div>


    </div>

</section>
<!--END CONSULTAS-->


<!-- FOOOTER -->
<footer id="footer" class="pb-4 pt-4">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 col-lg">
                <a href="#">Preguntas frecuentes</a>
            </div>
            <div class="col-12 col-lg">
                <a href="#">Licencia</a>
            </div>
            <div class="col-12 col-lg">
                <a href="#">Terminos y Condiciones</a>
            </div>

        </div>

    </div>

</footer>
<!-- END FOOTER -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>

