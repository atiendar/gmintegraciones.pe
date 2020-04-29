@canany(['sistema.edit'])
  <li class="nav-item">
    <a href="{{ route('sistema.edit') }}" class="nav-link {{ Request::is('sistema/editar') ? 'active' : '' }}">
      <i class=""><img src="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg) }}" alt="{{ Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-2 bg-white" style="opacity: .7; width:2.5rem;"></i>
      {{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }}
    </a>
  </li>
@endcanany
@canany(['sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy'])
  <li class="nav-item">
    <a href="{{ route('sistema.plantilla.index') }}" class="nav-link {{ Request::is('sistema/plantilla') ? 'active' : '' }}">
      <i class="fas fa-brush"></i>
      {{ __('Lista de plantillas') }}
    </a>
  </li>
@endcanany
@canany(['sistema.notificacion.create'])
  <li class="nav-item">
    <a href="{{ route('sistema.notificacion.create') }}" class="nav-link {{ Request::is('sistema/notificacion/enviar') ? 'active' : '' }}">
      <i class="far fa-bell"></i>
      {{ __('Enviar notificación') }}
    </a>
  </li>
@endcanany
@canany(['sistema.actividad.index'])
  <li class="nav-item">
    <a href="{{ route('sistema.actividad.index') }}" class="nav-link {{ Request::is('sistema/actividad') ? 'active' : '' }}">
      <i class="fas fa-folder"></i> 
      {{ __('Registro de actividades') }}
    </a>
  </li>
@endcanany
@canany(['sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy'])
  <li class="nav-item">
    <a href="{{ route('sistema.catalogo.index') }}" class="nav-link {{ Request::is('sistema/catalogo') ? 'active' : '' }}">
      <i class="fas fa-book-open"></i>
      {{ __('Lista de catálogos') }}
    </a>
  </li>
@endcanany
@canany(['sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy'])
  <li class="nav-item">
    <a href="{{ route('sistema.serie.index') }}" class="nav-link {{ Request::is('sistema/serie') ? 'active' : '' }}">
      <i class="fas fa-barcode"></i>
      {{ __('Lista de series') }}
    </a>
  </li>
@endcanany
@canany(['sistema.edit'])
  @if(Request::route()->getName() == 'sistema.edit')
    <li class="nav-item dropdown ml-auto border rounded">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-image"></i> {{ __('Archivos') }} <i class="fas fa-sort-down"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->log_neg }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->log_blan_rut . Sistema::datos()->sistemaFindOrFail()->log_blan) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->log_blan }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->carrus_login_rut . Sistema::datos()->sistemaFindOrFail()->carrus_login) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->carrus_login }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->carrus_reque_rut . Sistema::datos()->sistemaFindOrFail()->carrus_reque) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->carrus_reque }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->carrus_rese_rut . Sistema::datos()->sistemaFindOrFail()->carrus_rese) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->carrus_rese }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->defau_img_perf_rut . Sistema::datos()->sistemaFindOrFail()->defau_img_perf) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->img_construc_rut . Sistema::datos()->sistemaFindOrFail()->img_construc) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->img_construc }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error) }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ Sistema::datos()->sistemaFindOrFail()->error }}</a>
      </div>
    </li>
  @endif
@endcanany
@canany(['sistema.notificacion.create'])
  @if(Request::route()->getName() == 'sistema.notificacion.create')
    <li class="nav-item ml-auto">
      <form method="post" action="{{ route('sistema.notificacion.eliminarFicherosNotificacion') }}" id="sistemaNotificacionEliminarFicherosNotificacion">
        @method('GET')@csrf
        {!! Form::button('<i class="far fa-trash-alt"></i> ' . __('Eliminar ficheros'), ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'id' => "btnsub", 'onclick' => "return check('btnsub', 'sistemaNotificacionEliminarFicherosNotificacion', '¡Alerta!', '¡Se eliminaran todos los ficheros!', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
    </li>
  @endif
@endcanany
@canany(['sistema.plantilla.create'])
  @if(Request::route()->getName() == 'sistema.plantilla.index')
    <li class="nav-item ml-auto">
      <a href="{{ route('sistema.plantilla.create') }}" class="btn btn-info {{ Request::is('sistema/plantilla/create') ? 'active' : '' }}">
        <i class="far fa-plus-square"></i>
        {{ __('Crear plantilla') }}
      </a>
    </li>
  @endif
@endcanany
@canany(['sistema.catalogo.create'])
  @if(Request::route()->getName() == 'sistema.catalogo.index')
    <li class="nav-item ml-auto">
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-info {{ Request::is('sistema/catalogo/create') ? 'active' : '' }}">
        <i class="far fa-plus-square"></i>
        {{ __('Registrar catálogo') }}
      </a>
    </li>
  @endif
@endcanany
@canany(['sistema.serie.create'])
  @if(Request::route()->getName() == 'sistema.serie.index')
    <li class="nav-item ml-auto">
      <a href="{{ route('sistema.serie.create') }}" class="btn btn-info {{ Request::is('sistema/serie/create') ? 'active' : '' }}">
        <i class="far fa-plus-square"></i>
        {{ __('Registrar serie') }}
      </a>
    </li>
  @endif
@endcanany