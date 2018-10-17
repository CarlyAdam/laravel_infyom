

<li class="{{ Request::is('cines*') ? 'active' : '' }}">
    <a href="{!! route('cines.index') !!}"><i class="fa fa-edit"></i><span>Cines</span></a>
</li>

<li class="{{ Request::is('pelis*') ? 'active' : '' }}">
    <a href="{!! route('pelis.index') !!}"><i class="fa fa-edit"></i><span>Pelis</span></a>
</li>

