         <!--  Header Start -->
      <header class="app-header">
        
      </header>
      <!--  Header End -->
   <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          {{-- <a href="./index.html" class="text-nowrap logo-img">
            <img src="../template/images/logos/dark-logo.svg" width="180" alt="" />
          </a> --}}
          <div class="mt-4">
            <h4><b>Tugas Holistik</b></h4>
              <p>{{ auth()->user()->name }}</p>
          </div>
          <hr>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            
            

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MASTER</span>
            </li>
            <li class="sidebar-item">
              {{-- <a class="sidebar-link hidden" style="visibility: hidden;" href="{{ route('add-user') }}" aria-expanded="false"></a> --}}

              <a class="sidebar-link" href="{{ route('user') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('template-email') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-mail"></i>
                </span>
                <span class="hide-menu">Template Email</span>
              </a>
            </li>


            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"></span>
            </li>

            <li class="sidebar-item">
               <a class="sidebar-link" href="{{ route('upload-data') }}">
                         <span>
                  <i class="ti ti-upload"></i>
                </span>
                         <span class="nav-text">Upload Data</span>
                     </a>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="{{ route('email') }}">
                         <span>
                  <i class="ti ti-mail"></i>
                </span>
                         <span class="nav-text">Email</span>
                     </a>
            </li>

            <li class="sidebar-item">

               <a class="sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         <span>
                  <i class="ti ti-logout"></i>
                </span>
                         <span class="nav-text">Keluar</span>
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
            </li>

          </ul>
          
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->