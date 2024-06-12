<nav class="navigation-bar">
    <div class="navigation-user">
          <a href="">{{ auth()->user()->name }}</a> |
          <a href="">Perfil</a> |
          <a href="{{ route('logout') }}">Logout</a>
    </div>
    <div class="navigation-itens">
       <div>
          Grupo Roma
       </div>
       <div>
          <a href="" data-menu="adm">Administrador</a>
         {{--  <a href="" data-menu="chad">Chad</a>
          <a href="" data-menu="julin">Julin</a> --}}
       </div>
       <div></div>
    </div>
    <div class="navigation-itens-drop">
       <div class="itens" id="adm">
          <div class="itens-menu">
             <span class="menu-title">Cadastros</span>
             <a class="dropdown-item" href="{{ route('company.index') }}">Empresas</a>
             <a class="dropdown-item" href="{{ route('department.index') }}">Departamentos</a>
             <a class="dropdown-item" href="{{ route('position.index') }}">Cargos</a>
             <a class="dropdown-item" href="{{ route('user.index') }}">Usuários</a>
          </div>
          <div class="itens-menu">
             <span class="menu-title">ADM</span>
             <a href="">Admintrador 1</a>
             <a href="">Admintrador 1</a>
             <a href="">Admintrador 1</a>
             <a href="">Admintrador 1</a>
          </div>
       </div>
       <div class="itens" id="chad">
          <div class="itens-menu">
             <span class="menu-title">C</span>
             <a href="">ATHUS</a>
             <a href="">CHAD</a>
             <a href="">CHAD</a>
             <a href="">CHAD</a>
          </div>
          <div class="itens-menu">
             <span class="menu-title">C</span>
             <a href="">CHAD</a>
             <a href="">CHAD</a>
             <a href="">CHAD</a>
             <a href="">CHAD</a>
          </div>
       </div>
       <div class="itens" id="julin">
          <div class="itens-menu">
             <span class="menu-title">JULINN</span>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
          </div>
          <div class="itens-menu">
             <span class="menu-title">JULINN</span>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
          </div>
          <div class="itens-menu">
             <span class="menu-title">JULINN</span>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
          </div>
          <div class="itens-menu">
             <span class="menu-title">JULINN</span>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
          </div>
          <div class="itens-menu">
             <span class="menu-title">JULINN</span>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
             <a href="">julin</a>
          </div>
       </div>
    </div>
 </nav>