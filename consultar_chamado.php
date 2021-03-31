<?php //copia codigo da pagina validador_acesso
require_once "validador_acesso.php";
?>

<?php


//cria um array para organizacao no futuro
$chamados = array();

//abrir o arquivo.hd
$arquivo = fopen('arquivo.hd', 'r');
//r é uma funcao apenas de leitura. consultar docmentacao php

//criar um laço de repeticao que percorre registros de chamados
//feof é uma funcao que percorre os rgistros até que acabem.
//feof vai retornar false quando nao encontrar nada na linha. mas se deixar aenas om feof já na primeira linha nao vai esar vazio e ele va retornar false. mas tem registro na primeira linha. por esse motivo coloca o operador de negacao antes (!)
while(!feof($arquivo)){
  $registro = fgets($arquivo); //pega cada registro
  $chamados[] = $registro; //coloca dentro da array
}

//fechar o arquivo aberto
  fclose($arquivo);

?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logoff.php"> SAIR </a>          
        </li>        
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
              
             <? foreach ($chamados as $chamado) { ?>

              <?php
                $chamado_dados = explode ("#", $chamado); 
                // o explode vai separar os dados e colocar em uma array

                //criar filtro se é usuario ou administrativo e executar
                if ($_SESSION['perfil_id'] == 2) {
                  //só vamos exibir o chamado se ele foi criado por administrativo
                  if ($_SESSION['id'] != $chamado_dados[0]) {
                   //se isso acontecer siginifica que o usuario nao é o correspondente, entao continue
                    continue;
                  }
                }

                //para esse if significa que se as informacoes forem menor que 3 (dados incompletos no chamado aberto) ele continua sem registrar dados
                if (count($chamado_dados) < 3) {
                  continue;
                }

                ?>
              
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?=$chamado_dados[0]?></h5>     
                  <h6 class="card-subtitle mb-2 text-muted"><?=$chamado_dados[1]?></h6>
                  <p class="card-text"><?=$chamado_dados[2]?></p>

                </div>
              </div>
              <?       } ?>


              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>