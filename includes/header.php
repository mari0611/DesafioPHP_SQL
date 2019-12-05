  


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Desafio PHP</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      
    />
    <link rel="stylesheet" href="./assets/css/styles.css">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="login.php">Desafio PHP</a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link active" href="indexProdutos.php"
                >Veja nossos produtos <span class="sr-only">(current)</span></a
              >
              <a class="nav-item nav-link active" href="createProduto.php">Adicionar produtos</a>
              <a class="nav-item nav-link active" href="createUsuario.php">Cadastrar Usuários</a>
            </div>
          </div>
          <a class="text-white" href="funcoes/logout.php">Logout</a>
        </div>
      </nav>
    </header>
  </body>
</html>