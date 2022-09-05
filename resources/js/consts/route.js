const ADMIN_PREFIX = 'admin'
const LENDER_PREFIX = 'lender'

export default {
  /*-------------------------------------------*/
  /*  VIEWER
  /*-------------------------------------------*/
  VIEWER: {
    HOME: {
      path: '/',
      name: 'home',
    },
    BOAT: {
      LIST1: {
        path: '/boat/:prefectureParam',
        name: 'BoatList1',
      },
      LIST2: {
        path: '/boat/:prefectureParam/:cityParam',
        name: 'BoatList2',
      },
      LIST3: {
        path: '/boat/:prefectureParam/:cityParam/:portParam',
        name: 'BoatList3',
      },
      DETAIL: {
        path: '/boat/:prefectureParam/:cityParam/:portParam/:boatId',
        name: 'BoatDetail',
      },
    },
    ABOUT: {
      path: '/about',
      name: 'about',
    },
    HOW_TO: {
      path: '/book.html',
    },
  },
  /*-------------------------------------------*/
  /*  ADMIN
  /*-------------------------------------------*/
  ADMIN: {
    LOGIN: {
      path: `/${ADMIN_PREFIX}/login`,
      name: `${ADMIN_PREFIX}Login`,
    },
    LENDER: {
      LIST: {
        path: `/${ADMIN_PREFIX}/lenders/list`,
        name: `${ADMIN_PREFIX}LenderList`,
      },
      DETAIL: {
        path: `/${ADMIN_PREFIX}/lenders/detail/:id`,
        name: `${ADMIN_PREFIX}LenderDetail`,
      },
    },
    PREFECTURE: {
      LIST: {
        path: `/${ADMIN_PREFIX}/prefectures/list`,
        name: `${ADMIN_PREFIX}PrefectureList`,
      },
      DETAIL: {
        path: `/${ADMIN_PREFIX}/prefectures/detail/:id`,
        name: `${ADMIN_PREFIX}PrefectureDetail`,
      },
    },
    CITY: {
      LIST: {
        path: `/${ADMIN_PREFIX}/cities/list`,
        name: `${ADMIN_PREFIX}CityList`,
      },
      DETAIL: {
        path: `/${ADMIN_PREFIX}/cities/detail/:id`,
        name: `${ADMIN_PREFIX}CityDetail`,
      },
    },
    PORT: {
      LIST: {
        path: `/${ADMIN_PREFIX}/ports/list`,
        name: `${ADMIN_PREFIX}PortList`,
      },
      DETAIL: {
        path: `/${ADMIN_PREFIX}/ports/detail/:id`,
        name: `${ADMIN_PREFIX}PortDetail`,
      },
    },
    NEWS: {
      LIST: {
        path: `/${ADMIN_PREFIX}/news/list`,
        name: `${ADMIN_PREFIX}NewsList`,
      },
      DETAIL: {
        path: `/${ADMIN_PREFIX}/news/detail/:id`,
        name: `${ADMIN_PREFIX}NewsDetail`,
      },
    },
  },
  /*-------------------------------------------*/
  /*  LENDER
  /*-------------------------------------------*/
  LENDER: {
    LOGIN: {
      path: `/${LENDER_PREFIX}/login`,
      name: `${LENDER_PREFIX}Login`,
    },
    MY_PAGE: {
      path: `/${LENDER_PREFIX}`,
      name: `${LENDER_PREFIX}Home`,
    },
    BASIC_INFO: {
      path: `/${LENDER_PREFIX}/basic-info`,
      name: `${LENDER_PREFIX}BasicInfo`,
    },
    POST: {
      LIST: {
        path: `/${LENDER_PREFIX}/posts/list`,
        name: `${LENDER_PREFIX}PostList`,
      },
      DETAIL: {
        path: `/${LENDER_PREFIX}/posts/detail/:id`,
        name: `${LENDER_PREFIX}PostDetail`,
      },
    },
    CALL_RANKING: {
      path: `/${LENDER_PREFIX}/call_ranking`,
      name: `${LENDER_PREFIX}CallRanking`,
    },
    PLAN_SETTING: {
      path: `/${LENDER_PREFIX}/plan_setting`,
      name: `${LENDER_PREFIX}PlanSetting`,
    },
  },
}
