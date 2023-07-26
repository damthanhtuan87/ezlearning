import { ADMIN_URIS } from "@/config/api_path"

export default axios => ({
  list(params) {
    return axios.get(ADMIN_URIS.TOPIC, { params: params })
  },
  create(params) {
    return axios.post(ADMIN_URIS.TOPIC, params)
  },
  delete(topicId, params) {
    return axios.delete(`${ADMIN_URIS.TOPIC}/${topicId}`, { params })
  },
})
