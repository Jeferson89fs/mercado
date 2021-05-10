<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= HTTP_PATH ?>" class="brand-link">
    <img src="<?= HTTP_PATH_IMG ?>logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Vendas</span>
  </a>


  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus"></i>
            <p>
              Cadastro
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= HTTP_PATH ?>tipo_produto" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipo Produto</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= HTTP_PATH ?>produto" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Produto</p>
              </a>
            </li>                      
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus"></i>
            <p>
              Loja
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">            
            <li class="nav-item">
              <a href="<?= HTTP_PATH ?>venda" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Vendas</p>
              </a>
            </li>            
          </ul>
        </li>
    </nav>
  </div>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">