{{>header}}
<div class="container-fluid mt-4">
    <div class="container-fluid mt-z">
        <h2>Detalle de edición</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Precio</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            {{#edicion}}
            <tr>
                <th scope="row">{{numero}}</th>
                <td>{{#producto}}{{nombre}}{{/producto}}</td>
                <td>{{#producto}}{{tipo}}{{/producto}}</td>
                <td>{{precio}}</td>
                <td>{{fecha}}</td>
                <td>{{estado}}</td>
            </tr>
            {{/edicion}}
            </tbody>
        </table>
    </div>
    <div class="container-fluid mt-2">
        <h2>Noticias redactadas</h2>
        <div class="card-deck">
            {{#vistaPreviaNoticias}}
                <div class="card">
                    <div class="embed-responsive embed-responsive-16by9">
                    <img class="card-img-top embed-responsive-item" src="{{ubicacion}}" alt="{{ubicacion}}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{titulo}}</h5>
                        <p class="card-text">{{seccion}}</p>
                        <a href="#" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            {{/vistaPreviaNoticias}}
        </div>
    </div>
    <div class="container-fluid mt-2">
        <h2>Redacción de noticia</h2>
        <form action="/infonete/contenidista/redactar" enctype="multipart/form-data" method="post">
            <input type="hidden" name="idEdicion" value="{{#edicion}}{{id}}{{/edicion}}">
            <div class="form-group">
                <label for="seccion">Sección</label>
                <select class="form-control" id="seccion" name="seccion">
                    {{#secciones}}
                    <option value="{{id}}">{{nombre}}</option>
                    {{/secciones}}
                </select>
            </div>
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" placeholder="Titulo..." name="titulo">
            </div>
            <div class="form-group">
                <label for="subtitulo">Subtítulo</label>
                <input type="text" class="form-control" id="subtitulo" placeholder="Subtitulo..." name="subtitulo">
            </div>
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea class="form-control" id="contenido" rows="3" name="contenido"></textarea>
            </div>
            <div class="form-group">
                <label for="imagenes">Imágenes (Seleccione una o más)</label>
                <input id="imagenes" class="form-control-file" type="file" name="imagenes[]" multiple>
            </div>
            <div class="form-group">
                <label for="linkSitio">Link a sitio web</label>
                <input type="text" class="form-control" id="linkSitio" placeholder="Link..." name="link">
            </div>
            <div class="form-group">
                <label for="linkVideo">Link a video</label>
                <input type="text" class="form-control" id="linkVideo" placeholder="Link a video..." name="linkVideo">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Redactar</button>
        </form>
    </div>
</div>
{{>footer}}
