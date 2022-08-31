import axios from 'axios'

const resource = '/calls'

export default {
  /*-------------------------------------------*/
  /* VIEWER *認証なし
  /*-------------------------------------------*/
  increCallCount(params) {
    return axios.post(`${resource}`, params)
  },

  fetchCallRankingList() {
    return axios.get(`${resource}`)
  },
}
