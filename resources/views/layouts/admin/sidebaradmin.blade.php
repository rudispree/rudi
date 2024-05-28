<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/panel/dashboardadminhrd" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa fa-address-card" aria-hidden="true"></i>
              <p>
                Konfigurasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item {{ request()->is(['karyawan','departemen','cabang']) ? 'active' : '' }}">
                <a href="/karyawan" class="nav-link {{ request()->is(['karyawan']) ? 'active' : '' }}">
                  <i class="fa fa-street-view" aria-hidden="true"></i>
                  <p>Data Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/departemen" class="nav-link {{ request()->is(['departemen']) ? 'active' : '' }}">
                <i class="fa fa-id-card" aria-hidden="true"></i>
                  <p>Departemen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/cabang" class="nav-link {{ request()->is(['cabang']) ? 'active' : '' }}">
                <i class="fa fa-id-card" aria-hidden="true"></i>
                  <p>Cabang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/konfigurasi/jamkerja" class="nav-link {{ request()->is(['jamkerja']) ? 'active' : '' }}">
                <i class="fa fa-id-card" aria-hidden="true"></i>
                  <p>Jam Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/cuti" class="nav-link {{ request()->is(['cuti']) ? 'active' : '' }}">
                <i class="fa fa-id-card" aria-hidden="true"></i>
                  <p>Cuti</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="/presensi/monitoring" class="nav-link">
              <i class="fa fa-camera" aria-hidden="true"></i>
              <p>Monitoring Presensi</p>  
            </a>
          </li>
          <li class="nav-item ">
            <a href="/presensi/izinsakit" class="nav-link">
            <i class="fa fa-server" aria-hidden="true"></i>
              <p>Data Izin/Sakit</p>  
            </a>
          </li>
          <li class="nav-item {{ request()->is(['departemen']) ? 'nav-link active' : '' }}">
            <a href="/presensi/laporan" class="nav-link">
              <i class="fa fa-book" aria-hidden="true"></i>
              <p>Laporan Presensi</p>  
            </a>
          </li>
          
          <li class="nav-item ">
            <a href="/presensi/rekap" class="nav-link">
            <i class="fa fa-file-text" aria-hidden="true"></i>
              <p>Laporan Rekap Presensi</p>  
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa fa-street-view" aria-hidden="true"></i>
              <p>
                Konfigurasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="/konfigurasi/locasikantor" class="nav-link">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <p>Lokasi Kantor</p>
                </a>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>