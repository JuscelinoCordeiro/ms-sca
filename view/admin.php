<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <title>Administração SCA</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js" ></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <style>
            .meuModal{
                width: 500px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="height: 120px">
                <div class="col-md-12">Cabecalho</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#sistema" aria-controls="sistema" role="tab" data-toggle="tab">Sistema</a></li>
                            <li role="presentation"><a href="#perfil" aria-controls="perfil" role="tab" data-toggle="tab">Perfil</a></li>
                            <li role="presentation"><a href="#sistema_perfil" aria-controls="sistema_perfil" role="tab" data-toggle="tab">Sistema-Perfil</a></li>
                            <li role="presentation"><a href="#usuario" aria-controls="usuario" role="tab" data-toggle="tab">Usuario</a></li>
                            <li role="presentation"><a href="#usuario_perfil" aria-controls="usuario_perfil" role="tab" data-toggle="tab">Usuario-Perfil</a></li>
                            <li role="presentation"><a href="#usuario_sistema" aria-controls="usuario_sistema" role="tab" data-toggle="tab">Usuario-Sistema</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="sistema">
                                <h2 class="text text-center">Sistemas</h2>
                                <?php
//                                    echo 'Sistemas';
                                    include 'v_sistemas.php';
                                ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="perfil">...perfil</div>
                            <div role="tabpanel" class="tab-pane" id="sistema_perfil">...sistema_perfil</div>
                            <div role="tabpanel" class="tab-pane" id="usuario">...usuario</div>
                            <div role="tabpanel" class="tab-pane" id="usuario_perfil">...usuario_perfil</div>
                            <div role="tabpanel" class="tab-pane" id="usuario_sistema">...usuario_sistema</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <?php
            // put your code here
        ?>
    </body>
</html>
<!--<script>
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
</script>-->
