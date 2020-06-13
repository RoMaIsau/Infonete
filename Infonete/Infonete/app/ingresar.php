<?php
include_once ("header.php")
?>
<link rel="stylesheet" href="css/ingresar.css">

            <div class="content-general-inicio">
                <div class="content-inicio-crear">
                    <a class="inicio" href="#">INICIO DE SESIÓN</a>
                    <a class="crear" href="registro.php">CREAR UNA CUENTA</a>
                </div>

                <div class="content-form-inicio">
                    <form action="#" method="POST">
                        <input class="in-inp" type="email" id="email" placeholder="Dirección de correo electrónico" name="email">
                        <input class="in-inp" type="password" id="password" placeholder="Contraseña" name="password">
                        <button class="ingreso-button" type="submit">INGRESAR</button>
                    </form>
                </div>

                <hr>

                <div class="content-gmail-button">
                    <button class="ingreso-gmail" type="submit">INGRESAR CON GMAIL</button>
                </div>

            </div>

   


        </div>

        <br>

<?php include_once ("footer.php")?>