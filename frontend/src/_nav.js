export default [
  {
    component: 'CNavGroup',
    name: 'account_management',
    icon: 'cib-opsgenie',
    items: [
      {
        component: 'CNavItem',
        name: 'account_setting',
        routeName: 'ListAccount',
        to: '/admin/accounts',
      },
      {
        component: 'CNavItem',
        name: 'account_add_new',
        routeName: 'CreateAccount',
        to: '/admin/accounts/create',
      },
    ],
  },
  {
    component: 'CNavItem',
    name: 'transmission_management',
    routeName: 'TransmissonLogs',
    to: '/admin/transmission-logs',
    icon: 'cil-swap-horizontal',
  },

  // BLOCK MASTER NAV
  // {
  //   component: 'CNavTitle',
  //   name: 'block_heading',
  // },

  // {
  //   component: 'CNavGroup',
  //   name: 'block_account',
  //   icon: 'cib-buffer',
  //   items: [
  //     {
  //       component: 'CNavItem',
  //       name: 'admin_management',
  //       routeName: 'AdminList',
  //       to: '/admin/admins',
  //       icon: 'cib-opsgenie',
  //     },
  //   ],
  // },
]
