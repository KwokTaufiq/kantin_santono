<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kantin Santono</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body>

  @include('pesan.header')
  @include('pesan.coversection')

  <section class="menu-section">
    <div class="menu-container">
      @foreach ($menus as $menu)
        <div class="card">
          <div class="card--image">
            <img src="{{ asset('gambar-menu/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
          </div>
          <div class="card--detail">
            <h3 class="card--title">{{ $menu->nama_menu }}</h3>
            <p class="price">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
            <button class="add-to-cart" 
                    data-id="{{ $menu->id }}"
                    data-nama="{{ $menu->nama_menu }}"
                    data-harga="{{ $menu->harga }}">
              Tambah
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </section>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif


  @include('pesan.footer')
  <script src="{{ asset('build/js/main.js') }}"></script>
</body>
</html>
