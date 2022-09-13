<template>
  <footer class="footer">
    <section class="footer-area">
      <div class="footer_div_01">都道府県から遊漁船を探す</div>
      <div v-for="(region, ri) in footerRegionList" :key="ri" class="footer_div_02">
        <p class="footer_div_02_p">{{ region.region_name }}</p>
        <ul class="footer_div_02_ul">
          <li v-for="(prefecture, pi) in region.prefectures" :key="pi">
            <a :href="'/boat/' + prefecture.url_param">
              {{ prefecture.prefecture_name }}
            </a>
          </li>
        </ul>
      </div>
    </section>

    <ul class="footer-sns">
      <li>
        <a href="#"><img src="/images/common/icon_sns_twitter.svg"/></a>
      </li>
      <li>
        <a href="#"><img src="/images/common/icon_sns_instagram.svg"/></a>
      </li>
      <li>
        <a href="#"><img src="/images/common/icon_sns_facebook.svg"/></a>
      </li>
      <li>
        <a href="#"><img src="/images/common/icon_sns_line.svg"/></a>
      </li>
    </ul>

    <ul class="footer-menus">
      <li>
        <router-link :to="ROUTE.VIEWER.ABOUT.path" class="footer-menu"
          >遊漁船サーチとは</router-link
        >
        <a href="#" class="footer-menu">遊漁船を探す</a>
        <a :href="ROUTE_HTML.BOOK" class="footer-menu">船釣りの始め方</a>
      </li>
      <li>
        <a :href="ROUTE_HTML.CALL" class="footer-menu">予約電話のコツ</a>
        <a :href="ROUTE_HTML.TO_LENDER" class="footer-menu">遊漁船業者様へ</a>
      </li>
      <li>
        <a :href="ROUTE_HTML.FAQ" class="footer-menu">よくある質問</a>
        <a :href="ROUTE_HTML.CONTACT" class="footer-menu">お問合せ</a>
      </li>
    </ul>

    <div class="footer-links container-fluid">
      <div class="row">
        <div class="col-6">
          <router-link :to="ROUTE.LENDER.LOGIN.path" class="footer-link">業者ログイン</router-link>
          <a :href="ROUTE_HTML.REGIST" class="footer-link">掲載依頼</a>
          <a :href="ROUTE_HTML.COMPANY" class="footer-link">運営会社</a>
          <a :href="ROUTE_HTML.POLICY" class="footer-link">プライバシーポリシー</a>
        </div>
        <div class="col-6">
          <a :href="ROUTE_HTML.LEGAL" class="footer-link">特定商法取引</a>
          <!-- <a :href="ROUTE_HTML.AGREEMENT" class="footer-link">利用規約</a> -->
          <a :href="ROUTE_HTML.MASS" class="footer-link">マスコミの方へ</a>
          <a :href="ROUTE_HTML.LINK" class="footer-link">リンクについて</a>
        </div>
      </div>
    </div>

    <div class="footer-logo">
      <router-link to="/"><img class="mw-100" src="/images/common/logo_footer.svg"/></router-link>
    </div>

    <small class="footer-copyright">copyright©yugyosensearch all rights reserved.</small>
  </footer>
</template>
<script>
import { mapState } from 'vuex'
// const
import ROUTE from '@/consts/route'
import ROUTE_HTML from '@/consts/routePHP'

export default {
  data: () => ({ ROUTE, ROUTE_HTML }),

  computed: {
    ...mapState('footerModule', ['footerRegionList']),
  },

  methods: {
    onBoatList(prefectureParam) {
      window.location.href = `/boat/${prefectureParam}`
    },
  },
}
</script>
