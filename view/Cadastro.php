<?php
$Cadastro = $_GET['t'];
require_once "../controller/connection/connection.php";
require_once "../controller/crud/select.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro <?php echo $Cadastro ?></title>
    <?php require_once "../includes/head.php" ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s12"><a class="black-text text-black" href="index.php">Voltar</a></li>
                </ul>
            </div>
            <div class="col s12">
                <br><br>
                <ul class="tabs">
                    <li class="tab col s12">
                        <h2 class="tab col s12">Cadastro de <?php echo $Cadastro ?></h2>
                    </li>
                </ul>
                <br><br>
            </div>
        </div>
        <div class="row">
            <form action="" method="POST" class="col s12">
                <?php

                if ($Cadastro == "Paciente") { ?>

                    <div class="row">
                        <input type="hidden" name="Paciente">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input maxlength="20" required id="Nome" type="text" name="Nome" class="validate">
                            <label for="Nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">exposure</i>
                            <input required id="Idade" type="number" name="Idade" class="idade validate">
                            <label for="Idade">Idade</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input maxlength="15" required id="Telefone" name="Telefone" type="text" class="validate">
                            <label for="Telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <p>
                                <i class="material-icons prefix">event_note</i>
                                <label>
                                    <input name="Plano" value="Básico" type="radio" checked />
                                    <span>Básico</span>
                                </label>
                                <label>
                                    <input name="Plano" value="Premium" type="radio" />
                                    <span>Premium</span>
                                </label>
                            </p>
                        </div>
                    </div>

                <?php } elseif ($Cadastro == "Médico") { ?>

                    <div class="row">
                        <input type="hidden" name="Médico">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input maxlength="20" required id="icon_prefix" name="Nome" type="text" class="validate">
                            <label for="icon_prefix">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">business_center</i>
                            <input maxlength="20" required id="Especia" name="Especialidade" type="text" class="validate">
                            <label for="Especia">Especialidade</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input required id="Telefone" type="tel" name="Telefone" class="validate">
                            <label for="Telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input required id="CRM" type="number" name="CRM" max="999999999" class="validate">
                            <label for="CRM">CRM</label>
                        </div>
                    </div>

                <?php } elseif ($Cadastro == "Consulta") { ?>

                    <div class="row">
                        <input type="hidden" name="Consulta">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">event</i>
                            <input required id="Data" type="date" name="Data" class="validate">
                            <label for="Data">Data</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">access_time</i>
                            <input required id="Hora" type="time" name="Hora" class="idade validate">
                            <label for="hora">Hora</label>
                        </div>
                        <div class="input-field col s6">
                            <p><label>Pacientes Cadastrados</label></p>
                            <select name="fkP" required class="browser-default">
                                <option value="" disabled selected>Choose your option</option>
                                <?php 

                                    $Conexao = Connection::conectar();
                                    $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $Selecionar = new Select();
                                    $Selecionar->setPacienteAll("id,nome");
                                    $Query = $Conexao->prepare($Selecionar->get());
                                    $Query->execute();
                    
                                    while ($row = $Query->fetch(PDO::FETCH_OBJ)) {
                                        echo "<option value='$row->id'>$row->nome</option>";
                                    }
                                    Connection::desconectar()
                                
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <p><label>Médicos Cadastrados</label></p>
                            <select name="fkM" required class="browser-default">
                                <option value="" disabled selected>Choose your option</option>
                                <?php 

                                    $Conexao = Connection::conectar();
                                    $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $Selecionar = new Select();
                                    $Selecionar->setMedicoAll("id,nome");
                                    $Query = $Conexao->prepare($Selecionar->get());
                                    $Query->execute();

                                    while ($row = $Query->fetch(PDO::FETCH_OBJ)) {
                                        echo "<option value='$row->id'>$row->nome</option>";
                                    }
                                    Connection::desconectar()
                                
                                ?>
                            </select>
                        </div>
                    </div>

                <?php } else {
                    header("location: index.php");
                }

                ?>
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s12">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Cadastar</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <?php
    require_once "../controller/connection/connection.php";
    require_once "../controller/crud/insert.php";

    if (isset($_POST['Paciente'])) {

        $Nome = $_POST['Nome'];
        $Idade = $_POST['Idade'];
        $Telefone = $_POST['Telefone'];
        $Plano = $_POST['Plano'];

        $Conexao = Connection::conectar();
        $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Cadastro = new Insert();
        $Cadastro->setPaciente("'$Nome','$Idade','$Telefone','$Plano'");
        $Query = $Conexao->prepare($Cadastro->get());
        $Query->execute();
        Connection::Desconectar(); ?>
        <script>
            window.alert('Cadastro Realizado');
            window.location.href='Pacientes.php';
        </script>
    <?php
    exit;

    } elseif (isset($_POST['Médico'])) {

        $Nome = $_POST['Nome'];
        $Especialidade = $_POST['Especialidade'];
        $Telefone = $_POST['Telefone'];
        $CRM = $_POST['CRM'];

        $Conexao = Connection::conectar();
        $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Cadastro = new Insert();
        $Cadastro->setMedico("'$Nome','$Especialidade','$Telefone','$CRM'");
        $Query = $Conexao->prepare($Cadastro->get());
        $Query->execute();
        Connection::Desconectar(); ?>
        <script>
            window.alert('Cadastro Realizado');
            window.location.href='Medicos.php';
        </script>

    <?php
    exit;
    
    } elseif (isset($_POST['Consulta'])) {

        $Data = $_POST['Data'];
        $Hora = $_POST['Hora'];
        $Medico = $_POST['fkM'];
        $Paciente = $_POST['fkP'];

        $Conexao = Connection::conectar();
        $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Cadastro = new Insert();
        $Cadastro->setConsulta("'$Data','$Hora','$Paciente','$Medico'");
        $Query = $Conexao->prepare($Cadastro->get());
        $Query->execute();
        Connection::Desconectar(); ?>
        <script>
            window.alert('Cadastro Realizado');
            window.location.href='index.php';
        </script>

    <?php
    exit;
    }
    ?>
</body>

</html>