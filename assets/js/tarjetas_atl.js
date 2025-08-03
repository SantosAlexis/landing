/**
 * tarjetas_atl.js
 * Controla la funcionalidad de hacer girar las tarjetas en un el eje x con 180 grados
 */
// Obten todos los elementos con la clase "tl_card_girar"
const atlCards = document.querySelectorAll(".atl_card_girar");

// Agrega un evento de clic a cada elemento
atlCards.forEach((card) => {
    card.addEventListener("click", function () {
        // Encuentra el elemento "card" padre del elemento clicado
        const atlparentCard = this.closest(".atl_card");
        // Alterna la clase "flipped" en el elemento "card" padre
        atlparentCard.classList.toggle("atl_card_flipped");
    });
});
