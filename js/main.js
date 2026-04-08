// js/main.js

        // model produit
        function Product(reference, name, price, quantity) {
            this.reference = reference;
            this.name = name;
            this.price = price;
            this.quantity = quantity;
        }


        let addToCart = (product) => {
            console.log(product);
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            // Check if the product already exists in the cart
            let existingProduct = cart.find(item => item.reference === product.reference);
            if (existingProduct) {
                // Update the quantity if the product already exists
                existingProduct.quantity = parseInt(existingProduct.quantity) + parseInt(product.quantity);
            } else {
                // Add the new product to the cart
                cart.push(product);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart(); // Update the cart display
        };
        const displayShopingCart2 = () => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            $cartItemShop = document.getElementById('cart-table-item-list');
            $cartItemShop.innerHTML = '';
            if (cart.length <= 0){
                $cartItemShop.innerHTML += `
                    <tr>
                        <td colspan="6" class="text-center">Aucun produit dans le panier</td>
                    </tr>
                `;

            }
            if(cart.length > 0) {
                cart.forEach((item, index) => {
                    $cartItemShop.innerHTML += `
        <tr>
            <td class="prod-column">
                <div class="column-box cart-item">
                    <figure class="prod-thumb"><a href="#"><img src="${item.image}" alt="${item.name}"></a></figure>
                </div>
            </td>
            
            <td><h4 class="prod-title">${item.name}</h4></td>
            <td class="sub-total">${item.price} F CFA</td>
            <td class="qty">
                <div class="item-quantity">
                    <input class="quantity-spinner" type="number" value="${item.quantity}" name="products[${index}][quantity]">
                </div>
            </td>
            <td class="total">${item.price * item.quantity} F CFA</td>
            
            <input type="hidden" name="products[${index}][reference]" value="${item.reference}">
            <input type="hidden" name="products[${index}][name]" value="${item.name}">
            <input type="hidden" name="products[${index}][price]" value="${item.price}">
            <td><span class="fa fa-remove" onclick="removeFromCart('${item.reference}')"></span></td>
        </tr>
        `;
                });

                // Ajout d'un input hidden pour indiquer le nombre total de produits
                $cartItemShop.innerHTML += `
                    <input type="hidden" name="cart_count" value="${cart.length}">
                    `;

                //ajout du total
                let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                //total_price hidden input
                $cartItemShop.innerHTML += `
                    <input type="hidden" name="total_price" value="${total}">
                `;
                $cartItemShop.innerHTML += `
                    <tr>
                        <td colspan="4" class="text-right">Total</td>
                        <td>${total} F CFA</td>
                    </tr>
                `;
                // Ajout des boutons de validation
            }

        }
        const displayShopingCart = () => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartOuter = document.querySelector('.cart-outer');
            let tableOuter =document.querySelector('.cart-outer.table-outer');

            tableOuter.innerHTML = ''; // Clear existing content
            tableOuter.innerHTML += `
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th>aperçu</th>
                                <th class="prod-column">produit</th>
                                <th class="price">prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${cart.map(item => `
                                <tr>
                                    <td class="prod-column">
                                        <div class="column-box">
                                            <figure class="prod-thumb"><a href="#"><img src="images/resource/products/11.jpg" alt=""></a></figure>
                                        </div>
                                    </td>
                                    <td><h4 class="prod-title">${item.name}</h4></td>
                                    <td class="sub-total">${item.price} F CFA</td>
                                    <td class="qty"><div class="item-quantity"><input class="quantity-spinner" type="text" value="${item.quantity}" name="quantity"></div></td>
                                    <td class="total">${item.price * item.quantity} F CFA</td>
                            
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
            `;

            let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            let count = cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
            document.querySelector('.cart-count').textContent = count;
            tableOuter.innerHTML += `
                <div class="cart-total">Total : <span>${total} F CFA</span></div>
                <ul class="btns-boxed">
                    <li><a href="shoping-cart.php">Voir le panier</a></li>
                    <li><a href="checkout_copy.php">CheckOut</a></li>
                </ul>
            `;
        };
        const displayCart = () => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartPanel = document.querySelector('.cart-panel');
            cartPanel.innerHTML = ''; // Clear existing content
            cart.forEach(item => {
                cartPanel.innerHTML += `
                    <div class="cart-product">
                        <div class="inner">
                            <div class="cross-icon"><a class="icon d-none fa fa-remove btn" onclick="removeFromCart(${item.reference})"></a></div>
                            <div class="image"><img with="30" src="${item.image}" alt="${item.name}" /></div>
                            <h3><a href="shop-single.html">${item.name}</a></h3>
                            
                            <div class="quantity-text">Quantité ${item.quantity}</div>
                            <div class="price">${item.price} F CFA</div>
                        </div>
                    </div>
                `;
            });
            let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            cartPanel.innerHTML += `<div class="cart-total">Total : <span>${total} F CFA</span></div>`;
            let count = cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
            document.querySelector('.cart-count').textContent = count;
            cartPanel.innerHTML += `<ul class="btns-boxed">
                                        <li><a href="shoping-cart.php">Voir le panier</a></li>                            
                                    </ul>`;

        };

        const removeFromCart = (productReference) => {
            //Affiche modal bootstrap
            console.log("Reference : " + productReference);
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart = cart.filter(item => item.reference !== productReference);
            localStorage.setItem('cart', JSON.stringify(cart));
            //reflesh page
            window.location.reload();
        };


const persistCart = () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    fetch('php/save_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(cart)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                localStorage.removeItem('cart'); // Clear cart after saving
                displayCart();
            }
        });
};
displayCart();
displayShopingCart2();
// Example usage
document.querySelector('#checkoutButton').addEventListener('click', persistCart);


