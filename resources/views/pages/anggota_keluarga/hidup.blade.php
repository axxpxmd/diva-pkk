<!-- Stepper -->
<div id="stepperForm" class="bs-stepper mt-2">
    <div class="bs-stepper-header mb-4 rounded-3" role="tablist" style="background: #F2F2F2">
        <div class="step" data-target="#test-form-1">
            <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1">
                <span class="bs-stepper-circle bg-info">
                    <span class="bi bi-person"></span>
                </span>
                <span class="bs-stepper-label" id="data1">Data 1</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-2">
            <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2">
                <span class="bs-stepper-circle bg-warning">
                    <span class="bi bi-person"></span>
                </span>
                <span class="bs-stepper-label">Data 2</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-3">
            <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3">
                <span class="bs-stepper-circle bg-success">
                    <span class="bi bi-person"></span>
                </span>
                <span class="bs-stepper-label">Data 3</span>
            </button>
        </div>
    </div>
    <div class="bs-stepper-content">
        <!-- Stepper Content -->
        <form class="form-stepper fs-14" id="form-hidup" method="POST" enctype="multipart/form-data" novalidate>
            {{ method_field('POST') }}
            <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger1">
                <p class="text-center fw-bold fs-16">Data 1 : Berisikan data diri anggota keluarga</p>
                @include('pages.anggota_keluarga.data1')
            </div>
            <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger2">
                <p class="text-center fw-bold fs-16">Data 2 : Berisikan data kesehatan anggota keluarga</p>
                @include('pages.anggota_keluarga.data2')
            </div>
            <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger3">
                <p class="text-center fw-bold fs-16">Data 3 : Berisikan data kegiatan anggota keluarga</p>
                {{-- @include('pages.anggota_keluarga.data3') --}}
            </div>
        </form>
    </div>
</div>