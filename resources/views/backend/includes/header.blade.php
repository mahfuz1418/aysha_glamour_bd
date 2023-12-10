<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

      <li class="nav-item">
        <div class="dropdown">
            <a href="#" class="nav-link nav-link-profile  pt-0" data-toggle="dropdown">
                <img style="height: 35px; width: 34px;" class="profile-user-img img-fluid img-circle"
                    src="https://picsum.photos/200"
                    alt="https://picsum.photos/200">
                <span class="logged-name text-info"><span class="hidden-md-down"></span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right bg-light-blue text-white">
                <ul class="list-unstyled user-profile-nav list-group ">
                    <li class="list-group-item bg-light-blue">
                        <p class="p-0 text-primary">Mr Zahid<small class="p-0 text-success">(Admin)</small></p>
                    </li>
                    <li class="list-group-item bg-light-blue">
                        <a href="{{ route('profile.edit') }}"><i class="far fa-user"></i>
                            Profile
                        </a>
                    </li>
                    <li class="list-group-item bg-light-blue">
                        <a href="{{ url('logout') }}" class="text-danger"
                            onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="icon ion-power"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </li>

    </ul>
  </nav>
