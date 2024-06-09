import React from "react";
export default function ({product})
{
    const handleAddToCart = () => {

        // Replace this URL with your actual endpoint
        const url = 'https://ox.local/api/cart_items';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ product }),
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