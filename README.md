# projeto_master_git
# Sistema de Gestão para Clínica de Saúde

Este é um sistema web desenvolvido em PHP com MySQL para gestão de uma clínica de saúde. O projeto permite que usuários realizem cadastro, login, marquem consultas, visualizem notícias, e que administradores tenham acesso a funcionalidades completas de gerenciamento.

## 🔧 Tecnologias Utilizadas

- HTML, CSS, JavaScript, AJAX  
- PHP (procedural)  
- MySQL  
- Bootstrap  
- OpenStreetMap API (localização)  
- RSS para exibição de notícias

## 🎯 Funcionalidades Principais

### Área do Cliente:
- Cadastro e login de usuários  
- Marcação e cancelamento de consultas  
- Visualização de mensagens e status de agendamentos  

### Área do Administrador:
- Login administrativo  
- Visualização, edição e exclusão de cadastros de clientes  
- Gestão de consultas (visualizar e cancelar)  
- Administração de notícias (inserir, remover e gerenciar links RSS)  

### Página Inicial:
- Login para cliente e administrador  
- Exibição de até 6 notícias via RSS  
- Localização da clínica integrada com mapa  
- Carrossel de planos de saúde (usando Bootstrap)

## ⚙️ Como Usar

1. Clone ou baixe este repositório.  
2. Coloque os arquivos na pasta `htdocs` do XAMPP.  
3. Importe o banco de dados `clinica_db.sql`, disponível na pasta `/database`, pelo phpMyAdmin.  
4. Atualize as credenciais de acesso ao banco no arquivo de conexão.  
5. Acesse `localhost/nome-do-projeto` pelo navegador.

## 📌 Observações

- O projeto utiliza sessões para controle de acesso.  
- O administrador pode cancelar consultas e elas desaparecem da área do usuário.  
- Notícias são carregadas de forma dinâmica via RSS.  
- Layout responsivo com Bootstrap e design limpo.

## 👤 Autor

Desenvolvido por Bruno Moscoso  
📧 brunomoscosorodrigues@gmail.com  
🔗 www.linkedin.com/in/bruno-moscoso
