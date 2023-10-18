# Autenticacion en Laravel

## Ejercicio 2023-10-18

Cree lo siguiente:

* Cree un nuevo proyecto (no copie este proyecto) con el modelo "user" con los siguientes campos
  * name
  * email
  * password
  * remember_token
  * nivel (texto)
  * puedeEditar (booleano)

Para ello:

* modifique la migracion para agregar los campos faltantes.
* modifique el modelo para agregar los campos faltantes.
* Una vez migrada y creada las tablas, cree un usuario usando el tinker, y agregue todos los campos.

Luego:

* Cree un controlador con las siguientes funciones:
  * listarUsuarios
  * login (puede ver el ejemplo de este proyecto, intente no copiarlo entero)
  * logout

* Y agregue el enrutamiento con la siguiente condicion
  * listarUsuario debe requerir autenticación.
  * login tiene que tener un nombre llamado "login"

## Flujo de Laravel

request -> Kernel(Laravel) -> enrutador (web.php) -> middleware -> funcion -> response

## enrutamiento

Para que una pagina requiera autenticacion, se requiere agregar un middleware.

```php
Route::get('/',[UsuarioController::class,'index'])->middleware('auth');
```

> La página de login no debe tener autenticación.
> Si un usuario no esta logeado e intenta ingresa a alguna pagina, va a cargar la pagina llama login

```php
Route::get('/login',[UsuarioController::class,'loginGet'])->name('login');
```

## como logearse (controlador)

```php
$arreglo=['email'=>$request->post('email'),'password'=>$request->post('password')];

if (Auth::attempt($arreglo)) {
    $request->session()->regenerate(); // guardando la autenticacion.
    return redirect()->intended('/');
}
```

## como cerrar sesion (controlador)

```php
Auth::logout();
Session::flush();
```

## Como crear usuario (tinker)

Abra el tinker php artisan tinker

```php
$user = new App\Models\User;
$user->name = "admin";
$user->email= "admin@admin.com";
$user->password= Hash::make('clave');
$user->save();
```

o tambien

```php
$user = new App\Models\User('name'=>'admin','email'=>'a@b.cl','password'=>Hash::make('clave'));
$user->save();
```

## Como trabajar en la vista (Blade)

```html
@auth
<h1>Esta vista la ven todos los usuarios <b>{{auth()->user()->name}}</b></h1>
@endauth
@guest
<h1>Esta vista la ven todos los usuarios <b>-sin usuario-</b></h1>
@endguest
```
