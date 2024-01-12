import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        redirect: {
            name: 'dashboard'
        },
        // beforeEnter: requireAuth,
        component: () => import('./layouts/Layout.vue'),
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: () => import('./views/Dashboard.vue')
            },
        ]
    },
    // {
    //     path: '/',
    //     name: 'home',
    //     component: () => import('./views/Home.vue'),
    // },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import('./views/404.vue'),
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router