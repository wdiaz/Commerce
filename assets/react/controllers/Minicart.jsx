import React, { useState, useEffect }from "react";
export default function () {
    const [cartItems, setCartItems] = useState(null);
    const [cart, setCart] = useState(null);
    const [error, setError] = useState(null);
    const [cartItemCount, setCartItemCount] = useState(0);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('https://ox.local/api/carts/7', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const cart = await response.json();
                const cartItemsUrls = Object.values(cart['cartItems']);
                const itemsDataPromises = cartItemsUrls.map(url => fetch(url).then(response => response.json()));
                const itemsData = await Promise.all(itemsDataPromises);
                setCartItemCount(cartItemsUrls.length);
                setCartItems(itemsData);
                setCart(cart);
            } catch (error) {
                setError(error.message);
            }
        };

        fetchData();
    }, []);

    if (error) {
        return <div>Error: {error}</div>;
    }

    if (!cartItems) {
        return <div>Loading...</div>;
    }
    console.log(cartItems);
    
    return (
    <div className="flex items-center">
        <a href="#" className="flex items-center space-x-2 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                      d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.5 6H21M7 13l-1.5 7m0 0h13M5.5 20a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM18.5 20a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
            </svg>
            <span>{cartItemCount}</span>
        </a>
    </div>
    );
}