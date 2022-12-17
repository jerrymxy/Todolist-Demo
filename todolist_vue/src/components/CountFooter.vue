<template>
  <div class="todo-footer" v-show="total">
    <label>
      <input type="checkbox" v-model="isAllChecked" />
    </label>
    <span>
      <span>已完成{{ doneTotal }}</span> / 全部{{ total }}
    </span>
    <button class="btn btn-danger" @click="claerAllDone">清除已完成任务</button>
  </div>
</template>

<script>
export default {
  name: "CountFooter",
  props: ["todoArr", "checkAllTodo", "clearDone"],
  computed: {
    total() {
      return this.todoArr.length;
    },
    doneTotal() {
      return this.todoArr.reduce((pre, cur) => pre + (cur.isDone ? 1 : 0), 0);
    },
    isAllChecked: {
      get() {
        return this.total > 0 && this.doneTotal === this.total;
      },
      set(value) {
        this.checkAllTodo(value);
      },
    },
  },
  methods: {
    claerAllDone() {
      if (confirm("是否确定清除全部已完成项目？")) {
        this.clearDone();
      }
    }
  }
};
</script>

<style scoped>
/*footer*/
.todo-footer {
  height: 40px;
  line-height: 40px;
  padding-left: 6px;
  margin-top: 5px;
}

.todo-footer label {
  display: inline-block;
  margin-right: 20px;
  cursor: pointer;
}

.todo-footer label input {
  position: relative;
  top: -1px;
  vertical-align: middle;
  margin-right: 5px;
}

.todo-footer button {
  float: right;
  margin-top: 5px;
}
</style>