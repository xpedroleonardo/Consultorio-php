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
                    <img src="../assets/img/undraw_events_2p66.svg">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <p>Cadasdre as consultas para que fique registrado no sistema, assim terá como você vizualizar a data da consulta, a hora, o paciente e o médico que irá realizar esssa consulta.</p>
                    </div>
                    <div class="card-action">
                        <a class="black-text text-black" href="./Cadastro.php?t=Consulta">Cadastar Consulta</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <?php
                require_once "../controller/connection/connection.php";
                require_once "../controller/crud/select.php";

                $head = 0;

                $Conexao = Connection::conectar();
                $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $Selecionar = new Select();
                $Selecionar->setConsultaAll("*");
                $Query = $Conexao->prepare($Selecionar->get());
                $Query->execute();

                while ($row = $Query->fetch(PDO::FETCH_OBJ)) {

                    if ($head == 0) {
                        echo "
                        <ul class='tabs'>
                            <li class='tab col s12 text-black'><a class='black-text text-black'>Consultas Cadastradas</a></li>
                        </ul>
                        <table>
                            <tr>
                                <td>id</td>
                                <td>Data</td>
                                <td>Hora</td>
                                <td>Paciente</td>
                                <td>Médico</td>
                                <td>Ação</td>
                            </tr>";
                        $head = 1;
                    }

                    
                    $Inner = new Select();
                    $Inner->setInner("M.nome AS NM,P.nome AS NP","'$row->id'");
                    $QueryInner = $Conexao->prepare($Inner->get());
                    $QueryInner->execute();
                    $Nomes = $QueryInner->fetch(PDO::FETCH_OBJ);
                    
                    $dia = explode("-", $row->dia);

                    echo "
                    <tr>
                        <td>" . $row->id . "</td>
                        <td>$dia[2]/$dia[1]/$dia[0]</td>
                        <td>" . $row->hora . "</td>
                        <td>" . $Nomes->NP . "</td>
                        <td>" . $Nomes->NM . "</td>
                        <td>
                        <form action='' method='post'>
                            <a href='Editar.php?t=Consulta&&i=$row->id'><i style='margin-right: 10px !important;' class='material-icons'>create</i></a>
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
                                    <p>Não existe nenhum registro, depois que cadastrar consultas elas aparecerão aqui.</p>
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
    require_once "../controller/crud/delete.php";

    if (isset($_POST['Apagar'])) {

        $id = $_POST['Apagar'];

        $Conexao = Connection::conectar();
        $Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Apagar = new Delete();
        $Apagar->setConsulta("'$id'");
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