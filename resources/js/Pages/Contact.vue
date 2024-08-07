<template>
    <Layout title="Contact">
        <div class="tout">
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
                <div> <!-- Captcha image and input field -->
                    <label for="captcha" class="subtitle has-text-grey">Captcha</label>
                    <p v-html="captchaImage"></p>
                    <input v-model="formData.captcha" type="text" name="captcha" id="captcha" class="form-control box" required>
                    <button type="button" @click="refreshCaptcha">Refresh Captcha</button>
                </div>
                <br> <!-- Submit button -->
                <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Submit</button>
            </form>
        </div>
    </Layout>
</template>

<script>
import { ref, onMounted } from 'vue';
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
            captcha: '', // Add captcha to form data
        });

        const success = ref('');
        const captchaImage = ref('');

        const fetchCaptcha = async () => {
            try {
                const response = await axios.get('/contact');
                captchaImage.value = response.data;
            } catch (error) {
                console.error('Error fetching captcha:', error);
                alert('Failed to load captcha. Please try again later.');
            }
        };

        const refreshCaptcha = () => {
            fetchCaptcha();
        };

        const submitForm = async () => {
            try {
                await axios.post(route('contact.store'), formData.value);
                formData.value.name = '';
                formData.value.email = '';
                formData.value.message = '';
                formData.value.captcha = ''; // Clear captcha input
                success.value = 'Votre message a été envoyé avec succès !';
                fetchCaptcha(); // Refresh captcha after form submission
            } catch (error) {
                console.error('Probleme dans l\'envoi du formulaire :', error);
                alert("Une erreur s'est produite lors de l'envoi du message.");
            }
        };

        onMounted(() => {
            fetchCaptcha(); // Fetch captcha when component is mounted
        });

        return {
            formData,
            submitForm,
            success,
            captchaImage,
            refreshCaptcha,
        };
    },
};
</script>

<style scoped>
@import './../../css/stylesheet.css';
</style>
