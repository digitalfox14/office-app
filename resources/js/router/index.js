import { createRouter, createWebHistory } from 'vue-router'

import publicRoutes from '@/router/public'
import homeRoutes from '@/router/home'
import attendanceRoutes from '@/router/attendance'

const routes = [].concat(publicRoutes).concat(homeRoutes).concat(attendanceRoutes);

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;