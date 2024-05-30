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
                    <a href="{{ route('projects.index') }}" class="nav-link">
                        <i class="fas fa-project-diagram nav-icon"></i>
                        <p>Projects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects.create') }}" class="nav-link">
                        <i class="fas fa-plus-circle nav-icon"></i>
                        <p>Add Project</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                      <i class="fas fa-shopping-cart nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('profile.purchase') }}" class="nav-link">
                      <i class="fas fa-shopping-bag nav-icon"></i>
                      <p>Purchases</p>
                    </a>
                  </li>
            </ul>
        </li>
    </ul>
</nav>
