<template>
  <div>
    <MBaseDetail
      :title="pageTitle"
      :is-new="isNew"
      :is-editing="isEditing"
      :is-display-back-btn="false"
      :is-display-delete-btn="false"
      :is-display-change-password-btn="false"
      @onSave="onSave"
      @onEdit="onEdit"
      @onCancel="onCancelEdit"
      @onBackList="onBackList"
    >
      <template #breadcrumb>
        <MBreadcrumb :breadcrumb-data="breadcrumbData"></MBreadcrumb>
      </template>

      <template #content>
        <div class="container my-5">
          <div class="mb-4">
            <AInputForm
              id="news_title"
              v-model="form.news_title"
              :required="true"
              label="ニュースタイトル"
              :disabled="!isEditing"
            />
            <span v-if="errors && errors.news_title" class="error-message">{{
              errors.news_title[0]
            }}</span>
          </div>
          <div class="mb-4">
            <ATextArea
              id="news_content"
              v-model="form.news_content"
              :value="form.news_content ? form.news_content : ''"
              :required="true"
              :disabled="!isEditing"
              label="ニュースコンテンツ"
              height="200px"
            />
            <span v-if="errors && errors.news_content" class="error-message">{{
              errors.news_content[0]
            }}</span>
          </div>
        </div>
      </template>
    </MBaseDetail>
  </div>
</template>

<script>
import { mapState } from 'vuex'

// component
import ATextArea from '@/views/components/ATextArea.vue'
import MBaseDetail from '@/views/admin/components/MBaseDetail.vue'
import MBreadcrumb from '@/views/admin/components/MBreadcrumb.vue'
import AInputForm from '@/views/components/AInputForm.vue'
// const
import HTTP_STATUS from '@/consts/httpStatus'
import TOAST from '@/consts/toast'
import ROUTE from '@/consts/route'
// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const newsRepository = RepositoryFactory.get('news')

export default {
  components: {
    ATextArea,
    MBaseDetail,
    MBreadcrumb,
    AInputForm,
  },

  props: {
    id: {
      type: null,
      required: true,
      default: null,
    },
  },

  data: () => ({
    pageTitle: 'ニュース 詳細',
    isNew: false,
    isEditing: false,
    form: {},
    errors: {},
  }),

  computed: {
    ...mapState('userModule', ['adminUser']),
  },

  watch: {
    $route: {
      async handler() {
        this.isNew = this.id === 'new'
        if (this.isNew) this.isEditing = true
      },
      immediate: true,
    },
    isEditing: {
      async handler() {
        if (this.isNew && this.isEditing) {
          this.pageTitle = 'ニュース 新規登録'
        }
        if (!this.isNew && this.isEditing) {
          this.pageTitle = 'ニュース 編集'
        }
        if (!this.isNew && !this.isEditing) {
          this.pageTitle = 'ニュース 詳細'
        }
      },
      immediate: true,
    },
  },

  async created() {
    await this.setBreadcrumbData()
    if (this.isNew) return
    this.fetchNewsShow()
  },

  methods: {
    /*-------------------------------------------*/
    /* 詳細取得処理 管理者画面
    /*-------------------------------------------*/
    async fetchNewsShow() {
      this.showLoader()

      await newsRepository
        .fetchNewsShow(this.id)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.form = res.data
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.adminCatch(err.response.status)
            return
          }
          this.$toast.errorToast()
        })

      this.hideLoader()
    },
    /*-------------------------------------------*/
    /* 新規登録・更新処理 管理者画面
    /*-------------------------------------------*/
    onSave() {
      if (this.isNew) {
        this.storeNews()
      } else {
        this.updateNews()
      }
    },
    // 新規登録
    async storeNews() {
      this.form.created_user_id = this.adminUser.id
      this.form.updated_user_id = this.adminUser.id

      this.showLoader()

      await newsRepository
        .storeNews(this.form)
        .then(res => {
          if (res.status !== HTTP_STATUS.CREATED) {
            this.$toast.errorToast()
            return
          }
          // 成功時の処理
          this.$toast.successToast(TOAST.SUCCESS.CREATED)
          this.pageTitle = 'ニュース 詳細'
          this.errors = {}
          this.setBreadcrumbData()
          if (this.isNew) {
            this.$router.push({ name: ROUTE.ADMIN.NEWS.LIST.name })
          } else {
            this.isEditing = false
          }
          this.isNew = false
        })
        .catch(async err => {
          this.errors = err.response.data.errors
          await this.$errHandling.adminCatch(err.response.status)
        })
      this.hideLoader()
    },
    // 更新
    async updateNews() {
      this.form.updated_user_id = this.adminUser.id

      this.showLoader()

      await newsRepository
        .updateNews(this.id, this.form)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          // 成功時の処理
          this.$toast.successToast(TOAST.SUCCESS.UPDATED)
          this.form = res.data
          this.isEditing = false
          this.errors = {}
          this.$router.push({
            name: ROUTE.ADMIN.NEWS.DETAIL.name,
            // param: { id: res.data.id },
          })
        })
        .catch(async err => {
          this.errors = err.response.data.errors
          await this.$errHandling.adminCatch(err.response.status)
        })

      this.hideLoader()
    },
    /*-------------------------------------------*/
    /* 共通処理 管理者画面
    /*-------------------------------------------*/
    onEdit() {
      this.isEditing = true
    },
    onBackList() {
      this.$router.back()
      // this.$router.go(-1)
    },
    // 呼び出しメソッドが異なるため完全に共通できない。
    onCancelEdit() {
      this.isEditing = false
      this.errors = {}
      if (this.isNew) {
        this.form = {}
      } else {
        this.fetchNewsShow()
      }
    },
    setBreadcrumbData() {
      this.breadcrumbData = [
        {
          title: 'ニュース 一覧',
          link: { name: ROUTE.ADMIN.NEWS.LIST.name },
        },
        {
          title: this.pageTitle,
          link: '',
        },
      ]
    },
  },
}
</script>
