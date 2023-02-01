<template>
  <div>
    <!-- Uso il loader -->

    <Loader v-if="isLoading" class="px-3" />

    <div>
      <ul v-if="posts.length">
        <li v-for="elem in posts" :key="elem.id">{{ elem.title }}</li>
      </ul>
      <p v-else>Non ci sono posts nel DB</p>
    </div>

    <Pagination :pagination="pagination" @on-page-change="getPosts"/>

  </div>
</template>

<script>
import Loader from "../Loader.vue";
import Pagination from "../Pagination.vue";

export default {
  name: "PostsList",
  components: {
    Loader,
    Pagination,
  },
  data() {
    return {
      posts: [],
      isLoading: false,
      pagination: [],
    };
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    getPosts(page = 1) {
      this.isLoading = true;
      axios
        .get("http://127.0.0.1:8000/api/posts?page=" + page)
        .then((res) => {
          console.log(res.data);

          //Destrutturizzazione
          const { data, current_page, last_page } = res.data;
          this.posts = data;
          this.pagination = {
            lastPage: last_page,
            currentPage: current_page,
          };
        })
        .catch((err) => {
          console.log(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

<style scoped lang="scss">
</style>