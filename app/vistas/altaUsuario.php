{{>header}}

    <div class="content-form-inicio">
        <form class="formulario-crear-usuario" action="/infonete/administracion/registrarUsuario" method="POST" >
            {{#formulario}}
            <input class="in-inp" type="text" id="nombre" placeholder="Nombre" name="nombre" value="{{getNombre}}">
            <input class="in-inp" type="text" id="apellido" placeholder="Apellido" name="apellido" value="{{getApellido}}">
            <input class="in-inp" type="email" id="email" placeholder="Correo electrónico" name="email" value="{{getEmail}}">
            <select class="in-inp" name="rol" value="{{getRol}}">
                {{#roles}} <option value="{{id}}"> {{descripcion}} </option> {{/roles}}
            </select>
            <input class="in-inp" type="password" id="password" placeholder="Contraseña" name="password" value="{{getPassword}}">
            <input class="in-inp" type="password" id="password" placeholder="Confirmar contraseña" name="passwordRepetida" value="{{getPasswordRepetida}}">
            <button class="ingreso-button" type="submit">REGISTRAR</button>
            {{>erroresCamposRequeridos}}
            {{/formulario}}

            {{#error}}
            <div class="error">{{mensaje}}</div>
            {{/error}}
        </form>
    </div>
{{>footer}}