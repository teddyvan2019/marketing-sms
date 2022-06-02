<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"> Contactez-nous </a>
      </li>
    </ul> 


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <!-- <i class="fa fa-bell-o"></i> -->
          <i class="fa fa-users mr-2"></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"> Utilisateur </span>
          <div class="dropdown-divider"></div>
          <a href="{{ url('profil') }}" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> Profile
            <!-- <span class="float-right text-muted text-sm"> profil</span> -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('logout') }}" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> Deconnexion
            <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
          </a>
      </li>
    </ul>
  </nav>