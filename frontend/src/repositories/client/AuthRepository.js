import { ADMIN_URIS, USER_URIS } from "@/config/api_path"

export default axios => ({
  // for admin
  login(params) {
    return axios.post(`${ADMIN_URIS.AUTH}/login`, params)
  },
  requestPassword(params) {
    return axios.post(`${ADMIN_URIS.AUTH}/request-password`, params)
  },
  resetPassword(params) {
    return axios.post(`${ADMIN_URIS.AUTH}/reset-password`, params)
  },
  activateAccount(params) {
    return axios.post(`${ADMIN_URIS.AUTH}/activate-account`, params)
  },
  resendPassword(params) {
    return axios.post(`${ADMIN_URIS.AUTH}/resent-password`, params)
  },

  // for normal user
  userLogin(params) {
    return axios.post(`${USER_URIS.AUTH}/login`, params)
  },
  userRequestPassword(params) {
    return axios.post(`${USER_URIS.AUTH}/request-password`, params)
  },
  userResetPassword(params) {
    return axios.post(`${USER_URIS.AUTH}/reset-password`, params)
  },
  userResendPassword(params) {
    return axios.post(`${USER_URIS.AUTH}/resent-password`, params)
  },
})
