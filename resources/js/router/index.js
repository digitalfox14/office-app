import { createRouter, createWebHistory } from 'vue-router'

import publicRoutes from '@/router/public'
import homeRoutes from '@/router/home'

const routes = [].concat(publicRoutes).concat(homeRoutes);

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;