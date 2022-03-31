<template>
  <div class="tags" v-bind="selected">
    <div
      class="tag"
      v-for="tag in tags"
      v-bind="{ id: tags.id, text: tags.name }"
      :key="tag.id"
    >
      <p class="tag-name" v-bind:class="tags.select" v-bind="tags.select">
        {{ tags.name }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchTags",
  data: {
    selected: "",
    tags: [
      { id: 1, name: "Needs", select: true },
      { id: 2, name: "Events", select: false },
      { id: 3, name: "Bursary", select: false },
      { id: 4, name: "Posts", select: false },
      { id: 5, name: "Users", select: false },
      { id: 6, name: "Company", select: false },
      { id: 7, name: "Books", select: false },
      { id: 8, name: "Zlto", select: false },
      { id: 9, name: "Institue", select: false },
    ],
  },
  methods: {},
};
</script>

<style scoped>
.tag {
  display: flex;
  flex-direction: row;
  background: cornsilk;
  color: #999;
  border-radius: 20px;
  margin-right: 5px;
}
.tag:hover {
  background: #007bff;
  color: #fff;
  border-radius: 15px;
  margin-right: 10px;
  margin-left: 10px;
}
.tag .active {
  background: #007bff;
  color: #fff;
  border-radius: 15px;
  margin-right: 10px;
  margin-left: 10px;
}
.tag-name {
  color: #999;
  padding: 10px 20px;
  font-size: 15px;
  font-weight: 400;
}
.tag-name:hover {
  padding: 12px 22px;
  font-size: 16px;
  font-weight: 500;
}
</style>
