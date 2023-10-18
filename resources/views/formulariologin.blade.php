<h1>login</h1>
<form method='post'>
@csrf
    correo:<input type='text' name='email'/><br/>
    clave:<input type='text' name='password'/><br/>
    <input type='submit' value='login'/>
</form>