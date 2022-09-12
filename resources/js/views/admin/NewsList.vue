<template>
  <div>
    <MBaseList title="ニュースリスト" @onRegister="onRegister">
      <template #breadcrumb> </template>
      <template #content>
        <div :class="[newsIndexData.length !== 0 ? 'table-wrapper' : '']">
          <table ref="table" class="table table-hover">
            <thead>
              <tr>
                <th scope="col" class="sort-header">ID</th>
                <th scope="col" class="sort-header">投稿日</th>
                <th scope="col" class="sort-header">ニュース内容</th>
                <th scope="col" class="sort-header action-area-width">アクション</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(news, i) in newsIndexData" :key="i">
                <td class="align-middle py-1 pointer">
                  {{ news.id }}
                </td>
                <td class="align-middle py-1 pointer">
                  {{ news.updated_at }}
                </td>
                <td class="align-middle py-1 pointer news-content-width">
                  {{ news.news_title }}
                </td>
                <td class="d-flex align-middle py-1">
                  <AButton
                    label="詳細"
                    width="96px"
                    class="ml-2"
                    :color="BUTTON.COLOR.MAIN_DARK"
                    @onClick="onDetail(news.id)"
                  />
                  <AButton
                    label="削除"
                    width="96px"
                    class="ml-2"
                    :color="BUTTON.COLOR.DANGER"
                    @onClick="onOpenModal('delete-modal', news.id)"
                  />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- 該当するデータがないとき -->
        <div
          v-if="newsIndexData.length === 0"
          class="d-flex justify-content-center mb-5 font-weight-bold"
        >
          該当するデータがありません。
        </div>
      </template>
    </MBaseList>
    <MDeleteModal
      :target-name="'ニュース'"
      @onCancel="onCloseModal('delete-modal')"
      @onDelete="deleteNews"
    />
  </div>
</template>

<script>
import moment from 'moment'
import AButton from '@/views/components/AButton.vue'
import MBaseList from '@/views/admin/components/MBaseList.vue'
import MDeleteModal from '@/views/components/MDeleteModal.vue'

import BUTTON from '@/consts/button'
import ROUTE from '@/consts/route'
import TOAST from '@/consts/toast'
import HTTP_STATUS from '@/consts/httpStatus'

import { RepositoryFactory } from '@/repositories/repositoryFactory'

const newsRepository = RepositoryFactory.get('news')

export default {
  components: {
    AButton,
    MBaseList,
    MDeleteModal,
  },

  data: () => ({
    BUTTON,
    newsIndexData: [],
    newsId: 0,
    sortKey: 'created_at',
    isAsc: false,
  }),

  created() {
    this.showLoader()
    this.fetchNewsIndex()
    this.hideLoader()
  },

  methods: {
    /*-------------------------------------------*/
    /* ニュースリスト取得
    /*-------------------------------------------*/
    async fetchNewsIndex() {
      const orderBy = this.isAsc ? 'asc' : 'desc'
      await newsRepository
        .fetchNewsIndex(this.sortKey, orderBy)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.newsIndexData = res.data
          this.newsIndexData.forEach(x => {
            if (x.created_at) x.created_at = moment(x.created_at).format('YYYY-MM-DD')
            if (x.updated_at) x.updated_at = moment(x.updated_at).format('YYYY-MM-DD')
          })
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.adminCatch(err.response.status)
            return
          }
          this.$toast.errorToast()
        })
    },
    /*-------------------------------------------*/
    /* ニュース削除
    /*-------------------------------------------*/
    async deleteNews() {
      this.showLoader()

      await newsRepository
        .deleteNews(this.newsId)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }

          this.$toast.successToast(TOAST.SUCCESS.DELETED)
          this.onCloseModal('delete-modal')
          this.newsIndexData = this.newsIndexData.filter(news => news.id !== this.newsId)
        })
        .catch(async err => {
          await this.$errHandling.adminCatch(err.response.status)
        })

      this.hideLoader()
    },

    onRegister() {
      this.$router.push({
        name: ROUTE.ADMIN.NEWS.DETAIL.name,
        params: { id: 'new' },
      })
    },

    onDetail(id) {
      this.$router.push({
        name: ROUTE.ADMIN.NEWS.DETAIL.name,
        params: { id },
      })
    },

    onOpenModal($modalName, $id) {
      this.newsId = $id
      this.$modal.show($modalName)
    },

    onCloseModal($modalName) {
      this.$modal.hide($modalName)
    },
  },
}
</script>
<style lang="scss" scoped>
.action-area-width {
  width: 400px;
  padding-left: 20px;
}

.news-content-width {
  max-width: 500px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
