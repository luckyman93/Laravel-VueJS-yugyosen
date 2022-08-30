<template>
  <div id="Wrapper" class="lender callRanking">
    <div class="lender-inner">
      <MHeader :title="'投稿一覧'" />
      <main class="main">
        <div class="main-table">
          <div class="main-lineup-items">
            <dl class="main-lineup-item">
              <dd class="main-lineup-item-banner ex-certification">
                <a href="#">
                  <img class="ex-certification" src="/images/lender/icon_mark.svg" />
                  <span>認定遊漁船登録はこちら</span>
                </a>
              </dd>
            </dl>
          </div>
          <div class="main-call-ranking ex-ranking">
            <div class="main-call-ranking__link ex-ranking">
              <span>電話数ランキング（22.01.01〜2022.02.01)</span>
            </div>
          </div>
          <table class="main-table-content" style="width: 100%">
            <colgroup>
              <col span="1" style="width: 60%;" />
              <col span="1" style="width: 20%;" />
              <col span="1" style="width: 20%;" />
            </colgroup>
            <thead class="main-table-content-thead">
              <tr class="main-table-border-bottom">
                <th class="main-thead-Top__link ex-ranking">
                  <span>TOP 10</span>
                </th>
                <th class="main-thead-image-container">
                  <img
                    class="main-thead-image main-thead-image-dark"
                    src="/images/lender/img_ranking.png"
                  />
                  <span class="main-thead-text">電話数</span>
                </th>
                <th class="main-thead-image-container">
                  <img class="main-thead-image" src="/images/lender/img_ranking.png" />
                  <span class="main-thead-text">認定</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in rankingList" :key="index" class="main-tbody-row">
                <td class="main-tbody-bottom-first">
                  <div style="display:flex;">
                    <span class="main-tbody-row-letter1">{{ index + 1 }}</span>
                    <span class="main-tbody-row-letter2">
                      {{ item.cityName }}
                      <br />
                      {{ item.boatName }}
                    </span>
                  </div>
                </td>
                <td class="main-tbody-bottom-second">
                  {{ item.callRanking }}
                </td>
                <td class="main-tbody-bottom-first">
                  <img class="main-tbody-mark" src="/images/lender/icon_mark.svg" />
                </td>
              </tr>
            </tbody>
          </table>
          <div class="main-more-title">
            <span style="width:100%">11〜50位を見る</span>
          </div>
        </div>
        <MITPart />
      </main>
      <MFooter />
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

import MHeader from '@/views/lender/components/MHeader.vue'
import MFooter from '@/views/lender/components/MFooter.vue'
import MITPart from '@/views/lender/components/MITPart.vue'

// const
import HTTP_STATUS from '@/consts/httpStatus'
import ROUTE from '@/consts/route'

// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const lenderPostRepository = RepositoryFactory.get('lenderPosts')

export default {
  components: {
    MHeader,
    MFooter,
    MITPart,
  },

  data: () => ({
    rankingList: [
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
      { cityName: '福岡県福岡市', boatName: '遊漁丸', callRanking: 100 },
    ],
  }),

  computed: {
    ...mapState('userModule', ['lenderUser']),
  },

  async created() {
    this.showLoader()
    await this.fetchLenderPostIndex()
    this.hideLoader()
  },

  methods: {
    async fetchLenderPostIndex() {
      await lenderPostRepository
        .index(this.lenderUser.lender_id)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.postList = res.data
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.lenderCatch(err.response.status)
            return
          }
          this.$toast.errorToast()
        })
    },

    onDetail(id) {
      this.$router.push({
        name: ROUTE.LENDER.POST.DETAIL.name,
        params: { id },
      })
    },

    onNew() {
      this.$router.push({
        name: ROUTE.LENDER.POST.DETAIL.name,
        params: { id: 'new' },
      })
    },
  },
}
</script>
<style lang="scss" scoped>
.main {
  &__index {
    border-bottom: solid 1px lightgray;
  }
}
</style>

<style lang="scss" src="@/../sass/lender/callranking.scss"></style>
