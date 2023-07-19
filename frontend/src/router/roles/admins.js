export const adminRoutes = (DefaultLayout) => [
  {
    path: '/',
    name: 'AdminHome',
    redirect: '/admin',
  },
  {
    path: '/admin/login',
    name: 'AdminLogin',
    component: () => import('@/views/admin/auth/Login'),
  },
  {
    path: '/admin/request-password',
    name: 'AdminRequestPassword',
    component: () => import('@/views/admin/auth/RequestPassword'),
  },
  {
    path: '/admin/reset-password',
    name: 'AdminResetPassword',
    component: () => import('@/views/admin/auth/ResetPassword'),
  },
  {
    path: '/admin/logout',
    name: 'AdminLogout',
  },
  {
    path: '/admin',
    name: 'AdminHome',
    component: DefaultLayout,
    redirect: '/admin/accounts',
    children: [
      {
        path: '/admin/accounts',
        name: 'ListAccount',
        component: () => import('@/views/admin/admins/List.vue'),
      },
      {
        path: '/admin/accounts',
        name: 'AccountSetting',
        redirect: '/admin/accounts',
        children: [
          {
            path: '/admin/accounts/create',
            name: 'CreateAccount',
            component: () => import('@/views/admin/admins/Create.vue'),
          },
          {
            path: '/admin/accounts/edit/:id',
            name: 'UpdateAccount',
            component: () => import('@/views/admin/admins/Create.vue'),
          },
        ],
      },
      {
        path: '/admin/transmission-logs',
        name: 'TransmissonLogs',
        component: () => import('@/views/admin/transmissions/List.vue'),
      },
    ],
  },
]

export const adminPublicPages = [
  'AdminLogin',
  'AdminRequestPassword',
  'AdminResetPassword',
]
