<script setup>
import { ref } from "vue";
import { useRouter } from 'vue-router';
import api from "../../api"

const router = useRouter();

const email = ref("")
const password = ref("")
const errEmailOrPassword = ref("")
const errors = ref([]);

const login = async () => {
    try {
        let formData = new FormData();
        formData.append("email", email.value)
        formData.append("password", password.value)

        await api.post('/api/auth/login', formData)
            .then((res) => {
                if (res.data.message == "Wrong email or password") {
                    errEmailOrPassword.value = res.data.message
                }
                localStorage.setItem('user', res.data.data)
                router.push({ path: "/dashboard" })
            })
            .catch((err) => {
                if (err.response) {
                    errors.value = err.response.data.errors;
                }
            })

    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="login-box">

            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <div v-if="errEmailOrPassword" class="alert alert-danger mt-2">
                        <span>{{ errEmailOrPassword }}</span>
                    </div>
                    <form @submit.prevent="login()">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="email" placeholder="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div v-if="errors.email" class="alert alert-danger mt-2">
                            <span>{{ errors.email[0] }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" v-model="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div v-if="errors.password" class="alert alert-danger mt-2">
                            <span>{{ errors.password[0] }}</span>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>
                </div>

            </div>

        </div>
    </div>
</template>