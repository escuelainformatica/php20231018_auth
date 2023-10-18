@auth
<h1>Esta vista la ven todos los usuarios <b>{{auth()->user()->name}}</b></h1>
@endauth
@guest
<h1>Esta vista la ven todos los usuarios <b>-sin usuario-</b></h1>
@endguest