<template>
  <div class="movil container">
    <div class="row justify-content-center p-4">
      <h2>Temuco</h2>
    </div>
    <div class="row justify-content-center">
      <div class="form-group">
        <label>Estación:</label>
        <select class="form-control" v-model="estacion">
          <option value="1">Padre las casas</option>
          <option value="2">Las encinas</option>
        </select>
      </div>
    </div>
    <div class="row justify-content-center">
      <button class="btn btn-primary" @click="setGases()">Cambiar estación</button>
    </div>
    <div class="row justify-content-center p-3">
      <gases :no="no" :nox="nox" :no2="no2" :co="co"></gases>
    </div>
    <div class="row justify-content-center p-2">
      <restriccion :mp2="mp2"></restriccion>
    </div>
    <rating-gauge  :mp2="mp2"></rating-gauge>

    <vue-disqus shortname="prueba-brneiuw3tb" identifier="clima" url="http://localhost:8080/"></vue-disqus>
  </div>
</template>

<script>
// @ is an alias to /src
import gases from "../components/Gases.vue";
import restriccion from "../components/Restriccion.vue";
import ratingGauge from "../components/RatingGauge.vue";
export default {
  name: "home",
  components: {
    gases,
    restriccion,
    ratingGauge
  },
  data() {
    return {
      no: 0,
      nox: 0,
      no2: 0,
      co: 0,
      estacion: "1",
      mp2: 0,
      gases: {
        plc: [
          {
            fecha: "2019-05-31 23:00:00",
            no2: "4.78"
          },
          {
            fecha: "2019-05-24 23:00:00",
            nox: "91.4558"
          },
          {
            fecha: "2019-05-24 23:00:00",
            no: "63.0673"
          },
          {
            fecha: "2019-05-31 23:00:00",
            co: "0.11"
          }
        ],
        encinas: [
          {
            fecha: "2004-04-01 01:00:00",
            no2: "0"
          },
          {
            fecha: "2004-04-01 01:00:00",
            nox: "0"
          },
          {
            fecha: "2004-04-01 01:00:00",
            no: "0"
          },
          {
            fecha: "2004-04-30 01:00:00",
            co: "8.79999"
          }
        ]
      },
      mp2Estacion: {
        plc: {
          fecha: "2019-05-31 23:00:00",
          mp2: "18"
        },
        encinas: {
          fecha: "2019-05-31 23:00:00",
          mp2: "15"
        }
      }
    };
  },
  mounted() {
    this.setGases();
  },
  methods: {
    setGases: function() {
      if (this.estacion == "1") {
        this.no = this.gases.plc[2].no;
        this.nox = this.gases.plc[1].nox;
        this.no2 = this.gases.plc[0].no2;
        this.co = this.gases.plc[3].co;
        this.mp2 = this.mp2Estacion.plc.mp2;
      } else {
        this.no = this.gases.encinas[2].no;
        this.nox = this.gases.encinas[1].nox;
        this.no2 = this.gases.encinas[0].no2;
        this.co = this.gases.encinas[3].co;
        this.mp2 = this.mp2Estacion.encinas.mp2;
      }
    }
  }
};
</script>
<style scoped>
.color-secundario {
  background-color: #83b9ff;
}
.color-principal {
  height: 100%;
  background-color: #448aff;
}
</style>

