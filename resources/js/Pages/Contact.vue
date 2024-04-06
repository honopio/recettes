<!--  FORMULAIRE DE CONTACT -->

<template>
        <Layout title="Formulaire de contact">
            <div class="tout">
                <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Contact</h1>
                <br>

                <!-- Success message -->
                <div v-if="success" class="alert alert-success">
                        <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
                </div>

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

            const success = ref('');

            const submitForm = async () => {
                try {

                    await axios.post(route('contact.store'), formData.value);
                    formData.value.name = '';
                    formData.value.email = '';
                    formData.value.message = '';
                    success.value = `Votre message a été envoyé avec succès !`;

                } catch (error) {
                    console.error(`probleme dans l\'envoi du formulaire :`, error);
                    alert("Une erreur s'est produite lors de l'envoi du message.");
                }
            };

            return {
                formData,
                submitForm,
                success,
            };
        },
    };
    </script>

    <style scoped>
        @import './../../css/stylesheet.css';

    </style>
