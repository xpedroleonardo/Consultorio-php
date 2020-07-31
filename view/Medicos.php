<?php 
    require_once "../controller/connection/connection.php";
    require_once "../controller/crud/select.php";
    require_once "../controller/crud/delete.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Médica</title>
    <?php require_once "../includes/head.php" ?>
</head>

<body>
    <div class="container">
        <?php require_once "../includes/nav.php" ?>
        <div class="col s12 m7">
            <div class="card horizontal">
                <div style="margin: 40px;" class="card-image">
                    <img src="../assets/img/undraw_medicine_b1ol.svg">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <p>Cadastre os médicos aqui, para que depois você marque consultas com esse mádico cadastrado.</p>
                    </div>
                    <div class="card-action">
                        <a class="black-text text-black" href="Cadastro.php?t=Médico">Cadastar Médico</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <?php

                $head = 0;

                $Conexao = Connection::conectar();
                $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $Selecionar = new Select();
                $Selecionar->setMedicoAll("*");
                $Query = $Conexao->prepare($Selecionar->get());
                $Query->execute();

                while ($row = $Query->fetch(PDO::FETCH_OBJ)) {

                    if ($head == 0) {
                        echo "
                        <ul class='tabs'>
                            <li class='tab col s12 text-black'><a class='black-text text-black'>Médicos Cadastrados</a></li>
                        </ul>
                        <table>
                            <tr>
                                <td>id</td>
                                <td>Nome</td>
                                <td>Especialidade</td>
                                <td>Telefone</td>
                                <td>CRM</td>
                                <td>Ação</td>
                        </tr>";
                        $head = 1;
                    }

                    echo "
                        <tr>
                            <td>" . $row->id . "</td>
                            <td>" . $row->nome . "</td>
                            <td>" . $row->especialidade . "</td>
                            <td>" . $row->telefone . "</td>
                            <td>" . $row->crm . "</td>
                            <td>
                            <form action='' method='post'>
                                <a href='Editar.php?t=Médico&&i=$row->id'><i style='margin-right: 10px !important;' class='material-icons'>create</i></a>
                                    <input type='hidden' name='Apagar' value='$row->id'>
                                    <button style='margin-left: 10px !important;background: transparent;border: none !important;cursor:pointer;' class='material-icons red-text text-accent-3'>delete</button>
                                </form>
                            </td>
                        </tr>
                        ";
                    }
                    
                if ($head == 0) { ?>

                    <div class="col s12">
                        <div class="card horizontal">
                            <div style="margin: 40px;width: 200px;" class="card-image">
                                <img src="../assets/img/undraw_no_data_qbuo.svg">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p>Não existe nenhum registro, depois que cadastrar médicos eles aparecerão aqui.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                Connection::desconectar();
                ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <?php

    if (isset($_POST['Apagar'])) {

        $id = $_POST['Apagar'];

        $Conexao = Connection::conectar();
        $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Selecionar = new Select();
        $Selecionar->setConsulta("id", "fkMedico = '$id'");
        $Query = $Conexao->prepare($Selecionar->get());
        $Query->execute();
        $Campos = $Query->fetch(PDO::FETCH_OBJ);
        
        $Apagar = new Delete();
        $Apagar->setConsulta("'$Campos->id'");
        $Query = $Conexao->prepare($Apagar->get());
        $Query->execute();
        
        $Apagar->setMedico("'$id'");
        $Query = $Conexao->prepare($Apagar->get());
        $Query->execute();

        Connection::desconectar(); ?>

        <script>
            window.alert('Apagado com Sucesso');
            window.location.href = 'Medicos.php';
        </script>

    <?php
    }
    ?>
</body>

</html>