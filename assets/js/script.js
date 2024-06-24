// Fonction pour afficher ou cacher le mot de passe

function showPass() {
    // let mdp = document.getElementById("mdp");
    // let confirmMdp = document.getElementById("confirmMdp");
  
    if (mdp.type === "password") {
      mdp.type = "text";
      confirmMdp.type = "text";
    } else {
      mdp.type = "password";
      confirmMdp.type = "password";
    }
  }
  




// -------------------fonction pour les articles épuisés----------------------------------
const buttons = document.querySelectorAll('.im2');

// Ajoutez un écouteur d'événements à chaque bouton
buttons.forEach(button => {
  button.onclick = () => {
    // Affichez une alerte indiquant que l'article est épuisé
    alert('Cet article est épuisé.');
    console.log(button);
  };
});







