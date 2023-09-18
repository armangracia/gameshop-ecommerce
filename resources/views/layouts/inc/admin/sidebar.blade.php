<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
              <i class="mdi mdi-clipboard menu-icon"></i>
              <span class="menu-title">Category</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create') }}">Add Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category') }}">View Category</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
              <i class="mdi mdi-shopping menu-icon"></i>
              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
            </a>
              <div class="collapse" id="products">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create')}}">Add Products</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products')}}">View Products</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#gamecomp" aria-expanded="false" aria-controls="gamecomp">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Game Company</span>
              <i class="menu-arrow"></i>
            </a>
              <div class="collapse" id="gamecomp">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/gamecomp/create')}}">Add Game Company</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/gamecomp')}}">View Game Company</a></li>
              </ul>
            </div>
          </li>

          
          {{-- <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a> --}}
          {{-- </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Users</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sliders" aria-expanded="false" aria-controls="sliders">
            {{-- <a class="nav-link" href="{{url ('admin/sliders')}}"> --}}
              <i class="mdi mdi-view-carousel menu-icon"></i>
              <span class="menu-title">Home Slider</span>
              <i class="menu-arrow"></i>
            </a>
          </li>  
          <div class="collapse" id="sliders">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/sliders/create')}}">Add Sliders</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/sliders')}}">View Sliders</a></li>
            </a>
          </li>
        </ul>
          </div>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
            {{-- <a class="nav-link" href="{{url ('admin/sliders')}}"> --}}
              <i class="mdi mdi-account-supervisor-circle menu-icon"></i>
              <span class="menu-title">User Roles</span>
              <i class="menu-arrow"></i>
            </a>
          </li>  
          <div class="collapse" id="users">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="">Add User Roles</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users')}}">View Users</a></li>
            </a>
          </li>
        </ul>
          </div>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/settings')}}">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Site Settings</span>
            </a>
          </li>
        </ul>
      </nav>