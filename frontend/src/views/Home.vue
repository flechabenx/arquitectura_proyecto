<template>
  <div class="home container-fluid">
    <div class="row justify-content-end p-3 d-sm-none">
      <router-link to="/movil">Versión movil</router-link>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="row p-5 justify-content-center">
          <h1>Temuco</h1>
        </div>
        <div class="row justify-content-center">
          <div class="form-group">
            <label>Estación</label>
            <select class="form-control" v-model="estacion">
              <option value="1">Padre las casas</option>
              <option value="2">Las encinas</option>
            </select>
          </div>
        </div>
        <div class="row justify-content-center p-5">
          <label>Seleccionar fecha:</label>
          <input type="date" v-model="fecha" />
        </div>
        <div class="row justify-content-center p-2">
          <label class="radio-inline p-2">
            <input type="radio" value="1" v-model="rango" />Dia
          </label>
          <label class="radio-inline p-2">
            <input type="radio" value="2" v-model="rango" />Semana
          </label>
          <label class="radio-inline p-2">
            <input type="radio" value="3" v-model="rango" />Mes
          </label>
        </div>

        <div class="row justify-content-center p-5">
          <button class="btn btn-primary" @click="obtenerData()">Consultar</button>
        </div>
      </div>
      <div class="col-md-9">
        <div class="row">
          <grafico :dataTemp="dataTemp" :dataHum="dataHum" :category="category"></grafico>
        </div>
        <div class="row">
          <div class="col-md-4">
            <gases :no="no" :nox="nox" :no2="no2" :co="co"></gases>
          </div>
          <div class="col-md-4">
            <restriccion :mp2="mp2"></restriccion>
          </div>
          <div class="col-md-4">
            <rating-gauge :mp2="mp2"></rating-gauge>
          </div>
        </div>
      </div>
    </div>
    <div >
      <vue-disqus shortname="prueba-brneiuw3tb" identifier="clima" url="http://localhost:8080/"></vue-disqus>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import grafico from "../components/Grafico.vue";
import gases from "../components/Gases.vue";
import restriccion from "../components/Restriccion.vue";
import ratingGauge from "../components/RatingGauge.vue";
export default {
  name: "home",
  components: {
    grafico,
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
      fecha: "2018-09-07",
      rango: "1",
      mp2: 0,
      dataTemp: [],
      dataHum: [],
     category: [] 
    };
  },
  mounted() {
    this.obtenerData()
  },
  methods: {
    obtenerData: async function() {
      try {
        await this.$http
          .get("http://localhost:8000/api/medicion/gas/", {
            params: {
              estacion: this.estacion
            }
          })
          .then(response => {
            this.no2 = response.data[0].no2;
            this.nox = response.data[1].nox;
            this.no = response.data[2].no;
            this.co = response.data[3].co;
          });
        await this.$http
          .get("http://localhost:8000/api/medicion/mp2/", {
            params: {
              estacion: this.estacion
            }
          })
          .then(response => {
            this.mp2 = response.data[0].mp2;
          });
        await this.$http
          .get("http://localhost:8000/api/medicion/data/", {
            params: {
              fecha: this.fecha,
              limite: this.rango,
              estacion: this.estacion
            }
          })
          .then(response => {
             this.dataTemp = [];
            this.dataHum = [];
            this.category = [];
            if (this.rango == "1") {
              for (let index = response.data.length - 1; index >= 0; index--) {
                if (response.data[index].temperatura) {
                  this.dataTemp.push({
                    value: response.data[index].temperatura
                  });
                }
              }
              for (let index = response.data.length - 1; index >= 0; index--) {
                if (response.data[index].humedad) {
                  this.dataHum.push({ value: response.data[index].humedad });
                }
              }

              for (let horas = 0; horas < 24; horas++) {
                this.category.push({ label: horas + ":00 hrs" });
              }
            }else{
              if (this.rango=="2") {
                 for (let index = response.data.length - 1; index >= 0; index--) {
                if (response.data[index].temperatura) {
                  this.dataTemp.push({
                    value: response.data[index].temperatura
                  });
                }
              }
              for (let index = response.data.length - 1; index >= 0; index--) {
                if (response.data[index].humedad) {
                  this.dataHum.push({ value: response.data[index].humedad });
                }
              }

              for (let dias = 0; dias < 6; dias++) {
                this.category.push({ label: response.data[dias].fecha});
              }
              }else{
                if (this.rango=="3") {
                 for (let index = response.data.length - 1; index >= 0; index--) {
                if (response.data[index].temperatura) {
                  this.dataTemp.push({
                    value: response.data[index].temperatura
                  });
                }
              }
              for (let index = response.data.length - 1; index >= 0; index--) {
                if (response.data[index].humedad) {
                  this.dataHum.push({ value: response.data[index].humedad });
                }
              }

              for (let dias = 0; dias < 30; dias++) {
                this.category.push({ label: response.data[dias].fecha});
              }
              }
              }
            }
            console.log(response.data);
          });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
<style scoped>

</style>

