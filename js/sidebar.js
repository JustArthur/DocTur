// Sélectionnez tous les éléments de la liste
const listItems = document.querySelectorAll('#item');

// Ajoutez un écouteur d'événement sur chaque élément de la liste
listItems.forEach(item => {
    item.addEventListener('click', () => {
        // Enlèvez la classe "active" de tous les éléments de la liste
        listItems.forEach(item => {
            item.classList.remove('active');
        });

        // Ajoutez la classe "active" à l'élément cliqué
        item.classList.add('active');
    });
});