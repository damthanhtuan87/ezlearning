import { ADMIN_URIS } from "@/config/api_path"

export default axios => ({
  list(params) {
    return axios.get(ADMIN_URIS.COURSE, { params: params })
  },
  get(courseId) {
    return axios.get(`${ADMIN_URIS.COURSE}/${courseId}`)
  },
  create(params) {
    return axios.post(ADMIN_URIS.COURSE, params)
  },
  update(courseId, params) {
    return axios.put(`${ADMIN_URIS.COURSE}/${courseId}`, params)
  },
  delete(courseId, params) {
    return axios.delete(`${ADMIN_URIS.COURSE}/${courseId}`, { params })
  },
})
