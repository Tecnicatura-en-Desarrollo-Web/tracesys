<template>

    <div class="posts view large-10 medium-8 columns">
        <h1>Listado de informes</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>13-05-21</td>
                        <td>13:06</td>
                        <td>Pantalla Negra</td>
                        <td>En preparacion</td>
                        <td><router-link to="/detalleInforme">+</router-link></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>15-05-21</td>
                        <td>17:06</td>
                        <td>No funciona teclado</td>
                        <td>En preparacion</td>
                        <td>+</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>16-05-21</td>
                        <td>09:06</td>
                        <td>Anda Lenta</td>
                        <td>En preparacion</td>
                        <td>+</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>17-05-21</td>
                        <td>16:06</td>
                        <td>No carga bateria</td>
                        <td>En preparacion</td>
                        <td>+</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>18-05-21</td>
                        <td>12:07</td>
                        <td>No funciona wifi</td>
                        <td>En preparacion</td>
                        <td>+</td>
                    </tr>
                </tbody>
            </table>

    </div>
</template>

