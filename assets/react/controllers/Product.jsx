import React from "react";
import AddToCart from "./AddToCart";
import ProductRatingBar from "./ProductRatingBar";

export default function ({product}) {
    const currentProduct = JSON.parse(product);
    return (
        <div className="mt-4">
            <div className="bg-white-100 light:bg-gray-800 py-8">
                <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex flex-col md:flex-row -mx-4">
                        <div className="md:flex-1 px-4">
                            <div className="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                                <img className="w-full h-full object-cover"
                                     src="https://cdn.pixabay.com/photo/2020/05/22/17/53/mockup-5206355_960_720.jpg"
                                     alt="Product Image"/>
                            </div>
                            <div className="flex -mx-2 mb-4">
                                <div className="w-1/2 px-2">
                                    <AddToCart product={product}/>
                                </div>
                                <div className="w-1/2 px-2">
                                    <button
                                        className="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">Add
                                        to Wishlist
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div className="md:flex-1 px-4">
                            <h2 className="text-2xl font-bold text-gray-800 dark:text-black mb-2">{currentProduct.name}</h2>
                            <p className="text-gray-600 dark:text-black-300 text-sm mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed
                                ante justo. Integer euismod libero id mauris malesuada tincidunt.
                            </p>


                            <ProductRatingBar />


                            <div className="mt-4">
                                <div className="flex mb-4">
                                    <div className="mr-4">
                                        <span className="font-bold text-gray-700 dark:text-black">Price:</span>
                                        <span className="font-bold text-gray-700 dark:text-black">$29.99</span>
                                    </div>
                                    <div>
                                        <span className="font-bold text-gray-700 dark:text-blac">Availability:</span>
                                        <span className="font-bold text-gray-700 dark:text-blac">In Stock</span>
                                    </div>
                                </div>
                                <div className="mb-4">
                                    <span className="font-bold text-gray-700 dark:text-gray-300">Select Color:</span>
                                    <div className="flex items-center mt-2">
                                        <button className="w-6 h-6 rounded-full bg-gray-800 dark:bg-gray-200 mr-2"></button>
                                        <button className="w-6 h-6 rounded-full bg-red-500 dark:bg-red-700 mr-2"></button>
                                        <button className="w-6 h-6 rounded-full bg-blue-500 dark:bg-blue-700 mr-2"></button>
                                        <button
                                            className="w-6 h-6 rounded-full bg-yellow-500 dark:bg-yellow-700 mr-2"></button>
                                    </div>
                                </div>
                                <div className="mb-4">
                                    <span className="font-bold text-gray-700 dark:text-gray-300">Select Size:</span>
                                    <div className="flex items-center mt-2">
                                        <button
                                            className="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">S
                                        </button>
                                        <button
                                            className="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">M
                                        </button>
                                        <button
                                            className="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">L
                                        </button>
                                        <button
                                            className="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XL
                                        </button>
                                        <button
                                            className="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XXL
                                        </button>
                                    </div>
                                </div>
                        </div>
                            <div>
                                <span className="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                                <p className="text-gray-600 dark:text-black text-sm mt-2">
                                    {currentProduct.longDescription}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    )
}