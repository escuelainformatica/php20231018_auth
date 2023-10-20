# Autenticacion en Laravel

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

##  2. <a name='FlujodeLaravel'></a>Flujo de Laravel

request -> Kernel(Laravel) -> enrutador (web.php) -> middleware -> funcion -> response

##  3. <a name='enrutamiento'></a>enrutamiento

Para que una pagina requiera autenticacion, se requiere agregar un middleware.

```php
Route::get('/',[UsuarioController::class,'index'])->middleware('auth');
```

> La página de login no debe tener autenticación.
> Si un usuario no esta logeado e intenta ingresa a alguna pagina, va a cargar la pagina llama login

```php
Route::get('/login',[UsuarioController::class,'loginGet'])->name('login');
```

##  4. <a name='comologearsecontrolador'></a>como logearse (controlador)

```php
$arreglo=['email'=>$request->post('email'),'password'=>$request->post('password')];

if (Auth::attempt($arreglo)) {
    $request->session()->regenerate(); // guardando la autenticacion.
    return redirect()->intended('/');
}
```

##  5. <a name='comocerrarsesioncontrolador'></a>como cerrar sesion (controlador)

```php
Auth::logout();
Session::flush();
```

##  6. <a name='Comocrearusuariotinker'></a>Como crear usuario (tinker)

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

##  7. <a name='ComotrabajarenlavistaBlade'></a>Como trabajar en la vista (Blade)

```html
@auth
<h1>Esta vista la ven todos los usuarios <b>{{auth()->user()->name}}</b></h1>
@endauth
@guest
<h1>Esta vista la ven todos los usuarios <b>-sin usuario-</b></h1>
@endguest
```

## guard
Guard no son roles, cuando se trabaja con guardias, se crea un canal diferente de autenticacion (tablas distintas y configuraciones distintas)

### Como crear un guard?

En la carpeta config, editar auth.php y agregar lo siguiente:

* 'guards' en este campo, agregar el nuevo guardia con el driver y proveedor deseado. Se puede crear un nuevo proveedor.

* 'providers' en este caso se agrega el proveedor.
* 'passwords' se indica como  se van a trabajar con las tablas.

### Como usarlo?

Cuando se autentica, se puede determinar el guardia. Por defecto el guardia es web:

```php
 if (Auth::guard('admin')->attempt($arreglo)) {
```

En el enrutamiento, se puede autenticar filtrando por el guardia

```php
Route::middleware('auth:admin')->...
```

## Crear un middleware

En consola:

```
php artisan make:middleware Middle1
```

Luego, edita el middleware con la funcion que desee. Si quiere un argumento, se puede agregar como un string, en el ejercicio siguiente se llama $role.

```php
    public function handle(Request $request, Closure $next, string $role='user'): Response
    {
        if($request->user()->nivel===$role) {
            return $next($request);
        }
        return redirect('login');
    }
```

### Para ocupar el middleware

Se puede usar de la siguiente manera (":admin" es el parametro opcional)

```php
Route>middleware(MiddleClase::class.':admin')->...
```

Para cortar el nombre del middleware y no poner la clase, en kernel.php se puede agregar un alias del middleware:

```php
    protected $middlewareAliases = [
        'nivel'=>Middle1::class,
```

Una vez que esta el alias, se puede escribir como:

```php
Route>middleware('nivel:admin')->...
```
