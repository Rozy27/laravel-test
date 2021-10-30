<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/dashboard">Toko Online</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" style="left:8rem;" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav ms-auto">
    <div class="nav-item text-nowrap">
      <form action="/logout" method="post">
        @csrf
        <button type="submit" class="btn btn-dark">
          <i class="fa fa-sign-out"></i> Logout
        </button>
      </form>
    </div>
  </div>
</header>

