{{>header}}
    <h2>Producto</h2>
    {{#producto}}
    <div><strong>{{tipo}}</strong>:{{nombre}}</div>
    {{/producto}}
    <h2>Secciones</h2>
    <ul>
        {{#secciones}}
        <li>{{nombre}}</li>
        {{/secciones}}
    </ul>

    <div>Agregar sección</div>
    {{#formulario}}
        <div class="content-form-inicio">
            <form action="/infonete/contenidista/agregarSeccion" method="POST">
                <input type="hidden" name="idProducto" value="{{idProducto}}">
                <input type="text" name="nombre" value="{{nombre}}" placeholder="Nombre de sección...">
                <button class="ingreso-button" type="submit">Agregar seccion</button>
            </form>
            {{>erroresCamposRequeridos}}
        </div>
    {{/formulario}}

{{>footer}}