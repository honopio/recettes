<!-- COMPONENT POUR LISTE DE RECETTES
    Affiche les recettes dans une grille de 3 colonnes.
    Sert pour la page de display des recettes et les pages de recherche. -->

<template>
    <Layout>
    <div class="tout">

      <br>
      <!-- If recipes is undefined or empty -->
      <template v-if="!recipes || recipes.length === 0">
        <p>No recipes found</p>
      </template>

      <!-- Display recipes if available -->
      <template v-else>
        <div class="columns is-multiline">
          <!-- Loop through each recipe -->
          <div class="column is-4 mb-5" v-for="recipe in recipes" :key="recipe.id">
            <span><small class="has-text-grey-dark">{{ recipe.updated_at }}</small></span>
      <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">
        <a href="#" @click.prevent="console.log('Title clicked'); openModal(recipe)" class="has-text-grey-dark">{{ recipe.title }}</a>
        </h2>
            <!-- Display the user who created the recipe. "user" a été passé dans le controller -->
            <p class="subtitle has-text-grey"><em>par {{ recipe.user.name }}</em></p>


            <!-- Display the list of ingredients -->
            <span class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> : </span>
            <span class="subtitle has-text-grey" v-for="(ingredient, key) in recipe.ingredients" :key="key">
                <Link class="has-text-grey-dark" :href="`/recettes/search?recipe=${ingredient.name}`">{{ ingredient.name }}</Link>
                <!-- Add a comma between ingredients (after every ingredient, except for the last one)-->
                <span v-if="key < recipe.ingredients.length - 1" class="subtitle has-text-grey">, </span>
            </span>

            <!-- Display the content of the recipe -->
            <br><br>
            <p class="subtitle has-text-grey">{{ recipe.content.substring(0, 250) }}...</p>

            <!-- Display the tags -->
            <p class="subtitle has-text-grey">
            <strong><em>Tags</em></strong> :
            <!-- If there are no tags, say "pas de tags" -->
            <span v-if="!recipe.tags || recipe.tags.length === 0">pas de tags</span>
            <!-- If there are tags, display them -->
            <template v-else>
                <span v-for="tag in recipe.tags" :key="tag.id">
                    <Link :href="`/tags/${tag.name}`" class="tag">{{ tag.name }}</Link>
                </span>
            </template>
            </p>

            <!-- Link to the recipe URL -->
            <Link class="has-text-grey-dark" :href="`/recettes/${recipe.url}`"><em>> Lire en entier <</em></Link>
          </div>
        </div>
      </template>
    </div>
    </Layout>
        <!-- Modal component -->
        <Modal :key="isModalOpen" :show="isModalOpen" :recipe="selectedRecipe" v-if="isModalOpen" @close="closeModal" />  </template>

  <script>
  import Layout from './Layout.vue';
  import { Link } from '@inertiajs/inertia-vue3';
  import Modal from './Modal.vue';

  export default {
    name: 'Recipes.vue',
    components: {
        Link,
        Layout,
        Modal,
    },
    props: {
      recipes: {
        type: Array,
        required: true
      },
    },
    data() {
      return {
        isModalOpen: false,
        selectedRecipe: null,
      };
    },
    methods: {
      openModal(recipe) {
        // Open the modal and set the selected recipe
        console.log('openModal called'); // Log a message when openModal is called
        this.selectedRecipe = recipe;
        this.isModalOpen = true;
        console.log('selectedRecipe:', this.selectedRecipe); // Log the selected recipe (for debugging purposes
      },
      closeModal() {
        // Close the modal
        console.log('openModal called'); // Log a message when openModal is called

        this.isModalOpen = false;
        this.selectedRecipe = null;
      },
    },
  }
  </script>

  <style scoped>
    @import './../../css/stylesheet.css';

  </style>
