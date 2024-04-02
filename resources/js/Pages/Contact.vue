<template>
    <Layout>
      <div class="tout">
        <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Contact</h1>
        <br>
        <form @submit.prevent="submitForm">
          <div> <!-- Name input field -->
            <label for="name" class="subtitle has-text-grey">Nom</label>
            <input v-model="formData.name" type="text" id="name" class="form-control box" required>
          </div>
          <br>
          <div> <!-- Email input field -->
            <label for="email" class="subtitle has-text-grey">Email</label>
            <input v-model="formData.email" type="email" id="email" class="form-control box" required>
          </div>
          <br>
          <div> <!-- Message textarea -->
            <label for="message" class="subtitle has-text-grey">Comment pouvons-nous vous aider?</label>
            <textarea v-model="formData.message" id="message" class="form-control textarea box" required rows="5"></textarea>
          </div>
          <br> <!-- Submit button -->
          <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Submit</button>
        </form>
      </div>
    </Layout>
  </template>

  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
    import Layout from './Layout.vue';

  export default {
    components: {
      Layout,
    },
    setup() {
      const formData = ref({
        name: '',
        email: '',
        message: '',
      });

      const router = useRouter();

      const submitForm = async () => {
        try {
          await axios.post(route('contact.store'), formData.value);
          formData.value.name = '';
          formData.value.email = '';
          formData.value.message = '';
          alert('Message envoyé');
        } catch (error) {
          console.error('Error submitting form:', error);
          alert("Une erreur s'est produite lors de l'envoi du message.");
        }
      };

      return {
        formData,
        submitForm,
      };
    },
  };
  </script>

  <style scoped>
  /* margin right and left to the whole page */
  .tout {
      margin-right: 1rem;
      margin-left: 1rem;
  }

  .subtitle {
      display: block;
  }

  textarea {
      width: 80%; /* Set the width of the message textarea to 80% */
  }

  .btn { /* Style the submit button */
      background-color: #f5f5f5;
      color: #363636;
      border: 1px solid #363636;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
  }

  .btn:hover {
      background-color: #a5a5a5;
      color: #000000;
  }

  .box { /* Style the boxes. used for comments, input fields, textareas */
      border: 1px solid #f5f5f5;
      padding: 10px;
      margin-bottom: 20px;
  }

  .box:hover {
      border: 1px solid #363636;
  }

  .textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      margin-bottom: 20px;
  }

  .textarea:hover {
      border: 1px solid #363636;
  }
  </style>
