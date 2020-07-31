<?php
$Editar = $_GET['t'];
$id = addslashes($_GET['i']);

require_once "../controller/connection/connection.php";
require_once "../controller/crud/select.php";
require_once "../controller/crud/update.php"

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $Editar ?></title>
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
                        <h2 class="tab col s12">Atualizar <?php echo $Editar ?></h2>
                    </li>
                </ul>
                <br><br>
            </div>
        </div>
        <div class="row">
            <form action="" method="POST" class="col s12">
                <?php

                if ($Editar == "Paciente") {

                    $Conexao = Connection::conectar();
                    $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $Selecionar = new Select();
                    $Selecionar->setPaciente("nome,idade,telefone,plano", "'$id'");
                    $Query = $Conexao->prepare($Selecionar->get());
                    $Query->execute();
                    $Campos = $Query->fetch(PDO::FETCH_OBJ);

                    if (empty($Campos->nome)) {
                        header("location: index.php");
                    }
                ?>

                    <div class="row">
                        <input type="hidden" name="Paciente">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input maxlength="20" required id="Nome" value="<?php echo $Campos->nome ?>" type="text" name="Nome" class="validate">
                            <label for="Nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">exposure</i>
                            <input required id="Idade" value="<?php echo $Campos->idade ?>" type="number" name="Idade" class="idade validate">
                            <label for="Idade">Idade</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input maxlength="15" value="<?php echo $Campos->telefone ?>" required id="Telefone" name="Telefone" type="text" class="validate">
                            <label for="Telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <p>
                                <i class="material-icons prefix">event_note</i>
                                <label>
                                    <input name="Plano" value="Básico" type="radio" <?php echo ($Campos->plano == 'Básico') ? 'checked' : '' ?> />
                                    <span>Básico</span>
                                </label>
                                <label>
                                    <input name="Plano" value="Premium" type="radio" <?php echo ($Campos->plano == 'Premium') ? 'checked' : '' ?> />
                                    <span>Premium</span>
                                </label>
                            </p>
                        </div>
                    </div>

                <?php } elseif ($Editar == "Médico") {

                    $Conexao = Connection::conectar();
                    $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $Selecionar = new Select();
                    $Selecionar->setMedico("nome,especialidade,telefone,crm", "'$id'");
                    $Query = $Conexao->prepare($Selecionar->get());
                    $Query->execute();
                    $Campos = $Query->fetch(PDO::FETCH_OBJ);

                    if (empty($Campos->nome)) {
                        header("location: index.php");
                    }

                ?>

                    <div class="row">
                        <input type="hidden" name="Médico">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input maxlength="20" required value="<?php echo $Campos->nome ?>" id="icon_prefix" name="Nome" type="text" class="validate">
                            <label for="icon_prefix">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">business_center</i>
                            <input maxlength="20" required id="Especia" value="<?php echo $Campos->especialidade ?>" name="Especialidade" type="text" class="validate">
                            <label for="Especia">Especialidade</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input required id="Telefone" value="<?php echo $Campos->telefone ?>" type="tel" name="Telefone" class="validate">
                            <label for="Telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input required id="CRM" value="<?php echo $Campos->crm ?>" type="number" name="CRM" max="999999999" class="validate">
                            <label for="CRM">CRM</label>
                        </div>
                    </div>

                <?php } elseif ($Editar == "Consulta") {

                    $Conexao = Connection::conectar();
                    $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $Selecionar = new Select();
                    $Selecionar->setConsulta("dia,hora,fkPaciente,fkMedico", "id = '$id'");
                    $Query = $Conexao->prepare($Selecionar->get());
                    $Query->execute();
                    $Campos = $Query->fetch(PDO::FETCH_OBJ);

                ?>

                    <div class="row">
                        <input type="hidden" name="Consulta">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">event</i>
                            <input required id="Data" value="<?php echo $Campos->dia ?>" type="date" name="Data" class="validate">
                            <label for="Data">Data</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">access_time</i>
                            <input required id="Hora" value="<?php echo $Campos->hora ?>" type="time" name="Hora" class="idade validate">
                            <label for="hora">Hora</label>
                        </div>
                        <div class="input-field col s6">
                            <p><label>Pacientes Cadastrados</label></p>
                            <select name="fkP" required class="browser-default">
                                <option value="" disabled >Choose your option</option>
                                <?php 

                                    $Conexao = Connection::conectar();
                                    $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $Selecionar = new Select();
                                    $Selecionar->setPacienteAll("id,nome");
                                    $Query = $Conexao->prepare($Selecionar->get());
                                    $Query->execute();
                    
                                    while ($row = $Query->fetch(PDO::FETCH_OBJ)) {?>

                                        <option <?php echo ($row->id == $Campos->fkPaciente) ? "selected" : "" ; ?> value='<?php echo $row->id ?>'><?php echo $row->nome ?></option>

                                        <?php
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

                                    while ($row = $Query->fetch(PDO::FETCH_OBJ)) {?>

                                        <option <?php echo ($row->id == $Campos->fkMedico) ? "selected" : "" ; ?> value='<?php echo $row->id ?>'><?php echo $row->nome ?></option>

                                        <?php
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
                                <button class="btn waves-effect waves-light" type="submit" name="action">Atualizar</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <?php

    if (isset($_POST['Paciente'])) {

        $Nome = $_POST['Nome'];
        $Idade = $_POST['Idade'];
        $Telefone = $_POST['Telefone'];
        $Plano = $_POST['Plano'];

        $Conexao = Connection::conectar();
        $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Atualiza = new Update();
        $Atualiza->setPaciente("nome='$Nome',idade='$Idade',telefone='$Telefone',plano='$Plano'","'$id'");
        $Query = $Conexao->prepare($Atualiza->get());
        $Query->execute();
        Connection::Desconectar(); ?>
        <script>
            window.alert('Atualização Realizada');
            window.location.href = 'Pacientes.php';
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
        $Atualiza = new Update();
        $Atualiza->setMedico("nome='$Nome',especialidade='$Especialidade',telefone='$Telefone',crm='$CRM'","'$id'");
        $Query = $Conexao->prepare($Atualiza->get());
        $Query->execute();
        Connection::Desconectar(); ?>
        <script>
            window.alert('Atualização Realizada');
            window.location.href = 'Medicos.php';
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
        $Atualiza = new Update();
        $Atualiza->setConsulta("dia='$Data',hora='$Hora',fkPaciente='$Paciente',fkMedico='$Medico'","'$id'");
        $Query = $Conexao->prepare($Atualiza->get());
        $Query->execute();
        Connection::Desconectar(); ?>
        <script>
            window.alert('Atualização Realizada');
            window.location.href='index.php';
        </script>

    <?php
    exit;
    }
    ?>
</body>

</html>