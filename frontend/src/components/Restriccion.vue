<template>
  <div style="height:50%">
    <div v-if="mp2>110" >
      <h3>Con restricción</h3>
      <div class="row justify-content-center">
        <div class="col align-self-end">
          <img src="../assets/restriccion.png" class="imagen" />
        </div>
      </div>
    </div>
    <div v-else >
      <h3>Sin restricción</h3>
      <div class="row justify-content-center">
        <div class="col align-self-end">
          <img src="../assets/sinrestriccion.png" class="imagen" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "restriccion",
  props: ["mp2"]
};
</script>

<style scoped>

.imagen {
  width: 50%;
  height: 50%;
}
</style>