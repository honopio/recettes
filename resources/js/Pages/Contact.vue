<template>
    <Layout title="Contact">
        <div class="tout">
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
                <div> <!-- Captcha image and input field -->
                    <!-- charger un autre captcha -->
                    <a @click="loadCaptcha()" class="has-text-grey">Charger un autre captcha</a><br><br>
                    <p v-html="captchaImage"></p><br>
                    <label for="captcha" class="subtitle has-text-grey">Saisissez le résultat : </label>
                    <input v-model="formData.captcha" type="text" name="captcha" id="captcha" class="form-control box" required>
                </div>
                <!-- Success message -->
                    <div v-if="success" class="alert alert-success">
                    <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
                </div>

                <!-- Error message -->
                <div v-if="error" class="alert alert-danger">
                    <p style="color: red; font-style: italic; font-size: 18px;">{{ error }}</p>
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
            captcha: '',
        });

        const success = ref('');
        const error = ref('');
        const captchaImage = ref('');

        const loadCaptcha = async () => {
            try {
                const response = await axios.get('/captcha', { responseType: 'blob' });
                const url = URL.createObjectURL(response.data);
                captchaImage.value = `<img src="${url}" alt="Captcha Image" />`;
            } catch (err) {
                console.err('Error fetching captcha:', error);
            }
        };

        const submitForm = async () => {
            try {

                await axios.post(route('contact.store'), formData.value);
                formData.value.name = '';
                formData.value.email = '';
                formData.value.message = '';
                formData.value.captcha = '';
                success.value = `Votre message a été envoyé avec succès !`;
                error.value = ''; // Clear any previous error message
                loadCaptcha(); //reload captcha

            } catch (err) {
                error.value = "Le captcha est incorrect. Veuillez réessayer.";
                success.value = ''; // Clear any previous success message
                loadCaptcha();
            }
        };

        onMounted(() => {
            loadCaptcha();
         });

        return {
            formData,
            submitForm,
            success,
            error,
            captchaImage,
            loadCaptcha,
        };
    },
};
</script>

<style scoped>
    @import './../../css/stylesheet.css';

</style>
