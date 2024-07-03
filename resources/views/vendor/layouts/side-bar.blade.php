<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Pages
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('product.index') }}" class="nav-link">
                <i class="fas fa-shopping-cart nav-icon"></i>
              <p>My Product</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('product.create') }}" class="nav-link">
              <i class="fas fa-plus-circle nav-icon"></i>
              <p>Add Product</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fas fa-user-circle nav-icon"></i>
              <p>Profile</p>
            </a>
          </li> --}}
        </ul>
      </li>
    </ul>
  </nav>
