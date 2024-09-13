<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Cadastro de Pessoas</title>
        <style>
            form {
                width: fit-content;
            }
            table,
            td,
            th {
                border-collapse: collapse;
                border: 1px solid black;
                text-align: center;
            }
        </style>
    </head>

    <body>

        <form action="index.php" method="post">

            <h1>Cadastro de Pessoas</h1>

            <label>Nome: <input type = "text" name = "nome" required = "true"></label>

            </br></br>

            <label>Data de Nascimento: <input type = "date" name = "dataNasc" required = "true"></label>

            </br></br>

            <input type = "submit" value = "Cadastrar" id = "button"/> 

        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            include('conexao.php');

            date_default_timezone_set('America/Sao_Paulo');

            require_once './Pessoa.php';

            $pessoa = new Pessoa();

            $inputBirthDate = $_POST["dataNasc"];

            $birthDate = strtotime($inputBirthDate);
            $birth = date('Y/m/d', $birthDate);

            if ($birth > date('Y/m/d')) {

                echo "[ERRO] INSIRA UMA DATA VÁLIDA!";
            } else {

                $pessoa->setNome(strip_tags($_POST["nome"]));
                $pessoa->setDataNascimento($birth);
                $pessoa->calculaIdade($birthDate);
                $pessoa->calculaDias($birthDate);

                $nome = $pessoa->getNome();
                $dataNasc = $pessoa->getDataNascimento();
                $idade = $pessoa->getIdade();
                $diasAniver = $pessoa->getDiasProximoAniversario();

                mysqli_query($mysqli, "INSERT INTO pessoa (nome, dataNasc, idade, diasAniver) VALUES" . "('$nome','$dataNasc','$idade','$diasAniver')");
            }
        }
        ?>

        </br></br>

        <div id="lista">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($birth <= date('Y/m/d')) {

        $selectSQL = mysqli_query($mysqli, "SELECT id, nome, dataNasc, idade, diasAniver FROM pessoa");

        echo "<table>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Idade</th>
                            <th>Dias para o aniversário</th>
                        </tr>";

        while ($row = $selectSQL->fetch_array()) {
            echo "<tr>
                            <td>{$row['id']}</td> 
                            <td>{$row['nome']}</td>
                            <td>{$row['dataNasc']}</td> 
                            <td>{$row['idade']}</td> 
                            <td>{$row['diasAniver']}</td>
                        </tr>
                </table";
        }
    }
}
?>    

        </div>

    </body>

</html>
