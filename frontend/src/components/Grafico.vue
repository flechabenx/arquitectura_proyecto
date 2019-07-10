<template>
  <div style="height:50%; width: 100%">
    <fusioncharts
      :type="type"
      :width="width"
      :height="height"
      :dataFormat="dataFormat"
      :dataSource="dataSource"
    ></fusioncharts>
  </div>
</template>

<script>
export default {
  name: "grafico",
  props: ["dataTemp", "dataHum", "category"],
  data: () => ({
    type: "scrollcolumn2d",
    width: "100%",
    height: "100%",
    dataFormat: "json",
    dataSource: {
      chart: {
        caption: "Temperatura y humedad",
        yaxisname: "Valores",
        numvisibleplot: "10",
        labeldisplay: "auto",
        theme: "fusion"
      },
      categories: [
        {
          category: []
        }
      ],
      dataset: [
        {
          seriesname: "Temperatura",
          data: []
        },
        {
          seriesname: "Humedad",
          data: []
        }
      ]
    }
  }),
  methods: {
    setData: function() {
      this.dataSource.categories[0].category = this.category;
      this.dataSource.dataset[0].data = this.dataTemp;
      this.dataSource.dataset[1].data = this.dataHum;
    }
  },
  mounted () {
    this.setData;
  },
  watch: {
    dataTemp: {
      handler: function() {
        this.dataSource.dataset[0].data = this.dataTemp;
      },
      deep: true
    },
    dataHum:{
      handler: function() {
        this.dataSource.dataset[1].data = this.dataHum;
      },
      deep: true
    },
    category:{
      handler: function() {
        this.dataSource.categories[0].category = this.category;
      },
      deep: true
    }
  }
};
</script>
