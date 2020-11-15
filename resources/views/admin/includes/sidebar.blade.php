<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

          <li class="nav-item active"><a href="/"><i class="icon-home" style="color:yellowgreen"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Home </span></a>
          </li>


          <span class="badge badge badge-secondary badge-pill float-right mr-1 mt-1">{{App\Models\Deivison::count()}}</span>
          <li class="nav-item "><a href="{{route('admin.divisions')}}"><i class="la la-tasks" style="color:gray"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Divisions </span></a>
          </li>

          <span class="badge badge badge-dark badge-pill float-right mr-1 mt-1">{{App\Models\Brand::count()}}</span>
          <li class="nav-item "><a href="{{route('admin.brands')}}"><i class="la la-connectdevelop" style="color:green"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Brands </span></a>
          </li>
          
          
          <span class="badge badge badge-danger badge-pill float-right mr-1 mt-1">{{App\Models\Category::whereNull('parent_id')->count()}}</span>
          <li class="nav-item"><a href="{{route('admin.categories')}}"><i class="icon-grid" style="color:red"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Categories </span></a>
          </li>

          <span class="badge badge badge-warning badge-pill float-right mr-1 mt-1">{{App\Models\Category::whereNotNull('parent_id')->count()}}</span>
          <li class="nav-item"><a href="{{route('admin.subcategories')}}"><i class="icon-grid" style="color:goldenrod"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Sub Categories </span></a>
          </li>

         

          <span class="badge badge badge-dark badge-pill float-right mr-1 mt-1">{{App\Models\Product::count()}}</span>
          <li class="nav-item"><a href="{{route('admin.products')}}"><i class="la la-tags" style="color:black"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Products</span></a>
          </li>

          

          
          <span class="badge badge badge-primary badge-pill float-right mr-1 mt-1">{{App\User::count()}}</span>
          <li class="nav-item"><a href="{{route('admin.clients')}}"><i class="ft-users"style="color:Indigo"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main"> Clients </span></a>
          </li>


          <span class="badge badge badge-success badge-pill float-right mr-1 mt-1">{{App\Models\Order::count()}}</span>
          <li class="nav-item"><a href="{{route('admin.orders')}}"><i class="la la-money" style="color:green"></i><span
              class="menu-title" data-i18n="nav.add_on_drag_drop.main">Orders</span></a>
          </li>

      </ul>
  </div>
</div>
