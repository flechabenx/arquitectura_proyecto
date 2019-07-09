<template>
  <div>
    <div class="row justify-content-center">
      <h1>Temuco</h1>
    </div>
    <div class="row justify-content-center">
      <datepicker :inline="true"></datepicker>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
export default {
  name: "barra-lateral",
  components: {
    Datepicker
  }
};
</script>
