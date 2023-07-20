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
  {
    component: 'CNavGroup',
    name: 'course_management',
    icon: 'cib-opsgenie',
    items: [
      {
        component: 'CNavItem',
        name: 'courses',
        routeName: 'ListCourse',
        to: '/admin/courses',
      },
      {
        component: 'CNavItem',
        name: 'course_add',
        routeName: 'CreateCourse',
        to: '/admin/courses/create',
      },
    ],
  },
  // QUESTIONS AND ANSWERS
  {
    component: 'CNavGroup',
    name: 'qna_management',
    icon: 'cib-opsgenie',
    items: [
      {
        component: 'CNavItem',
        name: 'qna_list',
        routeName: 'ListQuestionAnswer',
        to: '/admin/qna',
      },
      {
        component: 'CNavItem',
        name: 'qna_add',
        routeName: 'CreateQuestionAnswer',
        to: '/admin/qna/create',
      },
    ],
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
