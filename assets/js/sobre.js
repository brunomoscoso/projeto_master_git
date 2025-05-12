document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-sobre');
    const botao = document.getElementById('btn-sobre');
    botao.addEventListener('click', function (e) {
        e.preventDefault();
        fetch('sobre.php')
        .then(res => res.text())
        .then(html => {
            modal.innerHTML = html;
            modal.style.display = 'flex';
        });
    });
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
        modal.style.display = 'none';
        }
    });
});
