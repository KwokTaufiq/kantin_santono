<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Admin - Kantin Santono</title>
  <style>
    :root {
      --color-bg: #faeeed;
      --color-primary: #f89052;
      --color-primary-dark: #d96a2f;
      --color-text-primary: #071f41;
      --color-text-secondary: #3b2f2f;
      --color-card-bg: #ffe2c2;
      --color-shadow: rgba(7, 31, 65, 0.08);
      --border-radius: 0.75rem;
      --font-headline: 'Poppins', sans-serif;
      --font-body: 'Inter', sans-serif;
      --spacing-unit: 1rem;
      --transition-fast: 0.3s ease;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: var(--font-body);
      background-color: var(--color-bg);
      color: var(--color-text-secondary);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: var(--spacing-unit);
    }

    nav {
      position: sticky;
      top: 0;
      background: var(--color-bg);
      padding: 0.75rem var(--spacing-unit);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
      box-shadow: 0 2px 4px var(--color-shadow);
    }

    .logo {
      font-family: var(--font-headline);
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--color-primary-dark);
    }

    .dashboard {
      display: grid;
      grid-template-columns: 240px 1fr;
      gap: var(--spacing-unit);
      margin-top: var(--spacing-unit);
    }

    @media (max-width: 768px) {
      .dashboard {
        grid-template-columns: 1fr;
      }
    }

    aside.sidebar {
      background: var(--color-card-bg);
      border-radius: var(--border-radius);
      padding: var(--spacing-unit);
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    aside.sidebar h2 {
      font-family: var(--font-headline);
      font-size: 1.2rem;
      color: var(--color-text-primary);
      margin-bottom: 1rem;
    }

    aside.sidebar nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    aside.sidebar nav ul li button {
      all: unset;
      width: 100%;
      padding: 0.5rem 0.75rem;
      border-radius: var(--border-radius);
      font-weight: 600;
      color: var(--color-text-secondary);
      cursor: pointer;
      transition: background var(--transition-fast), color var(--transition-fast);
    }

    aside.sidebar nav ul li button:hover,
    aside.sidebar nav ul li button:focus {
      background-color: rgba(7, 31, 65, 0.1);
      color: var(--color-primary-dark);
    }

    aside.sidebar nav ul li button.active {
      background-color: var(--color-primary);
      color: #fff;
      cursor: default;
    }

    main.content {
      background: var(--color-card-bg);
      border-radius: var(--border-radius);
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .hero h1 {
      font-family: var(--font-headline);
      font-size: 2.5rem;
      margin: 0 0 0.5rem;
      color: var(--color-text-primary);
    }

    .hero p {
      font-size: 1.1rem;
    }

    .metrics {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
    }

    .card {
      background: #fff;
      border-radius: var(--border-radius);
      padding: 1.5rem;
      box-shadow: 0 4px 8px var(--color-shadow);
    }

    .card .metric-title {
      font-weight: 600;
      color: var(--color-text-secondary);
    }

    .card .metric-value {
      font-size: 2rem;
      font-weight: bold;
      color: var(--color-text-primary);
    }

    .section-title {
      font-family: var(--font-headline);
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.875rem;
      color: var(--color-text-secondary);
    }

    .container img {
      width: 200px;
      height: 200px;
    }

    
  </style>
</head>
<body>

<nav>
  <div class="container">
    <div class="logo">Kantin Santono</div>
  </div>
</nav>

<section class="container dashboard">
  <aside class="sidebar" aria-label="Navigasi Admin">
    <h2>Admin Menu</h2>
    <nav>
      <ul>
        <li><button role="button" class="active" aria-current="page" aria-controls="section-dashboard" data-section="dashboard">Dashboard</button></li>
        <li><button role="button" aria-controls="section-pesananans" data-section="pesananans">Pesanan</button></li>
        <li><button role="button" aria-controls="section-menus" data-section="menus">Kelola Menu</button></li>
      </ul>
    </nav>
  </aside>

  <main class="content">
    <section id="section-dashboard" role="region" aria-labelledby="dashboard-title">
      <div class="hero">
        <h1 id="dashboard-title">Welcome, Admin</h1>
        <p>Sup Admin! Back at it again! You’re the boss, everything’s on you!</p>
      </div>
      <div class="metrics">
        <div class="card">
          <div class="metric-title">Total Pesanan</div>
          <h3>{{ number_format($totalPesanan) }}</h3> <!-- Total -->
        </div>
        <div class="card">
          <div class="metric-title">Pesanan Pending</div>
          <h3>{{ number_format($totalPending) }}</h3> <!-- Pending -->
        </div>
        <div class="card">
          <div class="metric-title">Pesanan Selesai</div>
          <h3>{{ number_format($totalSelesai) }}</h3> <!-- Selesai -->
        </div>
      </div>
    </section>

    <section id="section-pesananans" role="region" aria-labelledby="pesananans-title" hidden>
      <h2 id="pesananans-title" class="section-title">Pesanan</h2>
      @isset($pesanans)
        @include('admin.pesanan.index')
    @endisset
    </section>

    <section id="section-menus" role="region" aria-labelledby="menus-title" hidden>
      <h2 id="menus-title" class="section-title">Kelola Menu</h2>
      @isset($menus)
        @include('admin.menu.index')
    @endisset
    </section>
  </main>
</section>

<footer>&copy; 2025 Kantin Santono</footer>

<script>
  (() => {
    const buttons = document.querySelectorAll('aside.sidebar button');
    const sections = document.querySelectorAll('main.content > section');

    function setActive(sectionId) {
      sections.forEach(section => {
        section.hidden = section.id !== sectionId;
      });

      buttons.forEach(button => {
        const isActive = 'section-' + button.dataset.section === sectionId;
        button.classList.toggle('active', isActive);
        button.setAttribute('aria-current', isActive ? 'page' : null);
      });
    }

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        setActive('section-' + button.dataset.section);
      });
    });

    setActive('section-dashboard');
  })();
</script>

</body>
</html>
