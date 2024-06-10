import React from "react";
export default function ({product})
{
    const currentProduct = JSON.parse(product);

    const handleAddToCart = () => {
        const url = 'https://ox.local/api/cart_items';
        const cartItem = {
            "quantity": 3,
            "product": "/api/products/" + currentProduct.id,
            "price": 33,
            "cart": "/api/carts/7"
        };

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(cartItem),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // Handle success - you can update state or give feedback to the user
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Handle error - you can update state or give feedback to the user
            });
    };

    return (
        <div>
            <button
                className="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700"
                onClick={handleAddToCart}
                > Add to Cart
            </button>
        </div>
    )
    ;
}