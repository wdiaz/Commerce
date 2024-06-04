import React from 'react';
import ReactDom from 'react-dom/client';

import RelatedProductsItems from "./RelatedProductsItems";

const root = ReactDom.createRoot(document.getElementById('RelatedProducts'));
root.render(
    <React.StrictMode>
        <RelatedProductsItems />
    </React.StrictMode>
)