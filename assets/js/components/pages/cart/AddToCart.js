import React from 'react';
import ReactDOM from 'react-dom/client';

const root = ReactDOM.createRoot(document.getElementById('add-to-cart'));

const AddToCart = () => {

    return (
        <div className="RelatedProducts">

        </div>
    )
}

export default AddToCart;

root.render(
    <React.StrictMode>
        <AddToCart />
    </React.StrictMode>
);