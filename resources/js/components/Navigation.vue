<template>
    <div class="header">
        <div class="header-left">
            <a class="logo">
                <img src="/img/logo.png" width="35" height="35" alt=""> <span>DigitalFox</span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                    <span class="user-img mr-1">
                        <img class="rounded-circle" src="/img/user.jpg" width="24" alt="image">
                        <span class="status online"></span>
                    </span>
                    <span>{{ user.name }}</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item">My Profile</a>
                    <a class="dropdown-item" href="#" @click="logoutUser()">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    name: 'navigation-bar',
    
    data () {
        return {

        }
    },

    computed: mapState({
        user: state => state.userModule.user,
    }),

    mounted () {
        this.getUser();
    },

    methods: {
        ...mapActions({
            logoutUser: 'userModule/logoutUser',
            getUser: 'userModule/getUser'
        }),
    }
}
</script>