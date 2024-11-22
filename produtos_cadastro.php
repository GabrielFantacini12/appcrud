<?php
session_start(); // Inicia a sessão

// Verifique se o arquivo 'produtos_controller.php' existe no diretório correto
if (file_exists('produtos_controller.php')) {
    include 'produtos_controller.php';
} else {
    echo "Arquivo 'produtos_controller.php' não encontrado!";
    exit;
}
include 'header.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) { // Alterado para verificar se o email do usuário está na sessão
    echo "<script>alert('Por favor, faça login para acessar esta página.'); window.location.href = 'index.php';</script>";
    exit();
}

// Pega todos os produtos para preencher os dados da tabela
$products = getProducts();

// Variável que guarda o ID do produto que será editado
$productToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e se há um ID para edição de produto
if (isset($_GET['edit'])) {
    $productToEdit = getProduct($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD de Produtos</title>
<!-- Adicionando o link para o Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
function clearForm() {
    document.getElementById('nome').value = '';
    document.getElementById('descricao').value = '';
    document.getElementById('marca').value = '';
    document.getElementById('modelo').value = '';
    document.getElementById('valorunitario').value = '';
    document.getElementById('categoria').value = '';
    document.getElementById('url_img').value = '';
    document.getElementById('ativo').checked = true;
    document.getElementById('id').value = '';
}
</script>
</head>
<body>
<div class="container mt-4">
    <h2>Cadastro de Produtos</h2>
    <form method="POST" action="" class="mb-4" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?php echo $productToEdit['id'] ?? ''; ?>">

        <!-- Form fields -->

        <div class="mb-3">
            <button type="submit" name="save" class="btn btn-primary">Salvar</button>
            <button type="submit" name="update" class="btn btn-warning">Atualizar</button>
            <button type="button" onclick="clearForm()" class="btn btn-secondary">Novo</button>
        </div>
    </form>

    <!-- Products table -->
    <h2>Produtos Cadastrados</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descricao</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>ValorUnitario</th>
                <th>Categoria</th>
                <th>Ativo</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Faz um loop FOR no resultset de produtos e preenche a tabela -->
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['nome']; ?></td>
                    <td><?php echo $product['descricao']; ?></td>
                    <td><?php echo $product['marca']; ?></td>
                    <td><?php echo $product['modelo']; ?></td>
                    <td><?php echo $product['valorunitario']; ?></td>
                    <td><?php echo $product['categoria']; ?></td>
                    <td><?php echo $product['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                    <td>
                        <?php if (!empty($product['url_img'])): ?>
                            <img src="<?php echo $product['url_img']; ?>" alt="Imagem do Produto" style="max-width: 100px;">
                        <?php else: ?>
                            <span>Sem Imagem</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="?edit=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?delete=<?php echo $product['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>
