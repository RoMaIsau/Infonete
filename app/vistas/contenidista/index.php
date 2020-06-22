{{>header}}
    <a href="/infonete/contenidista/altaProducto">Crear producto</a>
    <table>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        {{#productos}}
        <tr>
            <td>{{id}}</td>
            <td>{{nombre}}</td>
            <td>{{tipo}}</td>
            <td>${{precio}}</td>
            <td><a href="/infonete/contenidista/editarProducto?id={{id}}">Editar</a></td>
        </tr>
        {{/productos}}
        {{^productos}}
        <tr><td>No tenes productos creados</td></tr>
        {{/productos}}
    </table>
{{>footer}}