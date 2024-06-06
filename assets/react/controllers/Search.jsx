import React, { useState } from 'react';

export default function (props) {
    const [query, setQuery] = useState('');

    const handleInputChange = (event) => {
        const newQuery = event.target.value;
        setQuery(newQuery);
        console.log(newQuery);
    };


    return (
    <div className="flex-1 mx-6">
        <input type="text"
               placeholder="Search for products"
               className="w-full px-4 py-2 border rounded-md"
               value={query}
               onChange={handleInputChange}
        />
    </div>
    );
}