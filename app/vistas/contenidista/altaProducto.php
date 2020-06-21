{{>header}}
    <h1>Alta de producto</h1>
    <div class="content-form-inicio">
        {{#formulario}}
        <form class="formulario-crear-usuario" action="/infonete/contenidista/crearProducto" method="POST">
            <input class="in-inp" type="text" name="nombre" placeholder="Nombre...">
            <input class="in-inp" type="text" name="precio" placeholder="Precio...">
            <select name="tipoProducto">
                {{#tiposDeProducto}}
                <option value="{{id}}">{{nombre}}</option>
                {{/tiposDeProducto}}
            </select>
            <button class="ingreso-button" type="submit">Crear</button>
        </form>
        {{>erroresCamposRequeridos}}
        {{/formulario}}
    </div>
{{>footer}}
