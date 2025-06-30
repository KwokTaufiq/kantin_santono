document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartItemCount = document.querySelector('.cart-icon span');
    const cartItemsList = document.querySelector('.cart-items');
    const cartTotal = document.querySelector('.cart--total');
    const cartIcon = document.querySelector('.cart-icon');
    const sidebar = document.getElementById('sidebar');

    let cartItems = [];
    let totalAmount = 0;

    addToCartButtons.forEach((button, index) => {
        button.addEventListener('click', ()=>{
            const item = {
                name: document.querySelectorAll('.card .card--title')[index].textContent,
                price: parseFloat(
                    document.querySelectorAll('.price')[index].textContent.replace(/[^\d]/g, ''),
                ),
                quantity: 1,
            };

            const exisitingItem = cartItems.find(
                (cartItem) => cartItem.name === item.name,
            );
            if(exisitingItem){
                exisitingItem.quantity++;
            } else {
                cartItems.push(item);
            }

            totalAmount += item.price;

            updateCartUI();
        });

        function updateCartUI(){
            updateCartItemCount(cartItems.length);
            updateCartItemList();
            updateCartTotal();
        }

        function updateCartItemCount(count) {
            cartItemCount.textContent = count;
        }

        function updateCartItemList() {
            cartItemsList.innerHTML = '';
            cartItems.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-items', 'individual-cart-items');
                cartItem.innerHTML = `
                <span>${item.name}</span>
                <div class="cart-controls">
                    <button class="decrease" data-index="${index}">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="increase" data-index="${index}">+</button>
                    <span class="cart-item-price">Rp.${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                </div>
                `;


                cartItemsList.append(cartItem);
            });

            // Tombol tambah
            document.querySelectorAll('.increase').forEach(button => {
            button.addEventListener('click', event => {
                const index = event.target.dataset.index;
                cartItems[index].quantity++;
                updateCartUI();
            });
            });

            // Tombol kurang
            document.querySelectorAll('.decrease').forEach(button => {
            button.addEventListener('click', event => {
                const index = event.target.dataset.index;
                if (cartItems[index].quantity > 1) {
                cartItems[index].quantity--;
                } else {
                // Jika quantity tinggal 1, hapus item
                cartItems.splice(index, 1);
                }
                updateCartUI();
            });
            });


            const removeButtons = document.querySelectorAll('.remove-btn');
            removeButtons.forEach((button)=>{
                button.addEventListener('click', (event)=>{
                    const index = event.target.dataset.index;
                    removeItemFromCart(index);
                });
            });
        }

        function removeItemFromCart(index){
            const removeItem = cartItems.splice(index, 1)[0];
            totalAmount -= removeItem.price * removeItem.quantity;
            updateCartUI();
        }

        function updateCartTotal() {
            let totalAmount = cartItems.reduce((sum, item) => {
            return sum + item.price * item.quantity;
            }, 0);

            // Tampilkan dalam format Rupiah
            cartTotal.textContent = `Rp.${totalAmount.toLocaleString('id-ID')}`;
        }

        cartIcon.addEventListener('click', ()=>{
            sidebar.classList.toggle('open');
        });

        const closeButton = document.querySelector('.sidebar--close');
        closeButton.addEventListener('click', ()=>{
            sidebar.classList.remove('open');
        });
    });

    function updateCartTotal() {
        
    }


});