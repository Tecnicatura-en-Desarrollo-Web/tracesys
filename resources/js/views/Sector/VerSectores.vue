<template>
  <div class="d-flex justify-content-center mt-5 contenido-central">
    <div
      class="ml-5 p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Listado de sectores</h2>
      <small>
        Puede ordenar los sectores a gusto, siempre respetando que no se repita
        un orden
      </small>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <table class="table table-striped">
          <thead class="table-dark">
            <tr class="cabecera-table">
              <th scope="col">Nombre sector</th>
              <th scope="col">Orden</th>
            </tr>
          </thead>
          <tbody>
            <!-- report.employee.user.sector.stage.stage_id -->
            <tr
              v-for="sector in sectores"
              :key="sector.sector_id"
              v-bind:value="sector.sector_id"
            >
              <td>{{ sector.nombre_sector }}</td>
              <td>
                <select
                  class="form-select form-select-sm"
                  aria-label=".form-select-sm example"
                  name="seleccionado[]"
                >
                  <option
                    v-for="i in cantSectores"
                    :key="i"
                    v-if="sector.orden == i"
                    disabled
                    selected
                  >
                    {{ sector.orden }}
                  </option>
                  <option v-else :key="i">{{ i }}</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
          <button class="boton-classic" type="submit">Ordenar</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import formSerialize from "form-serialize";
import Errors from "../../helpers/FormErrors.js";

export default {
  data() {
    return {
      orden: [],
      sectores: [],
      cantSectores: 0,
      contador: 1,
      etapa: 3,
    };
  },
  mounted() {
    this.obtenerCantSectores();
  },
  methods: {
    obtenerCantSectores() {
      axios.get("/api/sectors/obtenerEstadosDeEtapa/3").then((response) => {
        this.sectores = response.data.sectores;
        this.cantSectores = response.data.sectores.length;
      });
    },
    onSubmit(event) {
      let data = formSerialize(event.target, {});

      let i = 0;
      let existeIgual = false;
      while (i < this.cantSectores && existeIgual == false) {
        let j = 0;
        while (j < this.cantSectores && existeIgual == false) {
          if (i != j) {
            if (data.seleccionado[i] == data.seleccionado[j]) {
              existeIgual = true;
            }
          }
          j++;
        }
        i++;
      }
      if (existeIgual) {
        this.$swal({
          title: "Hay un orden repetido. Por favor acomodelos",
          type: "error",
          timer: 1500,
        });
      } else {
        let data2 = formSerialize(event.target, {
          hash: false,
          empty: true,
        });
        axios
          .post("/api/sectors/actualizarOrden", data2, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
          })
          .then((response) => {
            console.log(response);
            if (response.data.message) {
              this.$swal({
                title: "Sectores ordenados correctamente",
                type: "success",
                timer: 1500,
              }).then((result) => {
                this.$router.push("/home");
              });
            }
          });
      }
    },
  },
};
</script>
