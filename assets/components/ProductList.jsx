import React, { useEffect, useState } from "react";

export default function ProductList() {
  const [products, setProducts] = useState([]);

    useEffect(() => {
    const fetchProducts = async () => {
        const response = await fetch("/api/products"); 
        const products = await response.json();
        setProducts(products);
    };

    fetchProducts();
  }, []);

  return (
    <ul>
      {products.map((product) => {
        return <li key={product.id} >{product.name}, {product.description} <b>Price: {product.price}</b></li>;
      })}
    </ul>
  );
}
