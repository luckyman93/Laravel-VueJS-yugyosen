<template>
  <div id="Wrapper" class="lender basic">
    <div class="lender-inner">
      <MHeader :title="'業者プラン設定'" />
      <main class="main">
        <div class="main-form">
          <div class="main-form-element">
            <AInputForm
              id="plan_name"
              v-model="form.boats[0].plan_name"
              :required="true"
              label="プラン名"
              :disabled="!isNew && !isEditing"
              placeholder="いイカ釣りプラン"
              class-name="ex-input"
              type="text"
            />
            <!-- <span v-if="errors && errors[`boats.0.boat_name`]" class="error-message">{{
              errors[`boats.0.boat_name`][0]
            }}</span> -->
          </div>

          <div class="main-form-element">
            <ATextArea
              id="plan_description"
              v-model="form.boats[0].plan_description"
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
              v-model="form.delay"
              :required="true"
              label="時期"
              :disabled="!isNew && !isEditing"
              placeholder="2022.1.1~2022.1.2"
              class-name="ex-input"
              type="text"
            />
            <!-- <span v-if="errors && errors[`zip_code`]" class="error-message">{{
              errors[`zip_code`][0]
            }}</span> -->
          </div>

          <div class="main-form-element">
            <AInputForm
              id="price"
              v-model="form.price_1"
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
              id="price"
              v-model="form.price_2"
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
              v-model="form.collection"
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
              v-model="form.return"
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
              v-model="form.reservation"
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
              v-model="form.other_"
              label="備考"
              height="60px"
              :disabled="!isNew && !isEditing"
              :required="false"
              class-name="ex-input"
              placeholder="その他連絡事項等ございましたら記述ください"
            />
          </div>

          <ADatePicker></ADatePicker>

          <div class="main-form-element ex-separate">
            <AButton
              label="保存する"
              :disabled="false"
              class-name="ex-button ex-confirm"
              @onClick="onUpdate"
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
import ADatePicker from '@/views/components/ADatePicker.vue'
import MHeader from '@/views/lender/components/MHeader.vue'
import MFooter from '@/views/lender/components/MFooter.vue'

// const
import BUTTON from '@/consts/button'
// import HTTP_STATUS from '@/consts/httpStatus'
// import SEASON from '@/consts/season'
// import TOAST from '@/consts/toast'

// repository

export default {
  components: {
    AButton,
    AInputForm,
    ATextArea,
    ADatePicker,
    MHeader,
    MFooter,
  },

  data: () => ({
    BUTTON,
    isNew: false,
    isEditing: true,
    form: {
      user: {},
      phone: '',
      city_id: null,
      port_id: null,
      boats: [{ boat_name: '' }],
    },
  }),

  computed: {
    ...mapState('userModule', ['lenderUser']),
  },

  // async created() {

  // },

  methods: {
    onUpdate() {
      console.log('xxx')
    },
  },
}
</script>

<style lang="scss" src="@/../sass/lender/common.scss"></style>
<style lang="scss" src="@/../sass/lender/basicInfo.scss"></style>
