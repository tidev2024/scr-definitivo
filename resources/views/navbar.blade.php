<nav class="navigation-bar">
    <div class="navigation-user">
        <a href="">{{ auth()->user()->name }}</a> |
        <a href="{{ route('user.profile') }}">Perfil</a> |
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <div class="navigation-itens">
       <div>
         <a href="{{ route('home') }}">Grupo Roma</a>
       </div>
       <div class="nav-itens-positions">
         <div>
            <a href="" data-menu="adm">Administrador</a>
         </div>
         <div>
           <a href="" data-menu="vendas">Vendas</a>
        </div>
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
             <a class="dropdown-item" href="{{ route('percentCommission.index') }}">Percentual de comissão</a>
             <a class="dropdown-item" href="{{ route('invoicing.processFileB2B') }}">Upload de arquivo de Comissão</a>
          </div>
       </div>
       <div class="itens" id="vendas">
          <div class="itens-menu">
             <span class="menu-title">Relatórios</span>
             <a href="">Comissão de Venda Direta (VD)</a>
             <a href="">Comissão de Veículos Novos (VN)</a>
          </div>
       </div>
    </div>
 </nav>