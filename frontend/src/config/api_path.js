// Path router for admins
const ADMIN_SCHEMA = '/admins'
export const ADMIN_URIS = {
  AUTH: ADMIN_SCHEMA + '/auth',
  ADMINS: ADMIN_SCHEMA + '/admins',
  MASTER: ADMIN_SCHEMA + '/master', // get data master for select > option
  DASHBOARD: ADMIN_SCHEMA + '/dashboards',
  ACCOUNT: ADMIN_SCHEMA + '/accounts',
  TRANSMISSION: ADMIN_SCHEMA + '/transmission-logs',
  COURSE: ADMIN_SCHEMA + '/courses',
  TOPIC: ADMIN_SCHEMA + '/topics',
  QUESTION: ADMIN_SCHEMA + '/questions',
}

// Path router for user
const USER_SCHEMA = '/users'
export const USER_URIS = {
  AUTH: USER_SCHEMA + '/auth',
}
