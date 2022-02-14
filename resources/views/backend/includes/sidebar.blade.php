 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ Storage::disk('uploads')->url($setting->company_favicon) }}" alt="{{ $setting->company_name }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $setting->company_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <a href="{{ env('APP_URL') }}" target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-globe"></i>
                    <p>
                        Website
                    </p>
                </a>
            </div>
        </li>

          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('users.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('message.index') }}" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Customer Mail
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('subscribers.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Subscribers
              </p>
            </a>
          </li>

            <li class="nav-item">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <a href="#" class="nav-link">
                        <p>
                            All CMS
                        </p>
                    </a>
                </div>
            </li>

        <li class="nav-item">
            <a href="{{ route('slider.index') }}" class="nav-link">
              <i class="fas fa-film nav-icon"></i>
              <p>Sliders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Content
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="padding-left: 20px;">
                <li class="nav-item">
                    <a href="{{ route('content.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Content</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('content.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create new Content</p>
                    </a>
                </li>
            </ul>
        </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px;">
                        <li class="nav-item">
                            <a href="{{ route('product-category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('product-category.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new category</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Product</p>
                    </a>
                </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ route('partner.index') }}" class="nav-link">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Partners
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('services.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('services.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Service Info</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Courses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('coursecategory.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View Courses Category</p>
                    </a>
                </li>
              <li class="nav-item">
                <a href="{{ route('courses.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('courses.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Courses Info</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Team
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('team.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('team.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Team</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('news.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Blogs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('news.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Blogs</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">

            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Plans & Pricings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('plantype.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Plantype</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('plantype.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Plantype</p>
                  </a>
                </li>
              </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pricing.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Pricings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pricing.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Pricing</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Testimonials
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('testimonial.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Testimonials</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('testimonial.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Testimonial</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Album
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('album.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Albums</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('album.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Album</p>
                </a>
              </li>
            </ul>
          </li> --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Menu Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('menu.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Menu List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('menu.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Menu</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('partner.index') }}" class="nav-link">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Partners
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Destination
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('destination.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Distination</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('learns.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create You Looking</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Choose Us
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('choose.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Choose Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('choose.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Choose Us</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Student Story
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('student.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Student Story</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('student.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Student Story</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Test Preparation
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('learns.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Test Preparation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('learns.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Test Preparation</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <a href="#" class="nav-link">
                    <p>
                        Settings
                    </p>
                </a>
            </div>
        </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('setting.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('socialMedia') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Social Media</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('aboutUs') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('extra.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Extra
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
