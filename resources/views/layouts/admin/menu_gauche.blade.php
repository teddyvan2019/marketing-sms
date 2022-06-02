<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
    <img src="{{ URL::asset('template/admin/dist/img/logo_smartprest.jpg') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">

      <span class="brand-text font-weight-light"> <?= config('app.name'); ?> </span>
    </a>

    <!-- Sidebar --> 
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('template/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu --> 
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                tableau de bord
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('repertoires') }}" class="nav-link">
              <i class="nav-icon fa fa-folder"></i>
              <p>
                Repertoires
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview menu-open"> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Parametres
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" title='Le repertoire des acteurs de controle'>
                <a href="{{ url('users') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> Comptes utilisateurs </p>
                </a>
              </li>
              <li class="nav-item" title='Le repertoire des acteurs de controle'>
                <a href="{{ url('religions') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> Réligion </p>
                </a>
              </li>
              <li class="nav-item" title='Les indicateurs de performance'>
                <a href="{{ url('villes') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> Ville </p>
                </a>
              </li>
              <li class="nav-item" title='Les indicateurs de performance'>
                <a href="{{ url('genres') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> Genre </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
                SMS
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" title='Le repertoire des acteurs de controle'>
                <a href="{{ url('messagesinstantane') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sms instantanée</p>
                </a>
              </li>
              <li class="nav-item" title='Les indicateurs de performance'>
                <a href="{{ url('campagne')}} " class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>campagne sms</p>
                </a>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>