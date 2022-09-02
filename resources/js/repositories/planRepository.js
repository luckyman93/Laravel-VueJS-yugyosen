import axios from 'axios'

const resource = '/plans'

export default {
  fetchPlanIndex(lenderId) {
    return axios.get(`${resource}?lenderId=${lenderId}`)
  },

  storePlan(params) {
    return axios.post(`${resource}`, params)
  },

  updatePlan(id, params) {
    return axios.patch(`${resource}/${id}`, params)
  },
}
