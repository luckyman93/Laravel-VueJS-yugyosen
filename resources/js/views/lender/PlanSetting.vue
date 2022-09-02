<template>
  <div id="Wrapper" class="lender basic">
    <div class="lender-inner">
      <MHeader :title="'業者プラン設定'" />
      <main class="main">
        <div class="main-form">
          <div class="main-form-element">
            <AInputForm
              id="plan_name"
              v-model="planSettingInfo[0].plan_name"
              :required="true"
              label="プラン名"
              :disabled="!isNew && !isEditing"
              placeholder="いイカ釣りプラン"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`plan_name`]" class="error-message">{{
              errors[`plan_name`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <ATextArea
              id="plan_description"
              v-model="planSettingInfo[0].plan_description"
              label="プラン説明"
              height="60px"
              :required="false"
              :disabled="!isNew && !isEditing"
              placeholder="プラン説明..."
              class-name="ex-input"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="delay"
              v-model="planSettingInfo[0].delay"
              :required="true"
              label="時期"
              :disabled="!isNew && !isEditing"
              placeholder="2022.1.1~2022.1.2"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`delay`]" class="error-message">{{
              errors[`delay`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="priceIncludes"
              v-model="planSettingInfo[0].price_includes"
              :required="false"
              label="料金に含まれるもの"
              :disabled="!isNew && !isEditing"
              placeholder="料金に含まれるもの"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="ToPrepare"
              v-model="planSettingInfo[0].to_prepare"
              :required="false"
              label="準備が必要なもの"
              :disabled="!isNew && !isEditing"
              placeholder="準備が必要なもの"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="collection"
              v-model="planSettingInfo[0].collection"
              :required="false"
              label="集合時間"
              :disabled="!isNew && !isEditing"
              placeholder="集合時間"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="return"
              v-model="planSettingInfo[0].return"
              :required="false"
              label="帰港時間"
              :disabled="!isNew && !isEditing"
              placeholder="帰港時間"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="reservation"
              v-model="planSettingInfo[0].reservation"
              :required="false"
              label="予約方法 "
              :disabled="!isNew && !isEditing"
              placeholder="予約方法"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <ATextArea
              id="other"
              v-model="planSettingInfo[0].other"
              label="備考"
              height="60px"
              :disabled="!isNew && !isEditing"
              :required="false"
              class-name="ex-input"
              placeholder="その他連絡事項等ございましたら記述ください"
            />
          </div>

          <div class="main-form-element ex-separate">
            <AButton
              label="保存する"
              :disabled="false"
              class-name="ex-button ex-confirm"
              @onClick="onStore"
            />
          </div>
        </div>
      </main>
      <MFooter />
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

// component
import AButton from '@/views/components/AButton.vue'
import AInputForm from '@/views/components/AInputForm.vue'
import ATextArea from '@/views/components/ATextArea.vue'
import MHeader from '@/views/lender/components/MHeader.vue'
import MFooter from '@/views/lender/components/MFooter.vue'

// const
import BUTTON from '@/consts/button'
import HTTP_STATUS from '@/consts/httpStatus'
import TOAST from '@/consts/toast'

// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const planRepository = RepositoryFactory.get('plans')

export default {
  components: {
    AButton,
    AInputForm,
    ATextArea,
    MHeader,
    MFooter,
  },

  data: () => ({
    BUTTON,
    isNew: false,
    isEditing: true,
    planSettingInfo: [
      {
        plan_name: '',
        plan_description: '',
        delay: '',
        price_includes: '',
        to_prepare: '',
        collection: '',
        return: '',
        reservation: '',
        other: '',
      },
    ],
    errors: {},
  }),

  computed: {
    ...mapState('userModule', ['lenderUser']),
  },

  async created() {
    this.showLoader()
    await this.fetchPlanInforIndex(this.lenderUser.lender_id)
    this.hideLoader()
  },

  methods: {
    // 業者プラン情報の取得
    async fetchPlanInforIndex(lenderId) {
      await planRepository
        .fetchPlanIndex(lenderId)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          if (res.data.length === 0) {
            this.isNew = true
          } else {
            this.isNew = false
            this.planSettingInfo = res.data
          }
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.lenderCatch(err.response.status)
            return
          }
          this.$toast.errorToast()
        })
    },

    onStore() {
      if (this.isNew) {
        this.storePlans()
      } else {
        this.updatePlans()
      }
    },

    // 業者プラン情報の登録
    async storePlans() {
      this.planSettingInfo[0].lender_id = this.lenderUser.lender_id
      await planRepository
        .storePlan(this.planSettingInfo[0])
        .then(res => {
          if (res.status !== HTTP_STATUS.CREATED) {
            this.$toast.errorToast()
            return
          }
          this.$toast.successToast(TOAST.SUCCESS.CREATED)
          this.planSettingInfo[0] = res.data
          this.isNew = false
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.lenderCatch(err.response.status)
            this.errors = err.response.data.errors
            return
          }
          this.errors = err.response.data.errors
          this.$toast.errorToast()
        })
    },
    // 業者プラン情報の更新
    async updatePlans() {
      await planRepository
        .updatePlan(this.planSettingInfo[0].id, this.planSettingInfo[0])
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.planSettingInfo[0] = res.data
          this.$toast.successToast(TOAST.SUCCESS.UPDATED)
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.lenderCatch(err.response.status)
            this.errors = err.response.data.errors
            return
          }
          this.errors = err.response.data.errors
          this.$toast.errorToast()
        })
    },
  },
}
</script>

<style lang="scss" src="@/../sass/lender/common.scss"></style>
<style lang="scss" src="@/../sass/lender/basicInfo.scss"></style>
