<template>
  <div id="root">
    <div class="todo-container">
      <div class="todo-wrap">
        <InputHeader :addTodo="addTodo"></InputHeader>
        <List
          :todoArr="todoArr"
          :checkTodo="checkTodo"
          :deleteTodo="deleteTodo"
        />
        <CountFooter
          :todoArr="todoArr"
          :checkAllTodo="checkAllTodo"
          :clearDone="clearDone"
        />
      </div>
    </div>
  </div>
</template>

<script>
import InputHeader from "./components/InputHeader.vue";
import List from "./components/List.vue";
import CountFooter from "./components/CountFooter.vue";
import axios from "axios";

export default {
  name: "App",
  components: {
    InputHeader,
    List,
    CountFooter,
  },
  data() {
    return {
      // todoArr: JSON.parse(localStorage.getItem("todoArr")) || [
      //   { id: "1", title: "xxx", isDone: true },
      //   { id: "2", title: "xxxx", isDone: false },
      // ],
      todoArr: [],
      url: "http://localhost/todolist/",
    };
  },
  methods: {
    // 添加一个todo
    addTodo(todoObj) {
      // 解决axios的post请求后端无法接收的问题
      axios
        .post(
          this.url + "additem.php",
          { title: todoObj.title },
          {
            transformRequest: [
              function (data) {
                var str = "";
                for (var key in data) {
                  str +=
                    encodeURIComponent(key) +
                    "=" +
                    encodeURIComponent(data[key]) +
                    "&";
                }
                return str;
              },
            ],
          }
        )
        .then(() => {
          this.updateData();
        });
    },
    // （取消）勾选一个todo
    checkTodo(id) {
      // 发送请求
      axios
        .post(
          this.url + "updateitem.php",
          { id: id },
          {
            transformRequest: [
              function (data) {
                var str = "";
                for (var key in data) {
                  str +=
                    encodeURIComponent(key) +
                    "=" +
                    encodeURIComponent(data[key]) +
                    "&";
                }
                return str;
              },
            ],
          }
        )
        // 前端界面更新
        .then(() => {
          this.todoArr.forEach((item) => {
            if (item.id === id) {
              item.isDone = !item.isDone;
            }
          });
        });
    },
    // 删除一个todo
    deleteTodo(delId) {
      // 服务端将参数当做url参数接收时，axios的delete方法，格式为：{params: param}
      axios
        .delete(this.url + "removeitem.php", { params: { id: delId } })
        .then(
          () =>
            (this.todoArr = this.todoArr.filter((item) => item.id !== delId))
        );
    },
    // （取消）全选
    checkAllTodo(done) {
      let param = 0;
      if (done) param = 1;
      this.todoArr.forEach((item) => {
        axios
          .post(
            this.url + "doneall.php",
            { done: param },
            {
              transformRequest: [
                function (data) {
                  var str = "";
                  for (var key in data) {
                    str +=
                      encodeURIComponent(key) +
                      "=" +
                      encodeURIComponent(data[key]) +
                      "&";
                  }
                  return str;
                },
              ],
            }
          )
          .then(() => {
            item.isDone = done;
          });
      });
    },
    // 清除已完成Todo
    clearDone() {
      axios
        .delete(this.url + "cleardone.php")
        .then(
          () => (this.todoArr = this.todoArr.filter((item) => !item.isDone))
        );
    },
    updateData() {
      axios.get(this.url + "index.php").then((res) => {
        // console.log(res.data);
        if (res.data.length > 0) {
          this.todoArr.splice(0);
          res.data.forEach((row) => {
            const obj = {
              id: row.id,
              title: row.title,
              isDone: parseInt(row.is_done),
            };
            this.todoArr.push(obj);
          });
        }
      });
    },
  },
  // 更新本地存储
  // watch: {
  //   todoArr: {
  //     deep: true,
  //     handler(val) {
  //       localStorage.setItem("todoArr", JSON.stringify(val));
  //     },
  //   },
  // },
  // 挂载时访问服务器查询内容
  mounted() {
    this.updateData();
  },
};
</script>

<style>
/*base*/
body {
  background: #fff;
}

.btn {
  display: inline-block;
  padding: 4px 12px;
  margin-bottom: 0;
  font-size: 14px;
  line-height: 20px;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2),
    0 1px 2px rgba(0, 0, 0, 0.05);
  border-radius: 4px;
}

.btn-danger {
  color: #fff;
  background-color: #da4f49;
  border: 1px solid #bd362f;
}

.btn-danger:hover {
  color: #fff;
  background-color: #bd362f;
}

.btn:focus {
  outline: none;
}

.todo-container {
  width: 600px;
  margin: 0 auto;
}
.todo-container .todo-wrap {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}
</style>
