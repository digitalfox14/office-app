import { createRouter, createWebHistory } from 'vue-router'

import publicRoutes from '@/router/public'
import homeRoutes from '@/router/home'
import userRoutes from '@/router/user'

const routes = [].concat(publicRoutes).concat(homeRoutes).concat(userRoutes);

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;