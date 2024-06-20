// Composables
import { createRouter, createWebHistory } from 'vue-router'
import {jwtDecode} from 'jwt-decode';


const empRoutes = [
  { path: '/:catchAll(.*)', redirect: '/equipments' },
  
  {
    path: '/equipments',
    name: 'Equipements',
    component: () => import(/* webpackChunkName: "eq" */ '@/views/employe/Equipments2.vue'),
  },
  {
    path: '/consumables',
    name: 'Consumables',
    component: () => import(/* webpackChunkName: "con" */ '@/views/employe/Consumables.vue'),
  },
  {
    path: '/cart',
    name: 'Cart',
    component: () => import(/* webpackChunkName: "crt" */ '@/views/employe/Cart.vue'),
  },
  {
    path: '/permission',
    name: 'Permission',
    component: () => import(/* webpackChunkName: "pr" */ '@/views/employe/Permission2.vue'),
  },
  {
    path: '/profil',
    name: 'Profil',
    component: () => import(/* webpackChunkName: "p" */ '@/views/employe/Profil.vue'),
  },
  {
    path: '/setting',
    name: 'Setting',
    component: () => import(/* webpackChunkName: "s" */ '@/views/employe/Setting.vue'),
  },
  {
    path: '/demand',
    name: 'Demand',
    component: () => import(/* webpackChunkName: "d" */ '@/views/employe/Demand2.vue'),
  }
]

const adminRoutes = [
  { path: '/:catchAll(.*)', redirect: '/dashboard' },
      {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import(/* webpackChunkName: "dash" */ '@/views/admin/Dashboard.vue'),
      },
      
      {
        path: '/dashboard/equipments',
        name: 'admin_equipments',
        component: () => import(/* webpackChunkName: "de" */ '@/views/admin/Equipments.vue'),
      },
      {
        path: '/dashboard/users',
        name: 'admin_users',
        component: () => import(/* webpackChunkName: "ds" */ '@/views/admin/Users.vue'),
      },
      {
        path: '/dashboard/requests',
        name: 'admin_requests',
        component: () => import(/* webpackChunkName: "dr" */ '@/views/admin/Requests.vue'),
      },
      {
        path: '/dashboard/orders',
        name: 'admin_orders',
        component: () => import(/* webpackChunkName: "do" */ '@/views/admin/Orders.vue'),
      },
      {
        path: '/dashboard/demands',
        name: 'admin_demand',
        component: () => import(/* webpackChunkName: "dd" */ '@/views/admin/Demands.vue'),
      }
   
]

const defaultRoutes = [
  
  { path: '/:catchAll(.*)', redirect: '/login' },
      {
        path: '/login',
        name: 'Login',
        component: () => import(/* webpackChunkName: "log" */ '@/views/Login.vue'),
      },
      {
        path: '/register',
        name: 'Register',
        component: () => import(/* webpackChunkName: "reg" */ '@/views/Register.vue'),
      },
     
]
let routes=[]
const token = localStorage.getItem('token');
if(!token){
  routes=defaultRoutes
}else{
  const decodedToken = jwtDecode(token);
  const roles = decodedToken.roles
  if(roles[0]==='user' || roles[0]==='ROLE_USER'){
    routes = empRoutes
  }else{
    routes = adminRoutes
  }
}

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})



/*router.beforeEach((to, from, next) => {
  
  let shouldRefresh = localStorage.getItem('refresh');
  let urlTo = localStorage.getItem('to');

  console.log(shouldRefresh)

  if (shouldRefresh==='true') {
    localStorage.setItem('refresh','false');
    window.location.reload()
  }
  if(!urlTo && to.path==='/login'){
    next()
  }else if(urlTo!=='/' && to.path==='/login'){
    localStorage.setItem('to','/');
    next(urlTo)
  }else{
    next()
  }
  
 
  
  // Proceed with the navigation
  
});
*/
export default router
