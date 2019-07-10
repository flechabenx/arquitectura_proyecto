<template>
  <div>
    <div class="row justify-content-center">
      <h3>Calidad del aire</h3>
    </div>
    <div>
      <fusioncharts
        :type="type"
        :width="width"
        :height="height"
        :dataFormat="dataFormat"
        :dataSource="dataSource"
      ></fusioncharts>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  name: "rating-gauge",
  data: () => ({
    type: "angulargauge",
    width: "100%",
    height: "100%",
    dataFormat: "json",
    dataSource: {
      chart: {
        origw: "380",
        origh: "250",
        gaugestartangle: "135",
        gaugeendangle: "45",
        gaugeoriginx: "190",
        gaugeoriginy: "220",
        gaugeouterradius: "190",
        theme: "fusion",
        showvalue: "1",
        numbersuffix: " MP 2.5",
        valuefontsize: "25"
      },
      colorrange: {
        color: [
          {
            minvalue: "0",
            maxvalue: "50",
            code: "#62B58F"
          },
          {
            minvalue: "51",
            maxvalue: "79",
            code: "#FFC533"
          },
          {
            minvalue: "80",
            maxvalue: "109",
            code: "#FFB600"
          },
          {
            minvalue: "110",
            maxvalue: "169",
            code: "#F2726F"
          },
          {
            minvalue: "170",
            maxvalue: "200",
            code: "#5803A9"
          }
        ]
      },
      dials: {
        dial: [
          {
            value: "",
            tooltext: "Moderate Pressure"
          }
        ]
      }
    }
  }),
  props: ["mp2"],
  methods: {
    setMp2: function() {
      this.dataSource.dials.dial[0].value = this.mp2;
    }
  },
  mounted(){
    this.setMp2();
  },
  watch: {
    mp2: {
      handler: function() {
        this.setMp2();
      },
      deep: true
    }
  }
};
</script>
