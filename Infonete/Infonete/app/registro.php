<?php
include_once ("header.php")
?>
<link rel="stylesheet" href="css/registro.css">

            <div class="content-general-inicio">
                <div class="content-registro">
                    <h2>REGISTRO DE USUARIO</h2>
                </div>

                <div class="content-form-inicio">
                    <form class="formulario-crear-usuario" action="#" method="POST">
                        <input class="in-inp" type="text" id="nombreApellido" placeholder="Nombre y apellido" name="nombreApellido">
                        <input class="in-inp" type="text" id="usuario" placeholder="Nombre de usuario" name="usuario">
                        <input class="in-inp" type="email" id="email" placeholder="Dirección de correo electrónico" name="email">
                        <input class="in-inp" type="password" id="password" placeholder="Contraseña" name="password">
                        <input class="in-inp" type="password" id="password" placeholder="Confirmar contraseña" name="password">
                        <button class="ingreso-button" type="submit">INGRESAR</button>
                    </form>

                    <div class="content-ubicacion">
                        <h3>Indique su ubicación en el mapa</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13125.94159400428!2d-58.570799930431185!3d-34.66769684723078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1591603842328!5m2!1ses-419!2sar" width="250" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>

            </div>




        </div>


<?php include_once ("footer.php")?>