<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Clínica Saúde</title>
  <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
  <main class="login-main">
    <div class="login-wrapper">
      <div class="login-box">
        <h2>Área de Acesso</h2>

        <div class="form-area">
          <form action="../actions/processa_login_usuario.php" method="POST" class="form-login">
            <h3>Login do Usuário</h3>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <p class="link-cadastro">
                Não tem uma conta? <a href="cadastro.php">Cadastrar-se</a>
            </p>
          </form>

          <form action="../actions/processa_login_admin.php" method="POST" class="form-login">
            <h3>Login do Administrador</h3>
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
          </form>
        </div>
      </div>

      <div class="back-home">
        <a href="index.php" class="btn-voltar">← Voltar para a Página Inicial</a>
      </div>
    </div>
  </main>
</body>
</html>
