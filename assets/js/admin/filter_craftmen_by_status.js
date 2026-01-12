// Fonction de filtrage
function filterCraftmen() {
    const filterValue = document.getElementById('statusFilter').value;
    
    let filtered = craftmen;
    
    if (filterValue !== '') {
        filtered = craftmen.filter(craftman => craftman.validator_id == null);
    }
    
    displayCraftmen(filtered);
}

// Écouteur d'événement sur le select
document.getElementById('statusFilter').addEventListener('change', filterCraftmen);

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    ;
});