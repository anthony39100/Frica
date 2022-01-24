let items_filter=document.querySelectorAll('.filter');
for(filters of items_filter){
    filters.addEventListener('click',function(e){
        let filter=e.target.dataset.category;
        let product=document.querySelectorAll('.prod');
        for(products of product){
            product_filter=products.dataset.product;

            if(product_filter===filter){
                let getElement=document.querySelectorAll(`div[data-product=${product_filter}]`)
                for(getElements of getElement ){
                   
                    getElements.classList.remove('d-none')
                }
             
            }else{
                let getElements=document.querySelectorAll(`div[data-product=${product_filter}]`);
                for(getElement of getElements ){
                    getElement.classList.add('d-none')
                }
            }
        }
    })
}