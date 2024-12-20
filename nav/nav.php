        <?php
        include("../verify/verify.php");
        $text_movil = "";
        if ($device) {
          $text_movil = 'data-widget="pushmenu"';
        }
        $t = time();
        if (file_exists("../sistem_images/logo.png")) {
          $url_imagen = "../sistem_images/logo.png?r=" . $t;
        } else {
          $url_imagen = "../images/empty.jpg";
        }
        ?>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top shadow">
          <ul class="navbar-nav" id="bar_menu_sidebar">
            <li class="nav-item" >
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
          </ul>

          <ul class="navbar-nav d-flex justify-content-center">
            <li class="nav-item dropdown btns-menu">
              <a class="nav-link" href="#" aria-expanded="false">
                <button class="btn btn-outline-info text-bold" id="btn-menu-karaoke" type="button" onclick="karaokes()">Karaokes</button>
              </a>
            </li>
            <li class="nav-item dropdown btns-menu">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <button class="btn btn-outline-primary text-bold" id="btn-menu-musical" type="button" onclick="musicales()">Musicales</button>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link text-bold" data-toggle="dropdown" href="#">
                Solicitados
                <span class="badge badge-success navbar-badge" style="font-size:.8rem;">0</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="lista_menu_canciones" ></div>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="" class="brand-link">
            <img src="<?php echo $url_imagen; ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">KARAOKOLA</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="../images/empty.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">Invitado</a>
              </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="#karaokes" onclick="karaokes(1)" <?php echo $text_movil ?> id="nav_karaokes" class="nav-link">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>karaokes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#musicales" onclick="musicales(1)" <?php echo $text_movil ?> id="nav_musicales" class="nav-link">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>musicales</p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>