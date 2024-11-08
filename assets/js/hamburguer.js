document.addEventListener("DOMContentLoaded", function() {
    var hamburguer = document.querySelector('.hamburguer');
    var fechar = document.querySelector('.fechar');
    var sidebar = document.getElementById('sidebar');

    function toggleSidebar() {
        var sidebarIsOpen = sidebar.style.right === '0px';

        if (sidebarIsOpen) {
            sidebar.style.right = '-260px';
        } else {
            sidebar.style.right = '0px';
        }
    }

    hamburguer.addEventListener('click', toggleSidebar);
    fechar.addEventListener('click', toggleSidebar);
});