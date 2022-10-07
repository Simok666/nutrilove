<x-user.layout title="Kontak Kami">
<!-- ======= Contact Us Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Hubungi Kami</h2>
        <p>Hubungi kami untuk memulai</p>
      </div>

      <div class="row">

        <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="info">
            <div class="address">
             
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>direktorat@poltekkes-malang.ac.id</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>No. Telp:</h4>
              <p>+62-341-566075</p>
            </div>

            <iframe src="https://maps.google.com/maps?q=Ijen%20St%20No.77C,%20Oro-oro%20Dowo,%20Klojen,%20Malang%20City,%20East%20Java%2065119&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
          </div>

        </div>

        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <form action="" id="faq" method="POST" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Nama </label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <label for="name">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <label for="name">Kategori Pertanyaan</label>
              {{-- <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required> --}}
              <select class="form-select" name="subject" id="subject" aria-label="Default select example">
                <option selected>Pilih Pertanyaan</option>
                <option value="Remaja">Remaja</option>
                <option value="Ibu Hamil">Ibu Hamil</option>
                <option value="Ibu Menyusui">Ibu Menyusui</option>
                <option value="Bayi dan Anak">Bayi dan Anak</option>
              </select>
            </div>
            <div class="form-group mt-3">
              <label for="name">Pertanyaan</label>
              <textarea class="form-control" name="message" rows="10" required></textarea>
            </div>
            {{-- <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div> --}}
            <div class="text-center"><button type="submit">Kirim Pertanyaan</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Us Section -->
</x-user.layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var FrmEditAdmin = $("#faq").validate({
        submitHandler: function(form) {
            setTimeout(() => {
                submitData(form, "/faq", function(resp) {
                    if (resp.IsError === false) {
                        location.href= base_url + "/faq" 
                    }
                }, function (resp) {  
                    toastrshow("success", resp['success'], "Success");
                    $("#faq")[0].reset();
                })
            }, 400);
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element); // default
        }
    });
</script>