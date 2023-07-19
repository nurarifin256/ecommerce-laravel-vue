<script setup>
import { ref } from "vue";
import { useRouter } from 'vue-router';
import { loginUser } from '../../hook/authHook'

const router = useRouter();

const formData = ref({
    email: "",
    password: "",
});
const errors = ref([]);
const errEmailOrPassword = ref("")

const login = async () => {
    try {
        const response = await loginUser(formData.value);

        if (response.error) {
            if (response.message === "Wrong email or password") {
                errors.value = []
                errEmailOrPassword.value = response.message;
            } else {
                errEmailOrPassword.value = ""
                errors.value = response.message;
            }
            return false;
        }
        router.push({ path: "/dashboard" });

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
                            <input type="text" class="form-control" v-model="formData.email" placeholder="email">
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
                            <input type="password" class="form-control" v-model="formData.password" placeholder="Password"
                                autocomplete="off">
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