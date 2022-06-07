window.onload = () => {
  // Variables
  let stripe = Stripe('pk_test_51KsYzkEibdhyD3QRn2gxxqhek9ftFEzulRTsLRIWUUGpk9v15eYpN8Z9n4xcs0xi8BfO7WSPhQrscGZQvwUBJsBR00DlHuRuZy')
  let elements = stripe.elements()
  let redirect = "/index.php"

  // Objets de la page de paiement
  let cardHolderName = document.getElementById('cardholder-name')
  let cardButton = document.getElementById('card-button')
  let clientSecret = cardButton.dataset.secret; // dataset va chercher toutes les propriétés qui s'appellent data

  // Cration des éléments du formulaire de carte bancaire
  let card = elements.create('card')
  card.mount('#card-elements')

  // On gère la saisie et l'affichage des erreurs de saisie
  card.addEventListener('change', (event) => {
    let displayError = document.getElementById('card-errors')
    if (event.error) {
      displayError.textContent = event.error.message;
    }else{
      displayError.textContent = '';
    }
  })

  // On gère le paiement
  cardButton.addEventListener('click', () => {
    stripe.handleCardPayment(
      clientSecret, card, {
        payment_method_data: {
          billing_details: {
            name: cardHolderName.value
          }
        }
      }
    ).then((result) => {
      if(result.error){
        document.getElementById('errors').innerText = result.error.message
      }else{
        document.location.href = redirect
      }
    })
  })

}