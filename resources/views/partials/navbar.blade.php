<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Toko Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 150px;">
        <li class="nav-item">
          <a class="nav-link {{ ($_posisi == 'home' || empty($_posisi)) ? 'active' : '' }}" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $_posisi == 'product' ? 'active' : '' }}" href="/product">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $_posisi == 'contact' ? 'active' : '' }}" href="/contact">Contact</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hy, {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/dashboard"><i class="fa fa-bar-chart"></i> My Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      <i class="fa fa-sign-out"></i> Logout </a>
                    </button>
                  </form>
                </li>
              </ul>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link {{ ($_posisi === 'login') ? 'active' : '' }}" href="/login"><i class="fa fa-sign-in"></i> Login</a>
          </li>
        @endauth
      </ul>
  </div>
</nav>