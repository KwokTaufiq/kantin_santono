<div class="header">
  <div class="header--menu">
    <div class="logo-text">
      <h1>حلال</h1>
    </div>

    <form action="{{ route('pesan.index') }}" method="GET" class="search--box">
  <i class="fas fa-search"></i>
  <input
    type="text"
    name="search"
    placeholder="Cari makanan favorit..."
    value="{{ request('search') }}"
  >
</form>

    <div class="menu--icons">
      <div class="cart-icon" id="cart-icon">
        <i class="fas fa-cart-shopping"></i>
        <span id="cart-count">0</span>
      </div>
    </div>
  </div>
</div>

{{-- Sidebar Cart --}}
<div id="sidebar" class="sidebar">
  <div class="sidebar--close" id="sidebar-close">
    <i class="fas fa-times"></i>
  </div>

  <div class="cart--menu">
    <h1>Pesanan Saya</h1>
    <div class="cart-items"><!-- Diisi lewat JS --></div>
  </div>

  <div class="sidebar--footer">
    <form id="form-pesanan" method="POST" action="{{ route('pesanan.kirim') }}">
      @csrf

      <div class="form-group">
        <label for="nama_pelanggan">Nama</label>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama" maxlength="20" required>
      </div>

      <div class="form-group">
        <label for="nomor_meja">No Meja</label>
        <input type="text" id="nomor_meja" name="nomor_meja" placeholder="Masukkan nomor meja" required 
        pattern="^[1-9][0-9]?$" maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2)">

      </div>

      <div class="total--amount">
        <h5>Total</h5>
        <div class="cart--total">Rp0</div>
      </div>

      <input type="hidden" id="pesanan_data" name="pesanan_data">
      <button class="checkout-btn" type="submit">Pesan Sekarang</button>
    </form>
  </div>
</div>
