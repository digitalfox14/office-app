<template>
    <div class="sidebar" id="sidebar">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 393px;">
            <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 393px;">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <router-link :to="{ name: 'Dashboard' }">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </router-link>
                        </li>
                        <li v-if="user.role_id==1">
                            <router-link :to="{name: 'Attendance'}">
                                <i class="fa fa-clock-o"></i> <span>Attendance</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    name: 'side-bar',

    computed: mapState({
        user: state => state.userModule.user
    }),
}
</script>