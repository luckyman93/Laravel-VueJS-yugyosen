<template>
  <div id="Wrapper" class="provider container-fluid">
    <MHeader />
    <ONavbar />

    <main class="main">
      <div class="main-tab tab-content">
        <section id="Information" class="main-tab-information tab-pane fade show active">
          <dl class="main-tab-information-comment">
            <dt class="main-tab-information-comment-headline ex-headline">
              <span>ニュースタイトル</span>
            </dt>
            <dd class="main-tab-information-comment-content">{{ newDetailIndex.news_title }}</dd>
          </dl>

          <dl class="main-tab-information-target">
            <dt class="main-tab-information-target-headline ex-headline">
              <span>ニュースコンテンツ</span>
            </dt>
            <!-- eslint-disable vue/no-v-html -->
            <dd class="main-tab-information-comment-content" v-html="newDetailIndex.news_content">
              {{ newDetailIndex.news_content }}
            </dd>
            <!--eslint-enable-->
          </dl>
        </section>
      </div>
      <div>
        <AButton label="前のページへ戻る" class-name="ex-button ex-confirm" @onClick="onBack()" />
      </div>
    </main>
    <MFooter />
  </div>
</template>

<script>
// import moment from 'moment'

// component
import MHeader from '@/views/viewer/components/MHeader.vue'
import MFooter from '@/views/viewer/components/MFooter.vue'
import ONavbar from '@/views/viewer/components/ONavbar.vue'
import AButton from '@/views/components/AButton.vue'

// const
import ROUTE from '@/consts/route'
import HTTP_STATUS from '@/consts/httpStatus'

// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const newsRepository = RepositoryFactory.get('news')

export default {
  components: {
    MHeader,
    MFooter,
    ONavbar,
    AButton,
  },

  props: {
    cityId: {
      type: null,
      required: true,
      default: null,
    },
  },

  data() {
    return {
      ROUTE,
      newDetailIndex: [],
    }
  },

  async created() {
    await this.fetchNewsShow()
  },

  methods: {
    /*-------------------------------------------*/
    /* ニュース詳細取得処理
    /*-------------------------------------------*/
    async fetchNewsShow() {
      this.showLoader()

      await newsRepository
        .fetchNewsShow(this.cityId)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.newDetailIndex = res.data
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

    onBack() {
      window.location.href = `/`
    },
  },
}
</script>

<style lang="scss" src="@/../sass/viewer/extra.scss"></style>
<style lang="scss" src="@/../sass/viewer/newsDetail.scss"></style>
