let panier=document.querySelectorAll('.ajouter-panier');
let notifs=0;
for(paniers of panier){
    paniers.addEventListener('click',function(e){
        let productioImage=e.target.dataset.image;
        let productioPrice=e.target.dataset.price;
        let formData=new FormData();
        formData.append('productImage',productioImage);
        formData.append('productPrice',productioPrice);

        fetch('panier', {
             method: 'POST',
            body: formData
            })
.then(response => response.json())
.then(reponse => {
  console.log('Success:', reponse);
})
.catch(error => {
  console.error('Error:', error);
});
    })
}
