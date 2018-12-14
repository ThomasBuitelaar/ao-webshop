<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://ao-webshop.local/">AO-Webshop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="http://ao-webshop.local/">Home <span class="sr-only">(current)</span></a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/categories') }}">Categories </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/articles') }}">Articles </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/shopping-cart') }}">Shopping cart </a>
      <li class="nav-item dropdown">
      <!-- The Categories dropdown menu -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Fish</a>
          <a class="dropdown-item" href="#">Gun</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0 col-order-1">
    <!-- Checking if there is a user logged in, if not show the login or sign up options -->
    <div class="navbar-nav ml-auto">
    @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/home') }}">Home </a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Account settings</a>
          <a class="dropdown-item" href="#">My orders</a>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
      </li>
    </ul>

                    @else
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">Login </a>
                    </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">Register </a>
                        </li>
                        @endif
                    @endauth
                </div>
            @endif
    </div>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
