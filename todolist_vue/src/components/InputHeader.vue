<template>
  <div class="todo-header">
    <div class="title">我的待办事项</div>
    <input
      type="text"
      placeholder="请输入任务名称，按回车键确认"
      v-model="title"
      @keyup.enter="add"
    />
    <button class="btn btn-del" @click="add">添加</button>
  </div>
</template>

<script>
export default {
  name: "InputHeader",
  props: ["addTodo"],
  data() {
    return {
      title: "",
    };
  },
  methods: {
    add() {
      // 校验对象
      if (this.title.trim()) {
        // 将用户的输入包装为一个todo对象
        const todoObj = {
          title: this.title,
          // done: false,
        };
        // 通知App组件添加todoObj
        this.addTodo(todoObj);
        this.title = ""; // 清空输入
      }
    },
  },
};
</script>

<style scoped>
/*header*/
.title {
  margin-bottom: 5px;
}

.todo-header input {
  width: 500px;
  height: 28px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 4px 7px;
}

.todo-header input:focus {
  outline: none;
  border-color: rgba(82, 168, 236, 0.8);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075),
    0 0 8px rgba(82, 168, 236, 0.6);
}

.btn-del {
  margin-left: 8px;
  color: #fff;
  background-color: #497eda;
  border: 1px solid #2f42bd;
}
</style>