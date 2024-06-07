<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top custom-bg-grey" id="customNavbar">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
       aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="" role="" data-bs-toggle="" aria-expanded="true">Administrador</a>
             <ul class="dropdown-menu" aria-labelledby="">
                <li>
                    <div class="d-flex flex-row">
                        <div>
                            <a class="dropdown-item" href="">Cadastros</a>
                            <ul class="submenu">
                               <li><a class="dropdown-item" href="{{ route('company.index') }}">Empresas</a></li>
                               <li><a class="dropdown-item" href="{{ route('department.index') }}">Departamentos</a></li>
                               <li><a class="dropdown-item" href="{{ route('position.index') }}">Cargos</a></li>
                               <li><a class="dropdown-item" href="{{ route('user.index') }}">Usuários</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
             </ul>
          </li>
       </ul>
      {{--  <a href="{{ route('logout') }}" id="logout" class="">
          <i class="fas fa-sign-out-alt fa-lg"></i>
          </a> --}}
    </div>
{{-- <form class="form-inline ml-auto">
       <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar menu..." aria-label="Search" id="searchInput">
    </form> --}}
 </nav>