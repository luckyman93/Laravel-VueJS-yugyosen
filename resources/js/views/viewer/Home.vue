<template>
  <div id="Wrapper" class="top container-fluid">
    <header class="header-top">
      <span class="header-menu">
        <a href="#" class="header-menu-button" data-toggle="collapse" data-target="#NaviMenu"
          ><img src="/images/home/icon_menu.svg"
        /></a>
      </span>
      <span class="header-login"
        ><router-link :to="ROUTE.LENDER.LOGIN">業者ログイン</router-link></span
      >
    </header>
    <div class="mainvisual container-fluid">
      <div class="mainvisual-inner">
        <h1><img class="mainvisual-logo " src="/images/home/logo_mv.svg" /></h1>
        <div
          class="mainvisual-button"
          style="cursor:pointer;"
          data-toggle="modal"
          data-target="#myModal"
        >
          都道府県から選ぶ
        </div>
        <div id="bs-modal">
          <!-- MODAL -->
          <div
            id="myModal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myModalLabel"
          >
            <div class="modal-dialog" style="max-width: 800px;" role="document">
              <div class="modal-content main-modal">
                <div class="modal-headerline">
                  <h2 id="myModalLabel" class="modal-title modal-title-letter">エリア絞り込み</h2>
                  <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-main-body">
                  <div v-for="(region, ri) in footerRegionList" :key="ri" class="filterModalItem">
                    <div class="filterModalItem-headline">{{ region.region_name }}</div>
                    <div class="filterModalItem-body">
                      <span
                        v-for="(prefecture, pi) in region.prefectures"
                        :key="pi"
                        class="filterModalItem-item"
                      >
                        <a :href="'/boat/' + prefecture.url_param">
                          {{ prefecture.prefecture_name }}
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ONavbar />

    <div>
      <main class="main">
        <section class="main-area">
          <h2 class="main-area-headline">おすすめエリア</h2>
          <div class="main-area-items container-fluid mw-100">
            <div class="row m-0">
              <router-link
                v-for="(area, index) in mainAreas"
                :key="index"
                :to="area.url"
                class="main-area-item col-4"
              >
                <dl class="m-0">
                  <dd class="main-area-item-photo"><img :src="area.photo" /></dd>
                  <dt class="main-area-item-name">{{ area.name }}</dt>
                </dl>
              </router-link>
            </div>
          </div>
          <div class="main-area-items container-fluid mw-100">
            <ul class="row m-0 p-0">
              <li v-for="(area, index) in subAreas" :key="index" class="main-area-item col-4">
                {{ area.name }}
              </li>
            </ul>
          </div>
        </section>

        <section class="main-result">
          <h2 class="main-result-headline">釣果情報</h2>
          <div class="main-result-items container-fluid mw-100">
            <div class="row m-0">
              <div v-for="(post, index) in postList" :key="index" class="main-result-item col-6">
                <dl
                  class="m-0"
                  @click="
                    onDetailBoat(
                      post.lender.prefecture.url_param,
                      post.lender.city.url_param,
                      post.lender.port_id,
                      post.lender.boats[0].id
                    )
                  "
                >
                  <dd class="main-result-item-additional">
                    {{ post.lender.city.city_name }}/{{ post.beforeHour }}時間前
                  </dd>
                  <dd class="main-result-item-photo m-0">
                    <img
                      class=""
                      :src="post.post_img_1 ? post.post_img_1 : '/storage/images/dummy/dummy.png'"
                    />
                  </dd>
                  <dt class="main-result-item-summary">
                    <div v-if="post.targets.length > 0" class="main-result-item-fish">
                      {{ post.targets[0].target_name }}
                    </div>
                    <div class="main-result-item-boat">{{ post.lender.boats[0].boat_name }}</div>
                  </dt>
                </dl>
              </div>
            </div>
          </div>
        </section>

        <section class="main-line">
          <h2 class="main-line-headline">遊漁船サーチ公式LINEアカウント</h2>
          <a href="#" class="main-line-subheadline">
            遊漁船選びはこれで簡単!!<br />
            今釣れている遊漁船がわかる
          </a>

          <div class="main-line-slide">
            <div
              id="LineImages"
              class="carousel slide"
              data-ride="carousel"
              data-touch="true"
              data-wrap="true"
            >
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <dl class="main-line-slide-item m-0">
                    <dd class="main-line-slide-item-explain">
                      釣りの相手は大自然。<br />
                      海に同じ日はないからこそ古い情報は<br />
                      役に立たない。
                    </dd>
                    <dt class="main-line-slide-item-copy">
                      欲しいのは<br />
                      “リアルタイムの情報”
                    </dt>
                    <dd class="main-line-slide-item-image m-auto">
                      <img src="/images/dammy/slide.png" />
                    </dd>
                  </dl>
                </div>
                <div class="carousel-item">
                  <dl class="main-line-slide-item m-0">
                    <dd class="main-line-slide-item-explain">
                      釣りの相手は大自然。2<br />
                      海に同じ日はないからこそ古い情報は<br />
                      役に立たない。
                    </dd>
                    <dt class="main-line-slide-item-copy">
                      欲しいのは<br />
                      “リアルタイムの情報”
                    </dt>
                    <dd class="main-line-slide-item-image m-auto">
                      <img src="/images/dammy/slide.png" />
                    </dd>
                  </dl>
                </div>
                <div class="carousel-item">
                  <dl class="main-line-slide-item m-0">
                    <dd class="main-line-slide-item-explain">
                      釣りの相手は大自然。3<br />
                      海に同じ日はないからこそ古い情報は<br />
                      役に立たない。
                    </dd>
                    <dt class="main-line-slide-item-copy">
                      欲しいのは<br />
                      “リアルタイムの情報”
                    </dt>
                    <dd class="main-line-slide-item-image m-auto">
                      <img src="/images/dammy/slide.png" />
                    </dd>
                  </dl>
                </div>
              </div>
              <ul class="main-line-slide-indicators carousel-indicators">
                <li
                  class="main-line-slide-indicator active"
                  data-target="#LineImages"
                  data-slide-to="0"
                ></li>
                <li
                  class="main-line-slide-indicator"
                  data-target="#LineImages"
                  data-slide-to="1"
                ></li>
                <li
                  class="main-line-slide-indicator"
                  data-target="#LineImages"
                  data-slide-to="2"
                ></li>
              </ul>
              <span
                class="main-line-slide-arrow ex-prev carousel-control-prev"
                data-target="#LineImages"
                role="button"
                data-slide="prev"
              >
                <span class="sr-only">Previous</span>
              </span>
              <span
                class="main-line-slide-arrow ex-next carousel-control-next"
                data-target="#LineImages"
                role="button"
                data-slide="next"
              >
                <span class="sr-only">Next</span>
              </span>
            </div>
          </div>
        </section>

        <section class="main-wanted">
          <MWanted />
        </section>

        <section class="main-startup">
          <h2 class="main-startup-headline">船釣り始め方</h2>
          <div class="main-startup-items container-fluid mw-100">
            <div class="row m-0">
              <router-link
                v-for="(startup, index) in startups"
                :key="index"
                :to="startup.url"
                class="main-startup-item col-6"
              >
                <dl class="m-0">
                  <dd><img :src="startup.photo" /></dd>
                  <dd class="main-startup-item-times">第{{ startup.times }}回</dd>
                  <dt class="main-startup-item-title">{{ startup.title }}</dt>
                </dl>
              </router-link>
            </div>
          </div>
          <router-link to="#" class="main-startup-more">もっと見る</router-link>
        </section>

        <section class="main-news">
          <h2 class="main-news-headline">遊漁船ニュース</h2>
          <div class="main-news-items">
            <router-link v-for="(item, index) in news" :key="index" to="#" class="main-news-item">
              <dl>
                <dd class="main-news-item-date">{{ item.created_at }}</dd>
                <dt class="main-news-item-title">{{ item.news_content }}</dt>
              </dl>
            </router-link>
          </div>
          <!-- 該当するデータがないとき -->
          <div v-if="news.length === 0" class="d-flex justify-content-center mb-5 font-weight-bold">
            該当するデータがありません。
          </div>
        </section>
      </main>

      <nav class="bnavi container">
        <ul class="bnavi-menus row m-0 p-0">
          <li class="bnavi-menu col">
            <router-link to="#" class="d-block">
              <img src="/images/home/icon_menu_search.svg" /><br />
              遊漁船を探す
            </router-link>
          </li>
          <li class="bnavi-menu col">
            <a :href="ROUTE_HTML.BOOK" class="d-block">
              <img src="/images/home/icon_menu_startup.svg" /><br />
              船釣りの始め方
            </a>
          </li>
          <li class="bnavi-menu col">
            <a :href="ROUTE_HTML.CALL" class="d-block">
              <img src="/images/home/icon_menu_reserve.svg" /><br />
              予約電話のコツ
            </a>
          </li>
          <li class="bnavi-menu col">
            <a :href="ROUTE_HTML.TO_LENDER" class="d-block">
              <img src="/images/home/icon_menu_information.svg" /><br />
              遊漁船業者様へ
            </a>
          </li>
        </ul>
        <div class="bnavi-line">
          <img class="bnavi-line-icon" src="/images/common/icon_sns_line.svg" />
          今釣れている遊漁船がわかる
        </div>
      </nav>

      <MFooter />
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import moment from 'moment'
// const
import ROUTE from '@/consts/route'
import ROUTE_HTML from '@/consts/routePHP'
import HTTP_STATUS from '@/consts/httpStatus'
// component
import ONavbar from '@/views/viewer/components/ONavbar.vue'
import MWanted from '@/views/viewer/components/MWanted.vue'
import MFooter from '@/views/viewer/components/MFooter.vue'
// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const lenderPostRepository = RepositoryFactory.get('lenderPosts')
const newsRepository = RepositoryFactory.get('news')

export default {
  components: {
    ONavbar,
    MWanted,
    MFooter,
  },

  data() {
    return {
      ROUTE,
      ROUTE_HTML,
      mainAreas: [
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
      ],
      subAreas: [
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
        { name: '◯◯県◯◯市', photo: '/images/dammy/blank.png', url: '#' },
      ],
      startups: [
        { title: '魚釣りのルールを知ろう', times: '1', photo: '/images/dammy/blank.png', url: '#' },
        { title: '魚釣りのルールを知ろう', times: '2', photo: '/images/dammy/blank.png', url: '#' },
        { title: '魚釣りのルールを知ろう', times: '3', photo: '/images/dammy/blank.png', url: '#' },
        { title: '魚釣りのルールを知ろう', times: '4', photo: '/images/dammy/blank.png', url: '#' },
      ],
      news: [],
      postList: [],
    }
  },

  computed: {
    ...mapState('footerModule', ['footerRegionList']),
  },

  async created() {
    this.showLoader()
    await Promise.all([lenderPostRepository.viewerList(8)]).then(([lenderRes]) => {
      this.postList = lenderRes.data
      console.log(this.postList)
      const today = new Date()
      this.postList.forEach(x => {
        const createdAt = new Date(x.created_at)
        x.beforeHour = Math.floor(Math.abs(today - createdAt) / (60 * 60 * 1000))
      })
    })
    this.fetchNewsIndex()
    this.hideLoader()
  },

  methods: {
    onDetailBoat(prefectureUrlParam, cityUrlParam, portId, boatId) {
      window.location.href = `/boat/${prefectureUrlParam}/${cityUrlParam}/${portId}/${boatId}`
    },
    /*-------------------------------------------*/
    /* ニュースリスト取得
    /*-------------------------------------------*/
    async fetchNewsIndex() {
      await newsRepository
        .fetchNewsIndex('created_at', 'desc')
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.news = res.data
          this.news.forEach(x => {
            if (x.created_at) x.created_at = moment(x.created_at).format('YYYY.MM.DD')
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
  },
}
</script>

<style lang="scss" src="@/../sass/viewer/common.scss"></style>
<style lang="scss" src="@/../sass/viewer/extra.scss"></style>
<style lang="scss" src="@/../sass/viewer/home.scss"></style>
