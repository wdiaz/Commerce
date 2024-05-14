// assets/react/controllers/Hello.jsx
import React from 'react';

export default function ({merchant}) {

    const parsedMerchant = JSON.parse(merchant);
    const { id, uuid, name, slug, locationX, locationY } = parsedMerchant;

    return (
        <div>
            <h1 className="display-4 fw-bolder">{name}</h1>
        </div>
    )
}