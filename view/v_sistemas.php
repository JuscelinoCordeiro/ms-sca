<?php
    require_once '../classes/Sistemas.php';

    $objSistema = new Sistemas();

    $sistemas = $objSistema->getSistemas();
//    print_r($sistemas);
?>
<style type="text/css">
   /* .modal-dialog {
        width: 50%;
    }
*/
.modal-body > input{
    width: 100%;
}
    .input-modal{
        width: 90%;
    }

</style>
<div>
    <!--<a class="pull-right bnt btn-success btn-xs" href="#">Cadastrar</a>-->
    <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#cadastrarSistema">Cadastrar</button>
    <table class="table-bordered table table-condensed">
        <tr>
            <th>ID</th>
            <th>SISTEMA</th>
            <th>DESCRIÇÃO</th>
            <th>STATUS</th>
            <th>AÇÃO</th>
        </tr>

        <?php
            foreach ($sistemas as $s) {
//                print_r($s);
                echo '<tr>';
                echo '<td>' . $s->ID . '</td>';
                echo '<td>' . $s->SISTEMA . '</td>';
                echo '<td>' . $s->DESCRICAO . '</td>';
                echo '<td>';
                if ($s->ATIVO == 1) {
                    echo 'ATIVO';
                } else {
                    echo 'INATIVO';
                }
                echo '</td>';
                echo '<td>';
                ?>
                <a class="btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#editarSistema">Editar</a>
                <!--<a class="btn btn-warning btn-xs" href="#" data-toggle="modal" data-target="#myModal">Mudar status</a>-->
                <?php
                echo'</td>';
                echo '</tr>';
            }
        ?>
    </table>

</div>

<!-- Modal editar sistema-->
<div class="modal fade" id="editarSistema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Sistema</h4>
            </div>
            <div class="modal-body">
                <?php
                    $sistema = $objSistema->getSistema(1);
                ?>
                <form class="" action="" method="post">
                    <div class="form-group">
                        <label for="nomeSistema">Sistema</label>
                        <input class="input-modal" type="text" name="n_sistema" id="nomeSistema" placeholder="nome do sistema" value="<?= $sistema->SISTEMA ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="descricaoSistema">Descrição</label>
                        <input class="input-modal" type="text" name="n_descricao" id="descricaoSistema" placeholder="descrição do sistema" value="<?= $sistema->DESCRICAO ?>"/>
                    </div>
                    <div class="radio  radio-inline">
                        <label class=" radio-inline">
                            <input type="radio" name="n_status" id="optionsRadios1" value="1" <?php
                                if ($sistema->ATIVO == '1') {
                                    echo 'checked';
                                }
                            ?>/>
                            Ativo
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <label class=" radio-inline">
                            <input type="radio" name="n_status" id="optionsRadios2" value="0" <?php
                                if ($sistema->ATIVO == '0') {
                                    echo 'checked';
                                }
                            ?>/>
                            Inativo
                        </label>
                    </div>
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-sm pull-right"/>
                    <input type="hidden" name="n_id" value="<?= $sistema->ID ?>"/>
                    <input type="hidden" name="acao" value="editarSistema"/>
                </form>
                <?php
                    if (isset($_POST) && ($_POST['acao'] == 'editarSistema')) {
                        $dados['sistema'] = $_POST['n_sistema'];
                        $dados['descricao'] = $_POST['n_descricao'];
                        $dados['status'] = $_POST['n_status'];
                        $dados['id'] = $_POST['n_id'];
                        // $objSistema->cadastrarSistema($dados);
                        unset($_POST);
                        unset($dados);
                    }
                ?>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button> -->
                <!-- <button type="button" class="btn btn-primary btn-sm">Salvar mudanças</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal cadastrar sistema-->
<div class="modal fade" id="cadastrarSistema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">cadastrar Sistema</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label for="nomeSistema">Sistema</label>
                        <input class="input-modal" type="text" name="n_sistema" id="nomeSistema" placeholder="nome do sistema">
                    </div>
                    <div class="form-group">
                        <label for="descricaoSistema">Descrição</label>
                        <input class="input-modal" type="text" name="n_descricao" id="descricaoSistema" placeholder="descrição do sistema">
                    </div>
                    <!--                    <div class="form-group">
                                            <label for="statusSistema">STATUS</label>
                                            <select class="form-control" name="n_status">
                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select>
                                        </div>-->
                    <div class="radio  radio-inline">
                        <label class=" radio-inline">
                            <input type="radio" name="n_status" id="optionsRadios1" value="1" checked>
                            Ativo
                        </label>
                    <!-- </div> -->
                 <!--    <div class="radio radio-inline"> -->
                        <label class=" radio-inline">
                            <input type="radio" name="n_status" id="optionsRadios2" value="0">
                            Inativo
                        </label>
                    </div>
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-sm pull-right"/>
                    <input type="hidden" name="acao" value="cadastrarSistema"/>
                </form>
                <?php
                    if (isset($_POST) && ($_POST['acao'] == 'cadastrarSistema')) {
                        $dados['sistema'] = $_POST['n_sistema'];
                        $dados['descricao'] = $_POST['n_descricao'];
                        $dados['status'] = $_POST['n_status'];
                        $objSistema->cadastrarSistema($dados);
                        unset($_POST);
                        unset($dados);
                    }
                ?>
            </div>
            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary btn-sm">Salvar mudanças</button>-->
            </div>
        </div>
    </div>
</div>

