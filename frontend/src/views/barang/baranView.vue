<template>
    <div>
        <input type="text" v-model="searchKeyword" @input="searchUsers" placeholder="Search users...">

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                </tr>
            </tbody>
        </table>

        <div>
            <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
            <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
        </div>
    </div>
</template>
  
<script setup>
import axios from 'axios';
import { ref, reactive } from 'vue';

const users = ref([]);
const searchKeyword = ref('');
const currentPage = ref(1);
const totalPages = ref(0);

const fetchUsers = () => {
    axios.get(`/api/users?page=${currentPage.value}`)
        .then(response => {
            users.value = response.data.data;
            totalPages.value = response.data.last_page;
        })
        .catch(error => {
            console.error(error);
        });
};

const searchUsers = () => {
    axios.get(`/api/users/search?keyword=${searchKeyword.value}&page=${currentPage.value}`)
        .then(response => {
            users.value = response.data.data;
            totalPages.value = response.data.last_page;
        })
        .catch(error => {
            console.error(error);
        });
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        fetchUsers();
    }
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
        fetchUsers();
    }
};

// Fetch users when component is mounted
onMounted(fetchUsers);

// Export data and methods to be used in template
return { users, searchKeyword, currentPage, totalPages, searchUsers, prevPage, nextPage };
</script>
  