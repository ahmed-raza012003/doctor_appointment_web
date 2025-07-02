@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4" style="color: #0f6d81;">Contact Us</h5>

            <div class="text-center">
                <p class="text-gray-700 text-sm mb-4">For direct assistance, please contact us via WhatsApp.</p>
                <p class="text-gray-800 font-semibold text-lg mb-4">WhatsApp: +1234567890</p>
                <a href="https://wa.me/1234567890" target="_blank" class="btn btn-primary" style="background-color: #11849B; border-color: #11849B;">
                    <i class="ti ti-brand-whatsapp me-2"></i> Message Us on WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.btn-primary {
    transition: all 0.2s ease-in-out;
}
.btn-primary:hover {
    background-color: #0f6d81;
    border-color: #0f6d81;
}
</style>
@endsection
