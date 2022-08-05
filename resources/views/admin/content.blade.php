<x-admin.layout title="Content">
    <x-slot name="styles">
      
    </x-slot>
    <!-- Modal Themes start -->
    <section id="modal-themes">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Edit Content / Artilces</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="modal-primary me-1 mb-1 d-inline-block">
                      <!-- Button trigger for primary themes modal -->
                      @foreach($menu as $value)
                        <?php $func = $value->function."('".$value->name."','".$value->title."','".$value->url."','".$value->newtab."','".$value->view."')";  ?>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <button type="button" data-title='{{ $value->name }}' onClick='{{ $func }}' class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#primary"> {{ $value->name }} </button>
                      @endforeach
                      <!--primary theme Modal -->
                      <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary">
                              <h5 class="modal-title white" id="myModalLabel160">Primary Modal</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                              </button>
                            </div>
                            <div class="modal-body" id="isi-modal"> 
                            
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                              </button>
                              <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Accept</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal Themes end -->
    <x-slot name="scripts">
    {{-- <script> alert('tes')</script> --}}
  
    </x-slot>
  </x-admin.layout>