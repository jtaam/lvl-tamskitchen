<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('backend/img/sidebar-1.jpg')}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
            Tam's Kitchen
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">

            <li class="nav-item {{Request::is('admin/dashboard*') ? 'active':''}}">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/slider*') ? 'active':''}}">
                <a class="nav-link" href="{{route('slider.index')}}">
                    <i class="material-icons">slideshow</i>
                    <p>Sliders</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/category*') ? 'active':''}}">
                <a class="nav-link" href="{{route('category.index')}}">
                    <i class="material-icons">category</i>
                    <p>Categories</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/item*') ? 'active':''}}">
                <a class="nav-link" href="{{route('item.index')}}">
                    <i class="material-icons">list</i>
                    <p>Items</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/reservation*') ? 'active':''}}">
                <a class="nav-link" href="{{route('reservation.index')}}">
                    <i class="material-icons">list_alt</i>
                    <p>Reservations</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/contact*') ? 'active':''}}">
                <a class="nav-link" href="{{route('contact.index')}}">
                    <i class="material-icons">contact_mail</i>
                    <p>Contacts</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/clodunary*') ? 'active':''}}">
                <a class="nav-link" href="{{route('cloudinary.index')}}">
                    <i class="material-icons">cloud</i>
                    <p>Cloudinary</p>
                </a>
            </li>

            <li class="nav-item {{Request::is('admin/map*') ? 'active':''}}">
                <a class="nav-link" href="{{route('map.index')}}">
                    <i class="material-icons">map</i>
                    <p>Google Map</p>
                </a>
            </li>



        </ul>
    </div>
</div>