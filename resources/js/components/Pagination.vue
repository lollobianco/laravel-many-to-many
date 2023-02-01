<template>
  <div>
    <nav aria-label="Page navigation example">
      <ul class="pagination">

        <li @click="$emit('on-page-change', pagination.currentPage - 1)" v-if="pagination.currentPage > 1" class="page-item" role="button">
          <span class="page-link" role="button" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </span>
        </li>

        <li @click="$emit('on-page-change', n)" v-for="n in pagination.lastPage" :key="n" class="page-item" role="button">
          <span role="button" class="page-link">{{ n }}</span>
        </li>

        <li @click="$emit('on-page-change', pagination.currentPage + 1)" v-if="pagination.lastPage > pagination.currentPage" class="page-item" role="button">
          <span class="page-link" role="button" aria-label="Next">
            <span aria-hidden="true" role="button">&raquo;</span>
          </span>
        </li>

      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  props: ['pagination']
};
</script>

<style>
</style>