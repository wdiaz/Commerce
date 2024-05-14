import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom/client';
import RelatedProductsItem from "./RelatedProductsItem";

const root = ReactDOM.createRoot(document.getElementById('related-products'));

const RelatedProducts = () => {

    const [products, setProducts] = useState([])



    useEffect(() => {
        const relatedProducts = async () => {
            fetch('/api/products?itemsPerPage=5')
                .then(response => response.json())
                .then(data => setProducts(data['hydra:member']))
                .catch(error => console.error('Error fetching products:', error));
        }
        relatedProducts()
    }, []);

    return (
        <div className="RelatedProducts">
            {(typeof products === 'undefined') ? (
                <p>Loading</p>
             ) : (
                products.map(product => (  <RelatedProductsItem product={product}/>))
            )}
        </div>
    )
}

export default RelatedProducts;

root.render(
        <RelatedProducts />
);