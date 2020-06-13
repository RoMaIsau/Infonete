{{>header}}
<div class="content-general-inicio">
    <div class="content-inicio-crear">
        <a class="inicio" href="#">INICIO DE SESIÓN</a>
        |
        <a class="crear" href="/infonete/registro">CREAR UNA CUENTA</a>
    </div>

    <div class="content-form-inicio">
        <form action="/infonete/login/ingresar" method="POST">
            {{#formularioDeLogin}}
                <input class="in-inp" type="email" id="email" placeholder="Dirección de correo electrónico" name="email" value="{{getEmail}}">
                <input class="in-inp" type="password" id="password" placeholder="Contraseña" name="password">
                <button class="ingreso-button" type="submit">INGRESAR</button>
                {{>erroresCamposRequeridos}}
            {{/formularioDeLogin}}
            {{#error}}
            <div class="error">{{mensaje}}</div>
            {{/error}}
        </form>
    </div>

    <hr>

    <div class="content-gmail-button">
        <button class="ingreso-gmail" type="submit">INGRESAR CON GMAIL</button>
    </div>

</div>
{{>footer}}