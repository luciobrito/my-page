import { useRoute } from "vue-router";
import axios from "axios";
import DateConvert from "../../../dateConverter";
import LoadingSpinner from "../../modules/LoadingSpinner.vue";
import UserNotFound from "../../error/UserNotFound.vue";
import Error_500 from "../../error/Error_500.vue";
import CreatePostModal from "./CreatePostModal.vue";
export default {
  components: {
    LoadingSpinner,
    UserNotFound,
    Error_500,
    CreatePostModal
  },
  data() {
    return {
      user: {
        joined_in: "",
        posts: [],
      },
      error: {
        status: 0,
      },
      loading: false,
      dialog: false
    };
  },
  methods: {
    getUserProfileData() {
      this.loading = true;
      const route = useRoute();
      var username = route.params.username;
        axios(`/profile/${username}`)
          .then((response) => {
            this.user = response.data;
            /*Converte a data de ISO para comum */
            this.user.joined_in = DateConvert(response.data.joined_in, false);
            /*Para cada post, data do post = data convertida */
            this.user.posts.map((post) => {
              post.updated_at = DateConvert(post.updated_at, true);
            });
          })
          .catch((error) => {
            this.error.status = error.response.status;
          })
          .finally(() => (this.loading = false));
    },
  },
  beforeMount() {
    this.getUserProfileData();
  },
};