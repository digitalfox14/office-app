import { createRouter, createWebHistory } from 'vue-router'

import publicRoutes from '@/router/public'

const routes = [].concat(publicRoutes);

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;