<template>
    <div>
        <navigation />
        <sidebar />
        <div class="page-wrapper">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navigation from '@/components/Navigation.vue'
import Sidebar from '@/components/Sidebar.vue'

export default {
    data () {
        return {

        };
    },

    components: {
        Navigation,
        Sidebar,
    }
}
</script>