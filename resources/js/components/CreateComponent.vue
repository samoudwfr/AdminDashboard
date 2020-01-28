<template>
  <div class="row ">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <h4 class="col-10 card-title">Student Table</h4>
            <button class="btn btn-success" @click="newModal">Add Student</button>
          </div>
            <b-alert
                :show="dismissCountDown"
                dismissible
                fade
                :variant="alertType"
                @dismiss-count-down="countDownChanged"
            >
                {{msg}}
            </b-alert>
        </div>
        <div class="card-body ">
          <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                <th>#</th>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Student Phone</th>
                <th>Edit/Delete</th>
              </thead>

              <tbody>
                <tr v-for="(student, index) in students.data" :key="student.id">
                  <td>{{index +1 }}</td>
                  <td>{{student.name}}</td>
                  <td>{{student.email}}</td>
                  <td>{{student.phone}}</td>
                  <td>
                    <button class="btn btn-info" @click="editModal(student.id)">Edit</button>
                    <button class="btn btn-danger" @click="deleteStudent(student.id)">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
              <pagination :data="students" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addStudentModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-html="modalTitle">{{modalTitle}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <input
                  type="text"
                  v-model="studName"
                  class="form-control"
                  id="studentName"
                  placeholder="Student Name"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  v-model="studEmail"
                  class="form-control"
                  id="studentEmail"
                  placeholder="Student Email"
                />
              </div>
              <div class="form-group">
                <input
                  class="form-control"
                  v-model="studPhone"
                  id="studentPhone"
                  placeholder="Student Phone"
                />
              </div>

              <button
                type="submit"
                @click.prevent="saveStudent"
                v-show="!edit"
                class="btn btn-primary"
                data-dismiss="modal"
              >Save Student</button>
              <button
                type="submit"
                v-show="edit"
                @click.prevent="updateStudent"
                class="btn btn-primary"
                data-dismiss="modal"
              >Edit Student</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="application/javascript">
export default {
  data() {
    return {
      students: {},
      studId: "",
      studName: "",
      studEmail: "",
      studPhone: "",
      modalTitle: "",

        dismissSecs: 3,
        dismissCountDown: 0,
        showDismissibleAlert: false,

        msg: "",
        alertType:"",

      edit: false
    };
  },
    computed: {
      showHideAlert: function(){

      }

    },
  mounted() {
    console.log("Component mounted.");
    this.getResults();
  },
  methods: {
      countDownChanged(dismissCountDown) {
          this.dismissCountDown = dismissCountDown
      },
      showAlert() {
          this.dismissCountDown = this.dismissSecs
      },

  // Modals methods
    newModal() {
      this.modalTitle = "Add New Student";
      this.studName = "";
      this.studEmail = "";
      this.studPhone = "";
      this.edit = false;
      $("#addStudentModal").modal("show");
    },
    editModal(id) {
      this.modalTitle = "Edit Student";
      this.edit = true;
      this.editSudent(id);
      $("#addStudentModal").modal("show");
    },
   // -------- //

    // CRUD Operation
    saveStudent() {
      axios
        .post("saveStudent", {
          name: this.studName,
          email: this.studEmail,
          phone: this.studPhone
        })
        .then(response => {
          (this.studName = ""),
            (this.studEmail = ""),
            (this.studPhone = ""),
              this.msg = "Student successfully Saved";
            this.alertType = "success";
            this.showAlert(),

            this.getResults();

        });
    },
    editSudent(id) {
      axios.get("editStudent/" + id).then(response => {
        this.studId = response.data.id;
        this.studName = response.data.name;
        this.studEmail = response.data.email;
        this.studPhone = response.data.phone;
      });
    },
    updateStudent() {
      axios
        .put("updateStudent", {
          id: this.studId,
          name: this.studName,
          email: this.studEmail,
          phone: this.studPhone
        })
        .then(response => {
            this.msg = "Student successfully Updated";
            this.alertType = "success";
            this.showAlert();

          this.getResults();


        });
    },
    deleteStudent(id) {
      axios.delete("deleteStudent/" + id).then(response => {
          this.msg = "Student successfully Deleted";
          this.alertType = "warning";
          this.showAlert();
        this.getResults();
        });
    },
      // ------- //

      // Pagination
      getResults(page = 1) {
          axios.get("allStudents?page=" + page).then(response => {
              this.students = response.data;
          });
      }
      // -------- //
  }
};
</script>
