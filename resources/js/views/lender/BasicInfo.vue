<template>
  <div id="Wrapper" class="lender basic">
    <div class="lender-inner">
      <MHeader :title="'基本情報登録'" />
      <main class="main">
        <div class="main-form">
          <!-- ここから ＊BasicInfoと共通-->
          <div class="main-form-element">
            <AInputForm
              id="boast_number"
              v-model="form.boat_number"
              :required="true"
              label="船数"
              :disabled="!isNew && !isEditing"
              placeholder="00"
              class-name="ex-input ex-unit"
              type="number"
              behind-unit="隻"
            />
            <span v-if="errors && errors[`boat_number`]" class="error-message">{{
              errors[`boat_number`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="boat_name"
              v-model="form.boats[0].boat_name"
              :required="true"
              label="船名"
              :disabled="!isNew && !isEditing"
              placeholder="遊漁丸"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`boats.0.boat_name`]" class="error-message">{{
              errors[`boats.0.boat_name`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="boat_name"
              v-model="form.boats[0].boat_name_kana"
              :required="true"
              label="船名（かな）"
              :disabled="!isNew && !isEditing"
              placeholder="ゆうぎょまる"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`boats.0.boat_name_kana`]" class="error-message">{{
              errors[`boats.0.boat_name_kana`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="zip_code"
              v-model="form.zip_code"
              :required="true"
              label="郵便番号"
              :disabled="!isNew && !isEditing"
              placeholder="555-5555"
              class-name="ex-input"
              type="text"
            />
            <div class="font-xs ">半角数字（ハイフンを含む）でご入力ください</div>
            <span v-if="errors && errors[`zip_code`]" class="error-message">{{
              errors[`zip_code`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <span class="ex-tree-select">
              <ADropdown
                id="prefecture_id"
                v-model="form.prefecture_id"
                item-name="都道府県"
                :options="areaLists"
                :required="true"
                :searchable="true"
                label="prefecture_name"
                label-key="id"
                :disabled="!isNew && !isEditing"
              />
              <!-- @onChange="onChangeArea('prefecture')" -->
            </span>
            <span v-if="errors && errors[`prefecture_id`]" class="error-message">{{
              errors[`prefecture_id`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <span class="ex-tree-select">
              <ADropdown
                id="city_id"
                v-model="city_id"
                item-name="市町村"
                :options="cityList"
                :required="true"
                :searchable="true"
                label="city_name"
                label-key="id"
              />
              <!-- @onChange="onChangeArea('city')" -->
            </span>
            <span v-if="errors && errors[`city_id`]" class="error-message">{{
              errors[`city_id`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="address"
              v-model="form.address"
              :required="true"
              label="所番地"
              :disabled="!isNew && !isEditing"
              :searchable="true"
              placeholder="〇〇区〇〇町1-23"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`address`]" class="error-message">{{
              errors[`address`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <span class="ex-tree-select">
              <ADropdown
                id="port_id"
                v-model="port_id"
                item-name="港名"
                :options="portList"
                :required="true"
                :disabled="!isNew && !isEditing"
                :searchable="true"
                label="port_name"
                label-key="id"
              />
            </span>
            <span v-if="errors && errors[`port_id`]" class="error-message">{{
              errors[`port_id`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="access_example"
              v-model="form.access_example"
              :required="false"
              label="アクセス説明"
              :disabled="!isNew && !isEditing"
              placeholder="潮来（東関東自動車道）から11km"
              class-name="ex-input"
              type="text"
            />
          </div>

          <dl class="main-form-element ex-flex">
            <dt>業種</dt>
            <dd>
              <ACheckBox
                v-for="(item, index) in operationList"
                :id="`operation-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedOperationIds"
                :label="item.operation_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-12"
                @change="selectedOperationIds = $event"
              />
            </dd>
          </dl>

          <div class="main-form-element">
            <AInputForm
              id="name"
              v-model="form.user.name"
              :required="true"
              label="代表者名"
              :disabled="!isNew && !isEditing"
              placeholder="山田太郎"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`user.name`]" class="error-message">{{
              errors[`user.name`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="name"
              v-model="form.user.name_kana"
              :required="true"
              label="代表者名（ふりがな）"
              :disabled="!isNew && !isEditing"
              placeholder="やまだたろう"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`user.name_kana`]" class="error-message">{{
              errors[`user.name_kana`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="phone"
              v-model="form.phone"
              :required="true"
              label="電話番号"
              :disabled="!isNew && !isEditing"
              placeholder="000-0000-0000"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors['phone']" class="error-message">{{
              errors['phone'][0]
            }}</span>
          </div>
          <!-- 対応釣り方 -->
          <div class="ex-collapses">
            <MCollapse id="Method" label="対応釣り方" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in fishingOptionList"
                :id="`fishing-option-${index}`"
                :key="index"
                :ex-selected-ids="selectedFishingOptionIds"
                :value="item.id"
                :label="item.fishing_option_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-6"
                @change="selectedFishingOptionIds = $event"
              />
            </MCollapse>
            <!-- ターゲット[春] -->
            <MCollapse id="Spring" label="ターゲット[春]" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in targetList"
                :id="`target-spring-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedTargetIds.spring"
                :label="item.target_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-4"
                @change="selectedTargetIds.spring = $event"
              />
            </MCollapse>
            <!-- ターゲット[夏] -->
            <MCollapse id="Summer" label="ターゲット[夏]" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in targetList"
                :id="`target-summer-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedTargetIds.summer"
                :label="item.target_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-4"
                @change="selectedTargetIds.summer = $event"
              />
            </MCollapse>
            <!-- ターゲット[秋] -->
            <MCollapse id="Autumn" label="ターゲット[秋]" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in targetList"
                :id="`target-autumn-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedTargetIds.autumn"
                :label="item.target_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-4"
                @change="selectedTargetIds.autumn = $event"
              />
            </MCollapse>
            <!-- ターゲット[冬] -->
            <MCollapse id="Winter" label="ターゲット[冬]" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in targetList"
                :id="`target-winter-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedTargetIds.winter"
                :label="item.target_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-4"
                @change="selectedTargetIds.winter = $event"
              />
            </MCollapse>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="fishing_area"
              v-model="form.boats[0].fishing_area"
              :required="true"
              label="対応エリア"
              :disabled="!isNew && !isEditing"
              placeholder="有明海沖"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`boats.0.fishing_area`]" class="error-message">{{
              errors[`boats.0.fishing_area`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="capacity"
              v-model="form.boats[0].capacity"
              :required="true"
              label="最大定員"
              :disabled="!isNew && !isEditing"
              placeholder="00"
              class-name="ex-input ex-unit"
              type="number"
              behind-unit="名"
            />
            <span v-if="errors && errors[`boats.0.capacity`]" class="error-message">{{
              errors[`boats.0.capacity`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="departure"
              v-model="form.boats[0].departure"
              :required="true"
              label="出航時刻"
              :disabled="!isNew && !isEditing"
              placeholder="6:00,12:00"
              class-name="ex-input"
              type="text"
            />
            <span v-if="errors && errors[`boats.0.departure`]" class="error-message">{{
              errors[`boats.0.departure`][0]
            }}</span>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="fishing_point"
              v-model="form.boats[0].fishing_point"
              :required="false"
              label="釣り座の決め方"
              :disabled="!isNew && !isEditing"
              placeholder="予約順"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="price"
              v-model="form.price"
              :required="false"
              label="料金"
              :disabled="!isNew && !isEditing"
              placeholder="一人 10,000円〜"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="ex-collapses">
            <MCollapse id="Payment" label="支払い方法" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in paymentOptionList"
                :id="`payment-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedPaymentOptionIds"
                :label="item.payment_option_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-4"
                @change="selectedPaymentOptionIds = $event"
              />
            </MCollapse>
          </div>

          <div class="main-form-element">
            <AInputForm
              id="parking"
              v-model="form.parking"
              label="駐車場"
              :required="false"
              :disabled="!isNew && !isEditing"
              placeholder="有：無料 / 船長の指示にしたがってください"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <ATextArea
              id="tackle"
              v-model="form.boats[0].tackle"
              label="貸タックル"
              height="60px"
              :required="false"
              :disabled="!isNew && !isEditing"
              placeholder="竿・電動リールセット（仕掛け別、ロッドキーパー付）：\n2,000円/セット、長靴：無料"
              class-name="ex-input"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="length"
              v-model="form.boats[0].length"
              :required="false"
              label="全長"
              :disabled="!isNew && !isEditing"
              placeholder="00"
              class-name="ex-input ex-unit"
              behind-unit="メートル"
              type="number"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="weight"
              v-model="form.boats[0].weight"
              :required="false"
              label="重量"
              :disabled="!isNew && !isEditing"
              placeholder="00"
              class-name="ex-input ex-unit"
              behind-unit="トン"
              type="number"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="hp_url"
              v-model="form.hp_url"
              :required="false"
              label="ホームページ"
              :disabled="!isNew && !isEditing"
              placeholder="https://example.jp"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="main-form-element">
            <AInputForm
              id="map_url"
              v-model="form.map_url"
              :required="false"
              label="google map"
              :disabled="!isNew && !isEditing"
              placeholder="https://example.jp"
              class-name="ex-input"
              type="text"
            />
          </div>

          <div class="ex-collapses">
            <MCollapse id="Facility" label="船設備" class-name="main-form-element">
              <ACheckBox
                v-for="(item, index) in facilityList"
                :id="`facility-${index}`"
                :key="index"
                :value="item.id"
                :ex-selected-ids="selectedFacilityIds"
                :label="item.facility_name"
                :required="false"
                :disabled="!isNew && !isEditing"
                class-name="ex-check col-12"
                @change="selectedFacilityIds = $event"
              />
            </MCollapse>
          </div>

          <div class="main-form-element">
            <ATextArea
              id="caption_comment"
              v-model="form.boats[0].caption_comment"
              label="船長からひとこと"
              height="60px"
              :required="false"
              :disabled="!isNew && !isEditing"
              class-name="ex-input"
              placeholder="船の特徴・遊漁船運営をするにあたっての\n想い等を記述ください"
            />
          </div>

          <div class="main-form-element">
            <ATextArea
              id="other"
              v-model="form.other"
              label="備考"
              height="60px"
              :disabled="!isNew && !isEditing"
              :required="false"
              class-name="ex-input"
              placeholder="その他連絡事項等ございましたら記述ください"
            />
          </div>
          <div class="main-form-element ex-separate">
            <label>船写真登録</label>
            <div v-if="errors && errors[`boat_image_list.0.image_src`]" class="error-message">
              {{ errors[`boat_image_list.0.image_src`][0] }}
            </div>
            <AFileUpImages
              id="boat_img"
              save-folder-name="boat"
              accept="image/png, image/jpeg, image/gif"
              :ex-image-list="boatImageList"
              :is-s-b-s-layout="false"
              :is-editing="isEditing"
              @uploadImage="onUploadBoatImage"
              @deleteImage="onDeleteBoatImage"
            />
          </div>

          <div class="main-form-element ex-separate">
            <label>営業許可証登録</label>
            <div v-if="errors && errors[`permission_image_list.0.image_src`]" class="error-message">
              {{ errors[`permission_image_list.0.image_src`][0] }}
            </div>
            <AFileUpImages
              id="permission_img"
              save-folder-name="permission"
              accept="image/png, image/jpeg, image/gif"
              :ex-image-list="permissionImageList"
              :is-s-b-s-layout="false"
              :is-editing="isEditing"
              @uploadImage="onUploadPermissionImage"
              @deleteImage="onDeletePermissionImage"
            />
          </div>

          <div v-if="!isNew" class="main-form-element ex-separate">
            <div>パスワード変更</div>
            <div class="ex-">
              <AButton
                label="パスワードを変更する"
                :disabled="!isNew && !isEditing"
                class-name="ex-button ex-confirm"
                @onClick="onOpenChangePasswordModal"
              />
            </div>
          </div>
          <!-- ここまで -->
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
      <MPasswordChangeModal
        :password-valid-error-message="passwordValidErrorMessage"
        @onCancel="onChangePasswordCancel"
        @onChange="onChangePassword"
      />
      <MFooter />
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

// component
import AButton from '@/views/components/AButton.vue'
import ADropdown from '@/views/components/ADropdown.vue'
import AInputForm from '@/views/components/AInputForm.vue'
import AFileUpImages from '@/views/components/AFileUpImages.vue'
import ATextArea from '@/views/components/ATextArea.vue'
import ACheckBox from '@/views/components/ACheckBox.vue'
import MCollapse from '@/views/components/MCollapse.vue'
import MPasswordChangeModal from '@/views/components/MPasswordChangeModal.vue'
import MHeader from '@/views/lender/components/MHeader.vue'
import MFooter from '@/views/lender/components/MFooter.vue'

// const
import BUTTON from '@/consts/button'
import HTTP_STATUS from '@/consts/httpStatus'
import SEASON from '@/consts/season'
import TOAST from '@/consts/toast'

// repository
import { RepositoryFactory } from '@/repositories/repositoryFactory'

const facilityRepository = RepositoryFactory.get('facilities')
const fishingOptionRepository = RepositoryFactory.get('fishingOptions')
const lenderRepository = RepositoryFactory.get('lenders')
const paymentOptionRepository = RepositoryFactory.get('paymentOptions')
const prefectureRepository = RepositoryFactory.get('prefectures')
const operationRepository = RepositoryFactory.get('operations')
const targetRepository = RepositoryFactory.get('targets')
const userRepository = RepositoryFactory.get('users')

export default {
  components: {
    AButton,
    ADropdown,
    AInputForm,
    AFileUpImages,
    ATextArea,
    ACheckBox,
    MCollapse,
    MPasswordChangeModal,
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
      boats: [{ boat_name: '' }],
    },
    // リスト
    areaLists: [],
    allPortList: [],
    cityList: [],
    portList: [],
    paymentOptionList: [],
    facilityList: [],
    operationList: [],
    fishingOptionList: [],
    targetList: [],
    boatImageList: [],
    boatDeleteImageList: [],
    permissionImageList: [],
    permissionDeleteImageList: [],
    // 選択済ID
    selectedPaymentOptionIds: [],
    selectedFacilityIds: [],
    selectedOperationIds: [],
    selectedFishingOptionIds: [],
    selectedTargetIds: { spring: [], summer: [], autumn: [], winter: [] },
    // error, その他（処理完了後削除）
    errors: {},
    passwordValidErrorMessage: '',
    city_id: null,
    port_id: null,
  }),

  computed: {
    ...mapState('userModule', ['lenderUser']),
  },

  watch: {
    'form.prefecture_id': {
      handler(prefectureId, oldPrefectureId) {
        if (!prefectureId) {
          this.cityList = []
          this.city_id = null
          this.port_id = null
          return
        }
        if (oldPrefectureId) {
          this.city_id = null
          this.port_id = null
        }
        const areaListsRecord = this.areaLists.filter(x => x.id === prefectureId)
        this.cityList = areaListsRecord[0].cities
        this.portList = this.allPortList.filter(x => x.prefecture_id === prefectureId)
      },
    },
  },

  async created() {
    this.showLoader()
    await Promise.all([
      prefectureRepository.fetchAreaLists(),
      prefectureRepository.fetchPortslistsByPrefectureId(),
      paymentOptionRepository.fetchPaymentOptionList(),
      facilityRepository.fetchFacilityList(),
      fishingOptionRepository.fetchFishingOptionList(),
      operationRepository.fetchOperationList(),
      targetRepository.fetchList(),
    ])
      .then(
        ([
          prefectureRes1,
          prefectureRes2,
          paymentOptionRes,
          facilityRes,
          fishingOptionRes,
          operationRes,
          targetRes,
        ]) => {
          this.areaLists = prefectureRes1.data
          this.allPortList = prefectureRes2.data
          this.paymentOptionList = paymentOptionRes.data
          this.facilityList = facilityRes.data
          this.fishingOptionList = fishingOptionRes.data
          this.operationList = operationRes.data
          this.targetList = targetRes.data
        }
      )
      .catch(async err => {
        if (err.response) {
          await this.$errHandling.lenderCatch(err.response.status)
        }
      })
    this.hideLoader()

    await this.fetchLenderWithBoatDetail(this.lenderUser.id)
  },

  methods: {
    /*-------------------------------------------*/
    /* 詳細取得処理 閲覧者画面
    /*-------------------------------------------*/
    // 詳細取得
    async fetchLenderWithBoatDetail() {
      this.showLoader()

      await lenderRepository
        .showWithBoat(this.lenderUser.lender_id)
        .then(res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          this.form = res.data
          if (this.form.city === null) {
            this.city_id = null
          } else {
            this.city_id = this.form.city.id
          }
          if (this.form.port === null) {
            this.port_id = null
          } else {
            this.port_id = this.form.port.id
          }
          this.selectedPaymentOptionIds = this.form.payment_options.map(x => x.id)
          this.selectedFacilityIds = this.form.boats[0].facilities.map(x => x.id)
          this.selectedFishingOptionIds = this.form.boats[0].fishing_options.map(x => x.id)
          this.selectedOperationIds = this.form.boats[0].operations.map(x => x.id)
          // 季節別に選択済ターゲットを振り分け
          this.form.boats[0].targets.forEach(x => {
            if (x.pivot.season_id === SEASON.SPRING) {
              this.selectedTargetIds.spring.push(x.id)
            }
            if (x.pivot.season_id === SEASON.SUMMER) {
              this.selectedTargetIds.summer.push(x.id)
            }
            if (x.pivot.season_id === SEASON.AUTUMN) {
              this.selectedTargetIds.autumn.push(x.id)
            }
            if (x.pivot.season_id === SEASON.WINTER) {
              this.selectedTargetIds.winter.push(x.id)
            }
          })
          // 画像を画像リストへ格納
          // 船の画像
          for (let i = 1; i <= 5; i += 1) {
            const column = `boat_img_${i}`
            const data = {
              image_src: this.form.boats[0][column],
              image_name: this.form.boats[0][column], // 将来的に名前を表示するとなった時のため
              save_path: this.form.boats[0][column],
            }
            this.boatImageList.push(data)
          }
          // 営業許可画像
          const permissionImg = {
            image_src: this.form.permission_img,
            image_name: this.form.permission_img, // 将来的に名前を表示するとなった時のため
            save_path: this.form.permission_img,
          }
          this.permissionImageList.push(permissionImg)
        })
        .catch(async err => {
          if (err.response) {
            await this.$errHandling.lenderCatch(err.response.status)
            return
          }
          this.$toast.errorToast()
        })
      this.hideLoader()
    },
    /*-------------------------------------------*/
    /* 更新処理 閲覧者画面
    /*-------------------------------------------*/
    async onUpdate() {
      this.form.updated_user_id = this.lenderUser.id
      // チェックボックス 選択内容
      this.form.payment_option_ids = this.selectedPaymentOptionIds
      this.form.facility_ids = this.selectedFacilityIds
      this.form.fishing_option_ids = this.selectedFishingOptionIds
      this.form.operation_ids = this.selectedOperationIds
      this.form.targets = this.selectedTargetIds
      // 画像
      this.form.boat_image_list = this.boatImageList
      this.form.boat_delete_image_list = this.boatDeleteImageList
      this.form.permission_image_list = this.permissionImageList
      this.form.permission_delete_image_list = this.permissionDeleteImageList
      this.form.city_id = this.city_id
      this.form.port_id = this.port_id

      this.showLoader()

      lenderRepository
        .updateWithBoat(this.lenderUser.lender_id, this.form)
        .then(async res => {
          if (res.status !== HTTP_STATUS.OK) {
            this.$toast.errorToast()
            return
          }
          // 更新完了後の処理
          this.$toast.successToast(TOAST.SUCCESS.UPDATED)
          this.errors = {}
          this.boatDeleteImageList = []
          this.permissionDeleteImageList = []
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
      this.hideLoader()
    },
    /*-------------------------------------------*/
    /* モーダル
    /*-------------------------------------------*/
    onOpenChangePasswordModal() {
      this.$modal.show('password-change-modal')
    },
    onChangePasswordCancel() {
      this.$modal.hide('password-change-modal')
    },
    /*-------------------------------------------*/
    /* パスワード更新
    /*-------------------------------------------*/
    async onChangePassword(password) {
      this.showLoader()

      await userRepository
        .changePassword(this.lenderUser.id, password)
        .then(res => {
          if (res.status !== HTTP_STATUS.NO_CONTENT) {
            this.$toast.errorToast()
            return
          }

          this.$modal.hide('password-change-modal')
          this.$toast.successToast(TOAST.SUCCESS.UPDATED_PASSWORD)
        })
        .catch(async err => {
          await this.$errHandling.lenderCatch(err.response.status)
          this.$toast.errorToast()
        })

      this.hideLoader()
    },
    /*-------------------------------------------*/
    /* 画像処理
    /*-------------------------------------------*/
    // 船画像処理
    onUploadBoatImage(event) {
      this.boatImageList = event
    },
    onDeleteBoatImage(event) {
      this.boatImageList = event.image_list
      this.boatDeleteImageList = event.delete_image_list
    },
    // 営業許可画像
    onUploadPermissionImage(event) {
      this.permissionImageList = event
    },
    onDeletePermissionImage(event) {
      this.permissionImageList = event.image_list
      this.permissionDeleteImageList = event.delete_image_list
    },
    /*-------------------------------------------*/
    /* エリアドロップダウンの変更
    /*-------------------------------------------*/
    // イベントをキャッチしてクリアにする必要がなくてもしてしまう
    // onChangeArea(area) {
    // if (area === 'prefecture') {
    //   this.form.city_id = null
    //   this.form.port_id = null
    // }
    // if (area === 'city') {
    //   this.form.port_id = null
    // }
    // },
  },
}
</script>

<style lang="scss" src="@/../sass/lender/common.scss"></style>
<style lang="scss" src="@/../sass/lender/basicInfo.scss"></style>
