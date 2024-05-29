  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #EAEAEA;">
      <!-- Brand Logo -->
      <!--<a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ asset('assets/img/logoft.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">SISTEM POS</span>
      </a>-->
      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="pb-3 mt-3 mb-3 user-panel d-flex">
              <div class="image">
                  @if (Auth()->user()->image)
                      <img src="{{ Storage::url(Auth()->user()->image) }}" class="img-circle elevation-2"
                          alt="User Image">
                  @else
                      <img src="{{ asset('assets/img/user_default.png') }}" class="img-circle elevation-2"
                          alt="User Image">
                  @endif
              </div>
              <div class="info">
                  <a href="{{ route('profile.index', encrypt(auth()->user()->id)) }}"
                      class="d-block" style="color: black;">{{ Auth()->user()->name }}</a>
                  <span class="text-xs" style="color: black;"><i class="fa fa-circle text-success"></i> Online</span>
              </div>
          </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')" style="color: black;">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Dashboard</p>
                </a>
            </li>
            @if (auth()->user()->level_id == 1)
                {{-- docs for icon url --}}
                {{-- https://themeon.net/nifty/v2.9.1/icons-ionicons.html --}}
                <li class="nav-item">
                    <a class="nav-link" style="color: black;">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Master Data<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link @yield('admin')">
                                <i class="nav-icon ion ion-person-stalker" style="color: black;"></i>
                                <p style="color: black;">Users</p>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jabatan.index') }}" class="nav-link @yield('jabatan')">
                                <i class="nav-icon ion ion-podium" style="color: black;"></i>
                                <p style="color: black;">Jabatan</p>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cabang.index') }}" class="nav-link @yield('cabang')">
                                <i class="nav-icon ion ion-home" style="color: black;"></i>
                                <p style="color: black;">Cabang</p>
                                </p>
                            </a>
                        </li>
                       <!-- <li class="nav-item">
                            <a href="route('functions.index') }}" class="nav-link @yield('functions')">
                                <i class="nav-icon ion ion-document-text" style="color: black;"></i>
                                <p style="color: black;">Functions</p>
                                </p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('log.index') }}" class="nav-link @yield('log')">
                                <i class="nav-icon ion ion-clipboard" style="color: black;"></i>
                                <p style="color: black;">Log Activity</p>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" style="color: black;">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Management - Jobs<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('job.index')}}" class="nav-link @yield('job')">
                            <i class="nav-icon ion ion-briefcase" style="color: black;"></i>
                            <p style="color: black;">Main Jobs</p>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('relate.index')}}" class="nav-link @yield('relate')">
                                <i class="nav-icon ion ion-document-text"style="color: black;"></i>
                                <p style="color: black;">Relate Jobs</p>
                            </p>
                        </a>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black;">
                    <i class="nav-icon ion-pound"></i>
                    <p>Article - Jobs<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('job.getJobByAdmin') }}" class="nav-link @yield('article-admin-job')">
                            <i class="nav-icon ion ion-bookmark" style="color: black;"></i>
                            <p style="color: black;">Main Job By Admin</p>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('article.admin.related.getAdminRelatedJobIdArticle') }}" class="nav-link @yield('article-relate-admin')">
                            <i class="nav-icon ion ion-folder" style="color: black;"></i>
                            <p style="color: black;">Related Job By Admin</p>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('job.getJobByPosition') }}" class="nav-link @yield('article-position-job')">
                            <i class="nav-icon ion ion-folder" style="color: black;"></i>
                            <p style="color: black;">Main Job By Position (Jabatan)</p>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('article.position.related.getPositionRelatedJobIDArticle') }}" class="nav-link @yield('article-relate-position')">
                            <i class="nav-icon ion ion-folder" style="color: black;"></i>
                            <p style="color: black;">Related Job By Position (Jabatan)</p>
                            </p>
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
