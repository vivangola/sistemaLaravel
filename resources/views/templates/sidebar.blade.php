    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
        <div class="app-sidebar__user">
          <img class="app-sidebar__user-avatar" src="{{ '/img/user.png' }}" alt="User Image">
          <div>
            <p class="app-sidebar__user-name">{{ session('user.nome') }}</p>
            <p class="app-sidebar__user-designation">{{ session('user.cargo') }}</p>
          </div>
        </div>
        <hr style="border-top: 1px solid rgba(255, 255, 255, 0.3);">
        <ul class="app-menu">
          <li><a class="app-menu__item" href="/"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Inicio</span></a></li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-plus-square"></i><span class="app-menu__label">Cadastros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="/funcionarios"><i class="icon fa fa-circle-o"></i>Funcionários</a></li>
              <li><a class="treeview-item" href="/materiais"><i class="icon fa fa-circle-o"></i>Materiais</a></li>
              <li><a class="treeview-item" href="/planos"><i class="icon fa fa-circle-o"></i>Planos</a></li>
              @if (session('user.tipo') == 1)
                <li><a class="treeview-item" href="/usuarios"><i class="icon fa fa-circle-o"></i>Usuários</a></li>
              @else
                <li><a class="treeview-item" href="/usuarios/{{ session('user.id') }}/edit"><i class="icon fa fa-circle-o"></i>Usuários</a></li>
              @endif 
            </ul>
          </li>
          <li><a class="app-menu__item" href="/contas"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label">Gerenciar Contas</span></a></li>
          <li><a class="app-menu__item" href="/obitos"><i class="app-menu__icon fa fa-minus-square"></i><span class="app-menu__label">Registrar Óbitos</span></a></li>
          <li><a class="app-menu__item" href="/mensalidades"><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Registrar Pagamentos</span></a></li>
          <li><a class="app-menu__item" href="/estoque"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Controle de Estoque</span></a></li>
          <li><a class="app-menu__item" href="/emprestimos"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Empréstimos/Devoluções</span></a></li>
          <!--li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Bootstrap Elements</a></li>
              <li><a class="treeview-item" href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>
              <li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>
              <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>
            </ul>
          </li>
          <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Charts</span></a></li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="form-components.html"><i class="icon fa fa-circle-o"></i> Form Components</a></li>
              <li><a class="treeview-item" href="form-custom.html"><i class="icon fa fa-circle-o"></i> Custom Components</a></li>
              <li><a class="treeview-item" href="form-samples.html"><i class="icon fa fa-circle-o"></i> Form Samples</a></li>
              <li><a class="treeview-item" href="form-notifications.html"><i class="icon fa fa-circle-o"></i> Form Notifications</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="table-basic.html"><i class="icon fa fa-circle-o"></i> Basic Tables</a></li>
              <li><a class="treeview-item" href="table-data-table.html"><i class="icon fa fa-circle-o"></i> Data Tables</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="blank-page.html"><i class="icon fa fa-circle-o"></i> Blank Page</a></li>
              <li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-circle-o"></i> Login Page</a></li>
              <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-circle-o"></i> Lockscreen Page</a></li>
              <li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-circle-o"></i> User Page</a></li>
              <li><a class="treeview-item" href="page-invoice.html"><i class="icon fa fa-circle-o"></i> Invoice Page</a></li>
              <li><a class="treeview-item" href="page-calendar.html"><i class="icon fa fa-circle-o"></i> Calendar Page</a></li>
              <li><a class="treeview-item" href="page-mailbox.html"><i class="icon fa fa-circle-o"></i> Mailbox</a></li>
              <li><a class="treeview-item" href="page-error.html"><i class="icon fa fa-circle-o"></i> Error Page</a></li>
            </ul>
          </li>
          <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Docs</span></a></li-->
        </ul>
      </aside>
  </div>