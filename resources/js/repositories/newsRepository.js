import axios from 'axios'

const resource = '/news'

export default {
  fetchNewsIndex(sortKey, orderBy) {
    return axios.get(`${resource}?sort_key=${sortKey}&order_by=${orderBy}`)
  },

  fetchNewsShow(id) {
    return axios.get(`${resource}/${id}`)
  },

  storeNews(params) {
    return axios.post(`${resource}`, params)
  },

  updateNews(id, params) {
    return axios.patch(`${resource}/${id}`, params)
  },

  deleteNews(id) {
    return axios.delete(`${resource}/${id}`)
  },
}
