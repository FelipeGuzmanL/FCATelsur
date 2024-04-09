<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="home" class="simple-text logo-normal">
      {{ __('FCA Telsur') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'sitios' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('sitios.index') }}">
          <i class="material-icons">location_on</i>
            <p>{{ __('Lista de Sitios') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'cable' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cable.index') }}">
          <i class="material-icons">cable</i>
            <p>{{ __('Cables') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'cablestroncales' || $activePage == 'mufas') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons">cable</i>
          <p class="{{ ($activePage == 'cablestroncales' || $activePage == 'mufas') ? ' active' : '' }}">{{ __('Troncales') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'cablestroncales' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('cablestroncales.index')}}">
                <i class="material-icons">cable</i>
                <p>{{ __('Cables Troncales') }}</p>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'mufas' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('mufas.index')}}">
                <i class="material-icons">cable</i>
                <p>{{ __('Mufas Troncales') }}</p>
              </a>
            </li>
          </ul>
        </div>
      </li>


      <!--li class="nav-item{{ $activePage == 'cablestroncales' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cablestroncales.index')}}">
          <i class="material-icons">cable</i>
            <p>{{ __('Cables Troncales') }}</p>
        </a>
      </li-->
      <li class="nav-item{{ $activePage == 'equiposmsan' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('equiposmsan.index') }}">
          <i class="material-icons">dns</i>
            <p>{{ __('Equipos MSAN') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'mantenciones' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('mantenciones.index')}}">
          <i class="material-icons">engineering</i>
            <p>{{ __('Mantenciones') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'etiquetas' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('etiquetas.index')}}">
          <i class="material-icons">confirmation_number</i>
            <p>{{ __('Etiquetas') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'escaner' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('webcam')}}">
          <i class="material-icons">photo_camera</i>
            <p>{{ __('Escaner Etiquetas') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
