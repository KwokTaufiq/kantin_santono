let cartItems = [];

document.addEventListener('DOMContentLoaded', () => {
  const addToCartButtons = document.querySelectorAll('.add-to-cart');
  const cartItemsList = document.querySelector('.cart-items');
  const cartTotal = document.querySelector('.cart--total');
  const cartIcon = document.getElementById('cart-icon');
  const sidebar = document.getElementById('sidebar');
  const closeBtn = document.getElementById('sidebar-close');
  const pesananInput = document.getElementById('pesanan_data');
  const cartCount = document.getElementById('cart-count');
  const form = document.getElementById('form-pesanan');

  // Tambah item ke keranjang
  addToCartButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const name = btn.getAttribute('data-nama');
      const price = parseInt(btn.getAttribute('data-harga'));
      const id = btn.getAttribute('data-id');

      const existing = cartItems.find(item => item.id === id);
      if (existing) {
        existing.quantity++;
      } else {
        cartItems.push({ id, name, price, quantity: 1 });
      }

      updateCart();
    });
  });

  // Update cart UI
  function updateCart() {
    cartItemsList.innerHTML = '';
    let total = 0;
    let totalQty = 0;

    cartItems.forEach((item, index) => {
      total += item.price * item.quantity;
      totalQty += item.quantity;

      cartItemsList.innerHTML += `
        <div class="individual-cart-items">
          <span>${item.name}</span>
          <div class="cart-controls">
            <button class="decrease" data-index="${index}">-</button>
            <span class="quantity">${item.quantity}</span>
            <button class="increase" data-index="${index}">+</button>
            <span class="cart-item-price">Rp${(item.price * item.quantity).toLocaleString('id-ID')}</span>
          </div>
        </div>
      `;
    });

    // Re-attach tombol + dan -
    document.querySelectorAll('.increase').forEach(button => {
      button.addEventListener('click', e => {
        const index = e.target.dataset.index;
        cartItems[index].quantity++;
        updateCart();
      });
    });

    document.querySelectorAll('.decrease').forEach(button => {
      button.addEventListener('click', e => {
        const index = e.target.dataset.index;
        if (cartItems[index].quantity > 1) {
          cartItems[index].quantity--;
        } else {
          cartItems.splice(index, 1);
        }
        updateCart();
      });
    });

    cartTotal.textContent = `Rp${total.toLocaleString('id-ID')}`;
    cartCount.textContent = totalQty;
  }

  // Buka sidebar
  cartIcon.addEventListener('click', () => {
    sidebar.classList.add('open');
  });

  // Tutup sidebar
  closeBtn.addEventListener('click', () => {
    sidebar.classList.remove('open');
  });

  // Saat form disubmit
  form.addEventListener('submit', (e) => {
    if (cartItems.length === 0) {
      e.preventDefault();
      alert("Keranjang masih kosong! Silakan pilih menu terlebih dahulu.");
      return;
    }

    pesananInput.value = JSON.stringify(cartItems);
  });
});
