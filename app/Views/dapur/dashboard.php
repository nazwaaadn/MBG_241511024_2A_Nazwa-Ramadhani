 <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="main-banner header-text" id="top">
    <div class="Modern-Slider">
      <!-- Item -->
      <div class="item item-1">
        <div class="img-fill">
          <div class="text-content">
            <h4>Course Registration<br>Made Simple</h4>
            <p>
              This application helps students register for courses online with ease.
              A secure and efficient system that allows you to select, manage,
              and track your course schedule provided by the university.
            </p>
          </div>
        </div>
      </div>
      <!-- // Item -->
    </div>
  </div>


  <div class="services mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
        </div>

        <div class="col-md-5">
          <a href="<?= base_url('/addnewcourse') ?>">
            <div class="service-item justify-content-center">
              <img src="Student/assets/images/service_01.jpg" alt="">
              <div class="down-content">
                <center><img src="<?= base_url('image/inbox.png') ?>" alt="" srcset="" style="width: 50px; height: 50px; margin-bottom: 10px;"></center>
                <h4 class="mt-2">Add Course</h4>
                <p>Select the courses you want to enroll in. Make sure they fit your schedule and interests for the best learning experience.</p>

              </div>
            </div>
          </a>
        </div>


        <div class="col-md-5">
          <a href="#mycourse">
            <div class="service-item">
              <img src="Student/assets/images/service_02.jpg" alt="">
              <div class="down-content">
                <center><img src="<?= base_url('image/learning.png') ?>" alt="" srcset="" style="width: 50px; height: 50px; margin-bottom: 10px;"></center>
                <h4 class="mt-2">My Courses</h4>
                <p>Here’s a list of the courses you’re currently enrolled in. Keep track of them to stay on top of your learning.</p>
                <br>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>

  <section id="mycourse">
    <div class="services2">
      <div class="container">
        <div class="single-services mb-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 mb-5 align-items-center">
                <center>
                  <h3>My Courses</h3>
                  <p>Berikut adalah daftar mata kuliah yang telah Anda ambil:</p>
                </center>
              </div>
              <div class="col-md-3">
                <div class="list-group" id="v-pills-tab" role="tablist">
                  <a class="list-group-item list-group-item-action active"
                    id="theory-tab"
                    data-bs-toggle="pill"
                    href="#theory"
                    role="tab"
                    aria-controls="theory"
                    aria-selected="true">
                    Mata Kuliah Teori <i class="fa fa-angle-right float-end"></i>
                  </a>
                  <a class="list-group-item list-group-item-action"
                    id="practice-tab"
                    data-bs-toggle="pill"
                    href="#practice"
                    role="tab"
                    aria-controls="practice"
                    aria-selected="false">
                    Mata Kuliah Praktek <i class="fa fa-angle-right float-end"></i>
                  </a>
                  <a class="list-group-item list-group-item-action"
                    id="other-tab"
                    data-bs-toggle="pill"
                    href="#other"
                    role="tab"
                    aria-controls="other"
                    aria-selected="false">
                    Lainnya <i class="fa fa-angle-right float-end"></i>
                  </a>
                </div>
              </div>


              
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- <script>
    const user = [
        {
            user_id: 2717,
            username: "nazwa"
        }
    ];

    const user_student = user.filter(u => u.user_id.startsWith("STD"));

    function render(userArray, containerId) {
        const container = document.getElementById(containerId);
        userArray.forEach(user => {
            const card = document.createElement("div");
            card.className = "";
            card.innerHTML = `<h4>${user.user_id}</h4>`;
            container.appendChild(card);
            
        })
    }
    render(user_student, "student-contaner");
  </script>

  <script>
    const form = document.getElemetById("course-form");
    const errorMessage = document.getElementById("error-message");

    let tampiljumlah = documet.getElementById("total_student");
    if (!tampiljumlah) {
        tampiljumlah = document.createElement("p");
        tampiljumlah.ig = "total_student";
        tampiljumlah.className = "";
        form.prepend(tampiljumlah);
    }
    
    let takes = []; //define array

    function name(params) {
        setTimeout(() => {
            
        }, timeout);
    }
  </script> -->