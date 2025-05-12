<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="../assets/css/cadastro.css">
</head>
<body>
  <main class="login-main">
    <div class="login-wrapper">
      <div class="login-box">
        <h2>Cadastro de Usuário</h2>
<form action="../actions/processa_cadastro.php" method="POST" class="form-login" id="formCadastro" onsubmit="return validarFormulario();">
  <input type="text" name="nome" placeholder="Nome" required pattern="[A-Za-zÀ-ÿ\s]+" title="Apenas letras">
  <input type="text" name="sobrenome" placeholder="Sobrenome" required pattern="[A-Za-zÀ-ÿ\s]+" title="Apenas letras">
  <input type="tel" name="telefone" placeholder="Telefone (9 dígitos)" required pattern="\d{9}" title="Digite exatamente 9 números">
  <input type="email" name="email" placeholder="E-mail" required>
  <input type="password" name="senha" placeholder="Senha" required>
  <input type="date" name="data_nascimento" required>
  <input type="text" name="endereco" placeholder="Endereço completo" required>

  <select name="plano" required>
    <option value="">Selecione um plano</option>
    <option value="basic">Basic</option>
    <option value="plus">Plus</option>
    <option value="premium">Premium</option>
  </select>

  <button type="submit">Cadastrar</button>
</form>
  </div>
      <div class="back-home">
        <a href="login.php" class="btn-voltar">← Voltar ao Login</a>
      </div>
    </div>
  </main>
  <script src="../assets/js/validacaoCadastro.js"></script>
</body>
</html>
