<template>
  <div class="container">
    <span>Stock bajo de un repuesto!</span>
    <button
      class="action btn btn-light"
      @click.stop="clicked"
    >ver</button>
  </div>
</template>

<script>
export default {
  methods: {
    clicked() {
      alert("Clicked!");
    }
  }
};
</script>
