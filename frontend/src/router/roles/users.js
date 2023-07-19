export const userRoutes = (DefaultLayout) => [
  // {
  //   path: '/',
  //   name: 'UserHome',
  //   redirect: '/dashboard',
  // },
  {
    path: '/login',
    name: 'UserLogin',
    component: () => import('@/views/user/auth/Login'),
  },
  {
    path: '/request-password',
    name: 'UserRequestPassword',
    component: () => import('@/views/user/auth/RequestPassword'),
  },
  {
    path: '/reset-password',
    name: 'UserResetPassword',
    component: () => import('@/views/user/auth/ResetPassword'),
  },
  {
    path: '/logout',
    name: 'UserLogout',
  },
  {
    path: '/',
    name: 'UserHome',
    component: DefaultLayout,
    redirect: '/dashboard',
    children: [
      {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import('@/views/user/dashboard/Dashboard.vue'),
      },
    ]
  },
]

export const userPublicPages = [
  'UserLogin',
  'UserRequestPassword',
  'UserResetPassword',
]
