<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        
        <div class="sidebar-brand-text mx-3">
            <img src="{{url('assets/img/logo.png')}}" style="height:60px;width:auto;">
        </div>
    </a>

    
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link {{($sidebar =='dashboard' && $subsidebar == 'dashboard')?'active':''}}" href="{{url('admin/dashboard')}}">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link {{($sidebar =='clients' && $subsidebar == 'clients')?'active':''}}" href="{{url('admin/clients')}}">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>Clients</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{($sidebar =='plans' && $subsidebar == 'plans')?'active':''}}" href="{{url('admin/plans')}}">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <span>Plans</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{($sidebar =='groups' && $subsidebar == 'groups')?'active':''}}" href="{{url('admin/groups')}}">
            <i class="fa fa-users" aria-hidden="true"></i>

            <span>Groups</span>
        </a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link" href="{{url('logout')}}">
            
            <i class="fa fa-sign-out" aria-hidden="true"></i>

            <span>Logout</span>
        </a>
    </li>
  
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle">
            
        </button>
    </div>

</ul>
