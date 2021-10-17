<template>
  <div class="large-10 medium-8 columns">
    <h1>Cargar Informe</h1>
    <form>
      <div class="row callout callout-danger bg-light">
        <h5>Datos del cliente</h5>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Nombre y apellido o razon social<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >CUIT<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="product_name"
              >Email<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-2 col-12">
          <div class="form-group">
            <label for="product_name"
              >Telefono<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Dirección<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <hr />
        <h5>Datos del producto</h5>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Tipo<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Marca<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Modelo<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Motivo de la reparación<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" required />
            <div id="emailHelp" class="form-text">
              Debe agregar el problema en palabras claves, por ejemplo:
              "Pantalla negra"
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Seleccione prioridad<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="flexRadioDefault"
                id="flexRadioDefault1"
              />
              <label class="form-check-label" for="flexRadioDefault1">
                Alta
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="flexRadioDefault"
                id="flexRadioDefault1"
              />
              <label class="form-check-label" for="flexRadioDefault1">
                Normal
              </label>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="product_name"
              >Comentarios<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <textarea class="form-control" style="height: 100px" required />
          </div>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center mt-3">
        <button
          type="submit"
          class="btn btn-success text-uppercase"
          id="button_submit"
        >
          Crear
        </button>
      </div>
    </form>
  </div>
</template>