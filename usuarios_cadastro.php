<?php
include 'usuarios_controller.php';
include 'header.php';

session_start();

// Verifica se o usuário está registrado na sessão (logado)
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Pega todos os usuários para preencher os dados da tabela
$users = getUsers();

// Variável que guarda o ID do usuário que será editado
$userToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e se há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $userToEdit = getUser($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <!-- Incluindo Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo Font Awesome para ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        function clearForm() {
            document.getElementById('nome').value = '';
            document.getElementById('telefone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('senha').value = '';
            document.getElementById('id').value = '';
        }
    </script>
</head>

<body>
    <div class="container mt-4">
        <!-- Exibe o nome do usuário logado -->
        <div class="d-flex justify-content-between">
            <h2>Cadastro de Usuários</h2>
            <a href="logout.php" class="btn btn-danger btn-sm align-self-center">Sair</a>
        </div>

        <form method="POST" action="" class="row g-3">
            <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">

            <div class="col-md-6">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control"
                    value="<?php echo $userToEdit['nome'] ?? ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control"
                    value="<?php echo $userToEdit['telefone'] ?? ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="<?php echo $userToEdit['email'] ?? ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>

            <div class="col-12">
                <button type="submit" name="save" class="btn btn-primary my-2">Salvar</button>
                <button type="submit" name="update" class="btn btn-secondary my-2 ml-2">Atualizar</button>
                <!-- Botão Novo com texto "Novo" e cor verde -->
                <button type="button" onclick="clearForm()" class="btn btn-success my-2 ml-2">
                    Novo
                </button>
            </div>
        </form>

        <h2 class="mt-5">Usuários Cadastrados</h2>
        <!-- Tabela de usuários com Bootstrap -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Faz um loop FOR no resultset de usuários e preenche a tabela -->
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td scope="row"><?php echo $user['id']; ?></td>
                        <td><?php echo $user['nome']; ?></td>
                        <td><?php echo $user['telefone']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="?edit=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?delete=<?php echo $user['id']; ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir?');" 
                               class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php' ?>

    <!-- Incluindo o script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
