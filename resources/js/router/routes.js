function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [

  // Nationalities
  {
    path: '/document_types',
    component: page('document_type/Index.vue'),
    children: [
      { path: '', redirect: {name: 'document_types.list'}},
      { path: 'list', name: 'document_types.list', component: page('document_type/List.vue') },
      { path: 'add', name: 'document_types.add', component: page('document_type/Add.vue') },
      { path: 'edit/:id', name: 'document_types.edit', component: page('document_type/Edit.vue') },
    ]
  },

  // Nationalities
  {
    path: '/nationalities',
    component: page('nationality/Index.vue'),
    children: [
      { path: '', redirect: {name: 'nationalities.list'}},
      { path: 'list', name: 'nationalities.list', component: page('nationality/List.vue') },
      { path: 'add', name: 'nationalities.add', component: page('nationality/Add.vue') },
      { path: 'edit/:id', name: 'nationalities.edit', component: page('nationality/Edit.vue') },
    ]
  },


  // Visitors
  {
    path: '/visitors',
    component: page('visitor/Index.vue'),
    children: [
      { path: '', redirect: {name: 'visitors.list'}},
      { path: 'list', name: 'visitors.list', component: page('visitor/List.vue') },
      { path: 'list_closed', name: 'visitors.list_closed', component: page('visitor/ListClosed.vue') },
      { path: 'add', name: 'visitors.add', component: page('visitor/Add.vue') },
      { path: 'edit/:id', name: 'visitors.edit', component: page('visitor/Edit.vue') },
    ]
  },


// Employees Routes
  {
    path: '/employees',
    component: page('employee/Index.vue'),
    children: [
      { path: '', redirect: { name: 'employees.list' } },
      { path: 'list', name: 'employees.list', component: page('employee/List.vue') },
      { path: 'add', name: 'employees.add', component: page('employee/Add.vue') },
      { path: 'edit/:id', name: 'employees.edit', component: page('employee/Edit.vue') },


      { path: 'employees-import', name: 'employees.import', component: page('employee/Import.vue') },
      { path: 'visitors-import', name: 'visitors.import', component: page('visitor/Import.vue') },
    ]
  },

  // Institute Routes
  {
    path: '/institutions',
    component: page('institution/Index.vue'),
    children: [
      { path: '', redirect: { name: 'institutions.list' } },
      { path: 'list', name: 'institutions.list', component: page('institution/List.vue') },
      { path: 'add', name: 'institutions.add', component: page('institution/Add.vue') },
      { path: 'edit/:id', name: 'institutions.edit', component: page('institution/Edit.vue') }
    ]
  },

  // Departments Route

  {
    path: '/departments', component: page('department/Index.vue'),
    children: [
      { path: '', redirect: { name: 'departments.list' } },
      { path: 'list', name: 'departments.list', component: page('department/List.vue') },
      { path: 'add', name: 'departments.add', component: page('department/Add.vue') },
      { path: 'edit/:id', name: 'departments.edit', component: page('department/Edit.vue') }
    ]
  },

  {
    path: '/visitor_cards',
    component: page('visitor_card/Index.vue'),
    children: [
      { path: '', redirect: { name: 'visitor_cards.list' } },
      { path: 'list', name: 'visitor_cards.list', component: page('visitor_card/List.vue') },
      { path: 'add', name: 'visitor_cards.add', component: page('visitor_card/Add.vue') },
      { path: 'edit/:id', name: 'visitor_cards.edit', component: page('visitor_card/Edit.vue') }
    ]
  },

  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
