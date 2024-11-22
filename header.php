<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluindo o Font Awesome para os ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Cabeçalho -->
    <header class="bg-info d-flex align-items-center" style="height: 3cm;">
        <div class="container d-flex justify-content-between align-items-center w-100">
            <!-- Título do sistema e link de produtos alinhados à esquerda -->
            <div class="d-flex align-items-center">
                <h1 class="text-white mb-0 mr-3">Sistema E-commerce</h1>
            </div>

            <!-- Botão de Logout alinhado à direita -->
            <form method="POST" action="logout.php" class="mb-0">
                <button class="btn btn-link nav-link text-white" name="logout" type="submit" style="text-decoration: none;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg p-0 navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="principal.php">Home</a>
            <a class="navbar-brand" href="usuarios_cadastro.php">Usuários</a>
            <a class="navbar-brand" href="produtos_cadastro.php">Produtos</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- O botão de logout já está no header, então não é necessário aqui -->
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Incluindo o JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
