<template>
  <div>
    <h4>Nivel de los gases</h4>
    <br>
    <p class="">NO:</p>
    <div class="progress">
      <div class="progress-bar" :style="{width: no + '%' }"></div>
    </div>
    <p class="">NOX:</p>
    <div class="progress">
      <div class="progress-bar" :style="{width: nox + '%' }"></div>
    </div>
    <p class="">NO2:</p>
    <div class="progress">
      <div class="progress-bar" :style="{width: no2 + '%' }"></div>
    </div>
    <p class="">CO:</p>
    <div class="progress">
      <div class="progress-bar" :style="{width: co + '%' }"></div>
    </div>
    <br>
  </div>
</template>

<script>
export default {
  name: "gases",
  props : ['no' , 'nox', 'no2', 'co']
};
</script>

<style scoped>
</style>