import React, { useEffect, useState } from 'react';

export default function () {
    const [merchants, setMerchants] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    useEffect(() => {
        const fetchMerchants = async () => {
            try {
                const response = await fetch('https://ox.local/api/products?itemsPerPage=4');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                setMerchants(data["hydra:member"]);
                setLoading(false);
            } catch (err) {
                setError(err);
                setLoading(false);
            }
        };

        fetchMerchants();
    }, []);

    return (
        <div>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-5">
                {merchants.map((merchant) => (
                    <div className="bg-white p-4 rounded-lg shadow-md flex" key={merchant.id}>
                        <a href="#"> <img src="https://klbtheme.com/grogin/wp-content/uploads/2023/12/1-12-500x500.jpg"
                        alt="Product 1" className="w-32 h-32 object-cover"/></a>
                        <div className="flex flex-col ml-4 justify-between">
                            <h3 className="text-lg font-semibold leading-tight"><a href={`/product/${merchant.id}`}> {merchant.name}</a></h3>
                            <p className="text-sm font-light text-gray-600 mb-2">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <div>
                                <div className="flex items-center justify-between mt-2">
                                    <span className="text-gray-700">$20.00</span>
                                    <span className="text-gray-500 line-through">$25.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    )
}