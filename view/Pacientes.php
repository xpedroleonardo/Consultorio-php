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
                    <img src="../assets/img/undraw_personal_information_962o.svg">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <p>Cadastre os pacientes aqui, para depois você poder marcar consultas com esse paciente cadastrado.</p>
                    </div>
                    <div class="card-action">
                        <a class="black-text text-black" href="Cadastro.php?t=Paciente">Cadastar Paciente</a>
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
                $Selecionar->setPacienteAll("*");
                $Query = $Conexao->prepare($Selecionar->get());
                $Query->execute();

                while ($row = $Query->fetch(PDO::FETCH_OBJ)) {

                    if ($head == 0) {
                        echo "
                            <ul class='tabs'>
                                <li class='tab col s12 text-black'><a class='black-text text-black'>Pacientes Cadastrados</a></li>
                            </ul>
                            <table>
                                <tr>
                                    <td>id</td>
                                    <td>Nome</td>
                                    <td>Idade</td>
                                    <td>Plano</td>
                                    <td>Telefone</td>
                                    <td>Ação</td>
                                </tr>";
                        $head = 1;
                    }

                    echo "
                            <tr>
                                <td>" . $row->id . "</td>
                                <td>" . $row->nome . "</td>
                                <td>" . $row->idade . "</td>
                                <td>" . $row->plano . "</td>
                                <td>" . $row->telefone . "</td>
                                <td>
                                    <form action='' method='post'>
                                        <a href='Editar.php?t=Paciente&&i=$row->id'><i style='margin-right: 10px !important;' class='material-icons'>create</i></a>
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
                                    <p>Não existe nenhum registro, depois que cadastrar pacientes eles aparecerão aqui.</p>
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
        $Selecionar->setConsulta("id", "fkPaciente = '$id'");
        $Query = $Conexao->prepare($Selecionar->get());
        $Query->execute();
        $Campos = $Query->fetch(PDO::FETCH_OBJ);
        
        $Apagar = new Delete();
        $Apagar->setConsulta("'$Campos->id'");
        $Query = $Conexao->prepare($Apagar->get());
        $Query->execute();

        $Apagar->setPaciente("'$id'");
        $Query = $Conexao->prepare($Apagar->get());
        $Query->execute();
        Connection::desconectar(); ?>

        <script>
            window.alert('Apagado com Sucesso');
            window.location.href = 'Pacientes.php';
        </script>

    <?php
    }
    ?>
</body>

</html>