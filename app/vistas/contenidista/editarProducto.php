{{>header}}
    <h2>Producto</h2>
    {{#producto}}
    <div><strong>{{tipo}}</strong>:{{nombre}}</div>
    {{/producto}}
    <h2>Ediciones</h2>
    <table>
        <tr>
            <th>id</th>
            <th>NRO</th>
            <th>Fecha</th>
            <th>Precio</th>
            <th>Estado</th>
        </tr>
        {{#ediciones}}
        <tr>
            <td>{{id}}</td>
            <td>{{numero}}</td>
            <td>{{fecha}}</td>
            <td>{{precio}}</td>
            <td>{{estado}}</td>
        </tr>
        {{/ediciones}}
    </table>
    <div>Crear edición</div>
    {{#formularioEdicion}}
    <div class="content-form-inicio">
        <form class="formulario-crear-usuario" action="/infonete/contenidista/crearEdicion" method="POST">
            <input type="text" name="precio" placeholder="Precio...">
            <input type="hidden" name="idProducto" value="{{idProducto}}">
            <button class="ingreso-button" type="submit">Crear edición</button>
        </form>
    </div>
    {{/formularioEdicion}}

    <h2>Secciones</h2>
    <ul>
        {{#secciones}}
        <li>{{nombre}}</li>
        {{/secciones}}
    </ul>

    <div>Agregar sección</div>
    {{#formularioSeccion}}
        <div class="content-form-inicio">
            <form class="formulario-crear-usuario" action="/infonete/contenidista/agregarSeccion" method="POST">
                <input type="hidden" name="idProducto" value="{{idProducto}}">
                <input type="text" name="nombre" value="{{nombre}}" placeholder="Nombre de sección...">
                <button class="ingreso-button" type="submit">Agregar seccion</button>
            </form>
            {{>erroresCamposRequeridos}}
        </div>
    {{/formularioSeccion}}

{{>footer}}