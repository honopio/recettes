<template>
    <div class="modal" v-show="show">
      <div class="modal-background"></div>
      <div class="modal-content">
        <!-- J'inclus le component Single.vue ici-->
        <Single :recipe="recipe" />
      </div>
      <button class="modal-close is-large" aria-label="close" @click="close"></button>
    </div>
  </template>

  <script>
  import Single from './Single.vue';

  export default {
    watch: {
        show(newVal) {
        console.log('show:', newVal); // Log the new value of show
        },
    },
    components: {
      Single
    },
    props: {
      recipe: {
        type: Object,
        required: true
      },
      show: {
        type: Boolean,
        required: true
      }
    },
    methods: {
      close() {
        this.$emit('close');
      }
    }
  }
  </script>

<style scoped>
    @import './../../css/stylesheet.css';
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.1); /* background noir transparent */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-height: 90%;
        overflow: auto;
    }
</style>
