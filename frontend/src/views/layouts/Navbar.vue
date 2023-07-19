<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav ml-auto">


            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="card" style="width: 18rem;">
                        <img src="../../assets/logoo.png" class="card-img-top" style="height: 250px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ user?.user.name }}</h5><br>
                            <button @click="logout" class="btn btn-primary">Logout</button>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </nav>
</template>

<script>
import api from '../../api';

export default {
    name: 'Navbar',
    data() {
        return {
            user: null
        };
    },
    mounted() {
        this.getUserFromLocalStorage();
    },
    methods: {
        getUserFromLocalStorage() {
            const userData = localStorage.getItem('user');
            if (userData) {
                this.user = JSON.parse(userData);
            }
        },
        async logout() {
            try {
                const headers = { Authorization: `Bearer ${this.user.token}` };
                await api.post('/api/auth/logout', null, { headers })
                    .then((res) => {
                        localStorage.removeItem('user');
                        this.$router.push({ path: '/' });
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            } catch (error) {
                console.log(error);
            }
        },
    }
}
</script>