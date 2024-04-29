import React from "react";
const RelatedProductsItem = ({product}) => {
    return (
        <div className="RelatedProductsItem" key={product.sku}>
            <div className="col mb-5">
                <div className="card h-100">
                    <img className="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..."/>
                    <div className="card-body p-4">
                        <div className="text-center">
                            <h5 className="fw-bolder">{product.name}</h5>
                            <div className="d-flex justify-content-center small text-warning mb-2">
                                <div className="bi-star-fill"></div>
                                <div className="bi-star-fill"></div>
                            </div>
                            $45.00
                        </div>
                    </div>
                    <div className="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div className="text-center"><a className="btn btn-outline-dark mt-auto" href="#">Add to
                            cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default RelatedProductsItem;