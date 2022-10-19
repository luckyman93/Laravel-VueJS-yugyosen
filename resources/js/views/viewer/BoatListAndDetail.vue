<!-- eslint-disable -->
<template>
  <div v-if="isList">
    <BoatList
      :prefectureParam="prefectureParam"
      :cityParam="cityParam"
      :portParam="param"
    />
  </div>
  <div v-else>
    <BoatDetail
      :prefectureParam="prefectureParam"
      :cityParam="cityParam"
      :boatId="param"
    />
  </div>
</template>
<!-- eslint-disable -->
<script>
import BoatDetail from '@/views/viewer/BoatDetail.vue'
import BoatList from '@/views/viewer/BoatList.vue'

export default {
  components: {
    BoatDetail,
    BoatList,
  },
  props: {
    prefectureParam: {
      type: null,
      required: true,
      default: null,
    },
    cityParam: {
      type: null,
      required: true,
      default: null,
    },
    param: {
      type: null,
      required: true,
      default: null,
    },
  },

  data: () => ({
    isList: false,
  }),

async created() {
    if (this.param.charAt(0) === 'p') {
      this.isList = true;
    } else {
      this.isList = false
    }
  },
}
</script>

<style lang="scss" src="@/../sass/viewer/common.scss"></style>
<style lang="scss" src="@/../sass/viewer/extra.scss"></style>
<style lang="scss" src="@/../sass/viewer/about.scss"></style>
