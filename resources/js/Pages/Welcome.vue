<template>
    <Layout>
    <div>
      <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Les 3 dernières recettes : </h1>
      <br>

      <div class="columns is-multiline">
        <!-- Loop through the first 3 recipes -->
        <div class="column is-4 mb-5" v-for="(recipe, index) in recipes" :key="index">
          <span><small class="has-text-grey-dark">{{ recipe.updated_at }}</small></span>
          <!-- href to the recipe url. link made grey instead of blue -->
          <a class="has-text-grey-dark" :href="'recettes/' + recipe.url">
            <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ recipe.title }}</h2>
          </a>
          <!-- Display the name of the user who created the recipe -->
          <p class="subtitle has-text-grey"><em>par {{ recipe.user.name }}</em></p>

          <!-- Display the list of ingredients -->
          <span class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> :</span>
          <span class="subtitle has-text-grey" v-for="(ingredient, key) in recipe.ingredients" :key="key">
            {{ ingredient.name }}
            <!-- Add a comma between ingredients, except for the last one -->
            <span v-if="key < recipe.ingredients.length - 1" class="subtitle has-text-grey">,</span>
          </span>

          <!-- Display the content of the recipe -->
          <br><br><p class="subtitle has-text-grey">{{ recipe.content }}</p>

          <!-- Display the tags -->
          <p class="subtitle has-text-grey">
            <strong><em>Tags</em></strong> :
            <span v-if="recipe.tags.length === 0"><em>pas de tags</em></span>
            <template v-else>
              <a :href="'tags/' + tag.name" v-for="tag in recipe.tags" :key="tag.id">
                <span class="tag">{{ tag.name }}</span>
              </a>
            </template>
          </p>

          <!-- href to the recipe url. link rendered grey instead of blue -->
          <a class="has-text-grey-dark" :href="'recettes/' + recipe.url">Read More</a>
        </div>
      </div>
    </div>
    </Layout>
  </template>

  <script>
  // Import the Layout component from resources/js/Layouts/Layout.vue
     import Layout from './Layout.vue'

    export default {
       // layout: 'Layout',
        name: 'Welcome',

        components: {
        Layout
        },
        props: {
        recipes: {
            type: Array,
            required: true
        }
        }
  }
  </script>

  <style scoped>
  /* Your CSS styles for the component go here */
  </style>
