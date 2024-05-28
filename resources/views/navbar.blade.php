<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="customNavbar">
    <div class="container">
        {{-- <a id="navbarImage" class="navbar-brand" href="#">
            <img id="logoImage" src="/images/logo.png" alt="Logo">
        </a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role=""
                       data-bs-toggle="" aria-expanded="true">Administrador</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="">Cadastros</a>
                                <ul class="submenu">
                                    <li><a class="dropdown-item" href="{{ route('company.create') }}">Empresas</a></li>
                                    <li><a class="dropdown-item" href="#">Sub Action 2</a></li>
                                </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">Another action</a>
                                <ul class="submenu">
                                    <li><a class="dropdown-item" href="#">Sub Another Action 1</a></li>
                                    <li><a class="dropdown-item" href="#">Sub Another Action 2</a></li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role=""
                       data-bs-toggle="" aria-expanded="true">
                        Dropdown 1
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="#">Action</a>
                                <ul class="submenu">
                                    <li><a class="dropdown-item" href="#">Sub Action 1</a></li>
                                    <li><a class="dropdown-item" href="#">Sub Action 2</a></li>
                                </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">Another action</a>
                                <ul class="submenu">
                                    <li><a class="dropdown-item" href="#">Sub Another Action 1</a></li>
                                    <li><a class="dropdown-item" href="#">Sub Another Action 2</a></li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role=""
                       data-bs-toggle="" aria-expanded="true">
                        Dropdown 1
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="#">Action</a>
                                <ul class="submenu">
                                    <li><a class="dropdown-item" href="#">Sub Action 1nn</a></li>
                                    <li><a class="dropdown-item" href="#">Sub Action 2</a></li>
                                </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">Another action</a>
                                <ul class="submenu">
                                    <li><a class="dropdown-item" href="#">teste</a></li>
                                    <li><a class="dropdown-item" href="#">Dinossauro1</a></li>
                                </ul>
                        </li>
                    </ul>
                </li>
                
                
                
            </ul>
        </div>
        <form class="form-inline ml-auto">
          <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar menu..." aria-label="Search" id="searchInput">
        </form>
    </div>
    {{-- <a href="#" id="darkMode" class="navbarButtons">
        <i class="fas fa-moon fa-lg"></i>
    </a> --}}
    <a href="{{ route('logout') }}" id="logout" class="navbarButtons">
        <i class="fas fa-sign-out-alt fa-lg"></i>
    </a>
</nav>
