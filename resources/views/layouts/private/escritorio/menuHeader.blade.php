<ul class="navbar-nav">
  <li class="nav-item">
    <span class="pantallaMax985px">
      <layouts-menu-header></layouts-menu-header>
    </span>
    <span class="pantallaMin985px">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </span>
  </li>
  @if(Request::route()->getName() != 'home')
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('home') }}" class="nav-link">
        <i class="fas fa-home"></i>
        {{ __('Inicio') }}
      </a>
    </li>
  @endif
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link" data-toggle="modal" data-target="#contacto" data-backdrop="static" data-keyboard="false">
      <i class="fas fa-question"></i>
      {{ __('Contacto') }}
    </a>
  </li>
  <li class="nav-item">
    <a href="javascript:location.reload()" class="nav-link" title="{{ __('Recargar') }}"><i class="fas fa-sync"></i></a>
  </li>
</ul>
<ul class="navbar-nav ml-auto">
  @include('layouts.private.menuHeaderNotificaciones')
  @if(Request::route()->getName() != 'home')
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
    </li>
  @endif
</ul>