import { createApp } from 'vue'
import App from './App.vue'

//import router
import router from './router'

//import Bootstrap, Popper, jQuery
import 'bootstrap/dist/css/bootstrap.min.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon, FontAwesomeLayers, FontAwesomeLayersText } from '@fortawesome/vue-fontawesome'
/* import specific icons */
import { faUserSecret, faUserCircle, faPhone, faComments, faBookmark, faTag, faCheckCircle, faB, faCircle} from '@fortawesome/free-solid-svg-icons'
import { faSquareFacebook, faFacebookF, faSquareTwitter, faTwitter, faSquareGooglePlus, faGooglePlusG } from '@fortawesome/free-brands-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faUserCircle, faPhone, faComments, faBookmark, faTag, faCheckCircle, faB, faCircle)
library.add(faSquareTwitter, faTwitter, faSquareFacebook, faFacebookF, faSquareGooglePlus, faGooglePlusG)

const app = createApp(App)

app.use(router)
app.component('font-awesome-icon', FontAwesomeIcon)
app.component('font-awesome-layers', FontAwesomeLayers)
app.component('font-awesome-layers-text', FontAwesomeLayersText)
app.mount('#app')
