<!-- /swform/welcome.php -->
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>SW Form</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="?page=cadastro">Cadastrar escutas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=listar">Listar escutas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=receptores">Meus receptores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=antenas">Minhas antenas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=locais">Meus locais</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col mt-5">
          <?php
            $page = @$_REQUEST["page"];

            switch ($page) {
              case "cadastro":
                include("cadastro.php");
                break;
              case "listar":
                include("listar.php");
                break;
                case "receptores":
                    include("receptores.php");
                    break;
                    case "antenas":
                        include("antenas.php");
                        break;
                        case "locais":
                            include("locais.php");
                            break;
              default:
                echo "<h1>SW Form</h1><p>Esta é a plataforma de cadastro de radioescutas.<br>
                Adicione seus equipamentos, antenas e endereços antes de cadastrar suas escutas.";
                break;
            }
          ?>
          
        </p>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
