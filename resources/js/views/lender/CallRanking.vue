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
          <table class="main-table-content">
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
              <tr
                v-for="(item, index) in callRankingList.slice(0, 10)"
                :key="index"
                class="main-tbody-row"
              >
                <td class="main-tbody-bottom-first">
                  <div style="display:flex;">
                    <span class="main-tbody-row-letter1">{{ index + 1 }}</span>
                    <span class="main-tbody-row-letter2">
                      {{ item.prefecture_name + item.city_name }}
                      <br />
                      {{ item.boat_name }}
                    </span>
                  </div>
                </td>
                <td class="main-tbody-bottom-second">
                  {{ item.call_count }}
                </td>
                <td class="main-tbody-bottom-first">
                  <span v-if="item.member_type_id === 1">
                    <img class="main-tbody-mark" src="/images/lender/icon_mark.svg" />
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-if="callRankingList.slice(10, 50).length !== 0" class="ex-collapses">
            <MCollapse id="Method" label="11〜50位を見る" class-name="main-more-table">
              <table class="main-table-content" style="width: 100%">
                <colgroup>
                  <col span="1" style="width: 60%;" />
                  <col span="1" style="width: 20%;" />
                  <col span="1" style="width: 20%;" />
                </colgroup>
                <tbody>
                  <tr
                    v-for="(item, index) in callRankingList.slice(10, 50)"
                    :key="index"
                    class="main-tbody-row"
                  >
                    <td class="main-tbody-bottom-first">
                      <div style="display:flex;">
                        <span class="main-tbody-row-letter1">{{ index + 1 }}</span>
                        <span class="main-tbody-row-letter2">
                          {{ item.prefecture_name + item.city_name }}
                          <br />
                          {{ item.boat_name }}
                        </span>
                      </div>
                    </td>
                    <td class="main-tbody-bottom-second">
                      {{ item.call_count }}
                    </td>
                    <td class="main-tbody-bottom-first">
                      <span v-if="item.member_type_id === 1">
                        <img class="main-tbody-mark" src="/images/lender/icon_mark.svg" />
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </MCollapse>
          </div>
          <div class="main-ranking-intro">
            利用者様が、業者様へ『電話をかけた回数』を
            <br />
            ランキング化しています。
            <br />
            ※一端末で1日1回までのカウント
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
import MCollapse from '@/views/components/MCollapse.vue'

// const
import HTTP_STATUS from '@/consts/httpStatus'

// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const callRankingRepository = RepositoryFactory.get('calls')

export default {
  components: {
    MHeader,
    MFooter,
    MITPart,
    MCollapse,
  },

  data: () => ({
    callRankingList: [],
  }),

  computed: {
    ...mapState('userModule', ['lenderUser']),
  },

  async created() {
    this.showLoader()
    await this.fetchCallRankingList()
    this.hideLoader()
  },

  methods: {
    async fetchCallRankingList() {
      await callRankingRepository
        .fetchCallRankingList()
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          console.log(res.data.slice(0, 10))
          this.callRankingList = res.data
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.lenderCatch(err.response.status)
            return
          }
          this.$toast.errorToast()
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
