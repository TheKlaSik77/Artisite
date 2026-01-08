document.querySelectorAll('#categoryChips .chip').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('categoryInput').value = btn.dataset.value;
        btn.closest('form').submit();
    });
});

document.querySelectorAll('#materialChips .chip').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('materialInput').value = btn.dataset.value;
        btn.closest('form').submit();
    });
});
