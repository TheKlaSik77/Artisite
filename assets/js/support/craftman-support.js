document.addEventListener('DOMContentLoaded', function() {
    const replyTextarea = document.querySelector('.craftman-reply .craftman-textarea');
    
    if (replyTextarea) {
        replyTextarea.addEventListener('keydown', function(event) {
            // Vérifier si Entrée est pressée sans Shift (Shift+Entrée permet le retour à la ligne)
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault(); // Empêcher le retour à la ligne
                
                // Soumettre le formulaire parent
                const form = this.closest('.craftman-reply');
                if (form) {
                    form.submit();
                }
            }
        });
    }
});