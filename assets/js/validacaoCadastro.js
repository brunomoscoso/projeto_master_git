function validarFormulario() {
    const nome = document.querySelector('input[name="nome"]');
    const sobrenome = document.querySelector('input[name="sobrenome"]');
    const telefone = document.querySelector('input[name="telefone"]');
    const email = document.querySelector('input[name="email"]');
  
    const regexLetras = /^[A-Za-zÀ-ÿ\s]+$/;
    const regexTelefone = /^\d{9}$/;
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (!regexLetras.test(nome.value)) {
      alert("Nome deve conter apenas letras.");
      nome.focus();
      return false;
    }
  
    if (!regexLetras.test(sobrenome.value)) {
      alert("Sobrenome deve conter apenas letras.");
      sobrenome.focus();
      return false;
    }
  
    if (!regexTelefone.test(telefone.value)) {
      alert("Telefone deve conter exatamente 9 dígitos numéricos.");
      telefone.focus();
      return false;
    }
  
    if (!regexEmail.test(email.value)) {
      alert("E-mail inválido.");
      email.focus();
      return false;
    }
  
    return true;
  }
  