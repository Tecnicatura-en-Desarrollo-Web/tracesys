<template>
    <div class="posts view large-10 medium-8 columns">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Fecha y hora</th>
                    <th scope="col">Derivado Por</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Comentario</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>13-05-21 13:06</td>
                    <td>Atencion al cliente</td>
                    <td>Entrante</td>
                    <td>Pantalla negra</td>
                    <td>Cada vez que el cliente quiere encenderla tira error y se reinicia</td>
                </tr>
                <tr>
                    <td>13-05-21 13:06</td>
                    <td>Diagnosticador</td>
                    <td>En preparacion</td>
                    <td>Pantalla negra</td>
                    <td>Reinstalar windows</td>
                </tr>
                <tr>
                    <td>13-05-21 13:06</td>
                    <td>Tecnico</td>
                    <td>En reparacion</td>
                    <td>Pantalla negra</td>
                    <td>Windows 10 reinstalado</td>
                </tr>

            </tbody>
        </table>
        <div class="row align-items-center">
            <div class="col col-lg-2">
                <h5>Derivar a:</h5>
            </div>
            <div class="col col-lg-10">
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="row align-items-center mt-2">
            <div class="col col-lg-2">
                <h5>Sugerencias:</h5>
            </div>
            <div class="col col-lg-10">
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="row align-items-center mt-2">
            <div class="col col-lg-2">
                <h5>Comentarios:</h5>
            </div>
            <div class="col col-lg-10">
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col col-lg-2">
                <button class="btn btn-primary">Derivar</button>
            </div>

        </div>


    </div>
</template>

