import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faUser, faLock, faSignOutAlt, faCog, faBuilding, faAddressCard, faIdCard, faUsers, faFlag, faFile, faList, faDoorClosed,
  faDoorOpen, faPlus, faSpinner
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faBuilding, faUser, faUsers, faAddressCard, faIdCard, faFlag, faFile,
  faList, faDoorClosed, faDoorOpen, faPlus, faSpinner
)

Vue.component('fa', FontAwesomeIcon)
