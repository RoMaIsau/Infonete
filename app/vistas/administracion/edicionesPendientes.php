{{>header}}
<div class="container-fluid mt-3">
    <h3>Ediciones pendientes de aprobación</h3>
    <table class="table">
        <tr>
            <th scope="col">id</th>
            <th scope="col">NRO</th>
            <th scope="col">Fecha</th>
            <th scope="col">Precio</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        {{#ediciones}}
        <tr>
            <td scope="row">{{id}}</td>
            <td>{{numero}}</td>
            <td>{{fecha}}</td>
            <td>{{precio}}</td>
            <td>{{estado}}</td>
            <td>
                {{#puedeAprobarse}}
                <form action="/infonete/administracion/aprobarEdicion" method="POST">
                    <input type="hidden" name="idEdicion" value="{{id}}">
                    <button type="submit" class="btn btn-primary btn-sm">Aprobar</button>
                </form>
                {{/puedeAprobarse}}
            </td>
        </tr>
        {{/ediciones}}
    </table>
</div>
{{>footer}}