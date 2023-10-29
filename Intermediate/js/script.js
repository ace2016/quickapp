var app = new Vue({
	el: "#todo",
	data: {
		todo_data: { id: "", title: "", description: "" },
		lists: [],
	},

	mounted: function () {
		//method for hot refresh
		this.getList();
	},

	methods: {
		//method for hot refresh
		getList() {
			// var fData = app.toFormData({ action: "get_todo" });

			axios({
				url: API + "?action=get_todo",
				method: "get",
				// data: fData,
				headers: {
					"Cache-Control": "no-cache, no-store, must-revalidate",
					Pragma: "no-cache",
					Expires: "0",
				},
			})
				.then((resData) => {
					this.lists = resData.data.rows;
				})
				.catch((error) => {
					console.log(error);
				});
		},

		//to add new todo list
		addTodo: function () {
			//Passing all data in the form to the assigned variable
			let fData = app.toFormData(app.todo_data);

			// var fData2 = app.toFormData({
			//     title: app.todo_data.title,
			//     description: app.todo_data.description,
			//     action: "add_todo"
			// });

			if (this.todo_data.title == "") {
				window.alert("Todo title empty");
			} else if (this.todo_data.description == "") {
				window.alert("Todo description empty");
			} else {
				fData.append("action", "add_todo");

				axios({
					url: API,
					method: "post",
					data: fData,
					headers: {
						"Cache-Control": "no-cache, no-store, must-revalidate",
						Pragma: "no-cache",
						Expires: "0",
					},
				})
					.then((resData) => {
						if (resData.data.error == true) {
							// window.alert(resData.data.message);
							alertToast("Error", resData.data.message, "error", 10000);
						} else if (
							resData.data.error == false &&
							resData.data.status == "success"
						) {
							//window.alert(resData.data.message);
							this.todo_data.title = "";
							this.todo_data.description = "";
							alertToast("Success", resData.data.message, "success", 5000);
							this.getList();
						}
					})
					.catch((error) => {
						console.log(error);
					});
			}
		},

		//editing the database obj
		editList: function (action, id = "", title = "", description = "") {
			if (action == "show") {
				this.todo_data.id = id;
				this.todo_data.title = title;
				this.todo_data.description = description;
				$("#btnAdd").hide();
				$("#btnEdit").show();
			} else if (action == "edit") {
				var fData = app.toFormData({
					id: app.todo_data.id,
					title: app.todo_data.title,
					description: app.todo_data.description,
					action: "edit_todo",
				});

				axios({
					url: API,
					method: "post",
					data: fData,
					headers: {
						"Cache-Control": "no-cache, no-store, must-revalidate",
						Pragma: "no-cache",
						Expires: "0",
					},
				})
					.then((resData) => {
						if (resData.data.error == true) {
							alertToast("Error", resData.data.message, "error", 10000);
							// window.alert(resData.data.message);
						} else if (
							resData.data.error == false &&
							resData.data.status == "success"
						) {
							alertToast("Success", resData.data.message, "success", 2000);
							// window.alert(resData.data.message);
							this.todo_data.id = "";
							this.todo_data.title = "";
							this.todo_data.description = "";
							$("#btnAdd").show();
							$("#btnEdit").hide();

							this.getList();
						}
					})
					.catch((error) => {
						console.log(error);
					});
			}
		},

		//deleting the todo items
		deleteTodo(id) {
			var fData = app.toFormData({
				id: id,
				action: "delete_todo",
			});

			axios({
				url: API,
				method: "post",
				data: fData,
				headers: {
					"Cache-Control": "no-cache, no-store, must-revalidate",
					Pragma: "no-cache",
					Expires: "0",
				},
			})
				.then((resData) => {
					if (resData.data.error == true) {
						// window.alert(resData.data.message);
					} else if (
						resData.data.error == false &&
						resData.data.status == "success"
					) {
						// window.alert(resData.data.message);
						alertModal("Success", resData.data.message, "info", "Confirm")
						this.getList();
					}
				})
				.catch((error) => {
					console.log(error);
				});
		},

		checkTodo(id) {
			var fData = app.toFormData({
				id: id,
				action: "check_todo",
			});

			axios({
				url: API,
				method: "post",
				data: fData,
				headers: {
					"Cache-Control": "no-cache, no-store, must-revalidate",
					Pragma: "no-cache",
					Expires: "0",
				},
			})
				.then((resData) => {
					if (resData.data.error == true) {
						// window.alert(resData.data.message);
					} else if (
						resData.data.error == false &&
						resData.data.status == "success"
					) {
						// window.alert(resData.data.message);
						alertToast("Success", resData.data.message, "info", 3000)
						this.getList();
					}
				})
				.catch((error) => {
					console.log(error);
				});
		},

		//initial method - default for all form
		toFormData: function (obj) {
			var form_data = new FormData();
			for (var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		},
	},
});
