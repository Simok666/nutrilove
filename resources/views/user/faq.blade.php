<x-user.layout title="Faq">
<!-- ======= F.A.Q Section ======= -->
<section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>F.A.Q</h2>
        <p>Frequently Asked Questions</p>
      </div>

      <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">
        @foreach($faq as $value)
        <li>
          <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$value->message}} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq1" class="collapse" data-bs-parent=".faq-list">
            <p>
                {{$value->answer}}
            </p>
          </div>
        </li>
        @endforeach
      </ul>

    </div>
  </section><!-- End F.A.Q Section -->
</x-user.layout>