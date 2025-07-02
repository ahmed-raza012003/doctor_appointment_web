<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Appointment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom, #f1f5f9, #e2e8f0);
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .title {
            color: #0f6d81;
            font-weight: 700;
            letter-spacing: -0.025em;
        }
        .label {
            font-weight: 600;
            color: #1f2937;
        }
        .select, .input {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.2s ease-in-out;
        }
        .select:focus, .input:focus {
            border-color: #0f6d81;
            ring: 2px solid #0f6d81;
            outline: none;
        }
        .timeslot-item {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem;
            text-align: center;
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .timeslot-item:hover:not([disabled]) {
            background-color: #e6f0fa;
            transform: translateY(-2px);
        }
        .timeslot-item.selected {
            background-color: #0f6d81 !important;
            border-color: #0f6d81 !important;
            color: #ffffff !important;
        }
        .timeslot-item[disabled] {
            background-color: #f3f4f6;
            cursor: not-allowed;
            color: #6b7280;
        }
        .confirm-button {
            background-color: #0f6d81 !important;
            border-color: #0f6d81 !important;
            color: #ffffff !important;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .confirm-button:hover {
            background-color: #0a5b6b !important;
            transform: translateY(-1px);
        }
        .confirm-button:focus {
            ring: 2px solid #0f6d81;
            outline: none;
        }
        @media (max-width: 640px) {
            .timeslot-list {
                grid-template-columns: 1fr;
            }
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="font-sans text-gray-800">
    <div class="container mx-auto p-4 sm:p-6">
        <h1 class="title text-3xl sm:text-4xl text-center mb-8">Schedule Your Appointment</h1>
        
        <div class="card max-w-2xl mx-auto">
            <form action="{{ route('booking.store') }}" method="POST" id="booking-form" class="space-y-6">
                @csrf
                
                <div>
                    <label for="doctor_id" class="label block text-sm mb-2">Choose Your Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="select block w-full text-sm" required>
                        <option value="">Select a doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="service_id" class="label block text-sm mb-2">Select Service</label>
                    <select name="service_id" id="service_id" class="select block w-full text-sm" required>
                        <option value="">Select a service</option>
                    </select>
                    @error('service_id')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="label block text-sm mb-2">Select Date</label>
                    <input type="date" id="appointment_date" class="input block w-full text-sm" required>
                </div>

                <div>
                    <label class="label block text-sm mb-2">Available Timeslots</label>
                    <div id="timeslot-container" class="timeslot-list grid grid-cols-2 sm:grid-cols-3 gap-3"></div>
                    <input type="hidden" name="appointment_time" id="appointment_time" required>
                </div>

                <button type="submit" class="confirm-button w-full text-sm">Confirm Booking</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log('Initial doctors data:', @json($doctors));
            console.log('Initial services data:', @json($services));

            $('#doctor_id').on('change', function() {
                console.log('Doctor selection changed event triggered');
                const doctorId = $(this).val();
                console.log('Doctor selected:', { doctorId: doctorId });

                if (doctorId) {
                    console.log('Initiating AJAX call for services:', { doctorId: doctorId });
                    $.ajax({
                        url: '{{ route("booking.services") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            doctor_id: doctorId
                        },
                        beforeSend: function() {
                            console.log('Sending AJAX request for services:', { doctorId: doctorId });
                        },
                        success: function(response) {
                            console.log('Services fetched successfully:', {
                                doctorId: doctorId,
                                services: response
                            });
                            const serviceSelect = $('#service_id');
                            serviceSelect.empty();
                            serviceSelect.append('<option value="">Select a service</option>');
                            response.forEach(function(service) {
                                serviceSelect.append(
                                    `<option value="${service.id}">${service.name}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching services:', {
                                doctorId: doctorId,
                                status: status,
                                error: error,
                                response: xhr.responseText
                            });
                            $('#service_id').empty().append('<option value="">Select a service</option>');
                        }
                    });
                } else {
                    console.log('No doctor selected, clearing services and timeslots');
                    $('#service_id').empty().append('<option value="">Select a service</option>');
                    $('#timeslot-container').empty();
                }
                loadTimeslots();
            }).trigger('change');

            $('#appointment_date, #doctor_id').on('change', function() {
                loadTimeslots();
            });

            function loadTimeslots() {
                const doctorId = $('#doctor_id').val();
                const appointmentDate = $('#appointment_date').val();
                if (doctorId && appointmentDate) {
                    console.log('Initiating AJAX call for timeslots:', {
                        doctorId: doctorId,
                        appointmentDate: appointmentDate
                    });
                    $.ajax({
                        url: '{{ route("booking.timeslots") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            doctor_id: doctorId,
                            start_date: appointmentDate,
                            end_date: appointmentDate
                        },
                        beforeSend: function() {
                            console.log('Sending AJAX request for timeslots:', {
                                doctorId: doctorId,
                                appointmentDate: appointmentDate
                            });
                            $('#timeslot-container').empty().append('<p class="text-gray-500 text-sm">Loading...</p>');
                        },
                        success: function(response) {
                            console.log('Timeslots fetched successfully:', {
                                doctorId: doctorId,
                                timeslots: response
                            });
                            const container = $('#timeslot-container');
                            container.empty();
                            if (response.length > 0) {
                                response.forEach(function(slot) {
                                    const startTime = new Date(slot.value).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
                                    const endTime = new Date(new Date(slot.value).getTime() + 30 * 60000).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
                                    const isBooked = slot.booked;
                                    container.append(
                                        `<button type="button" class="timeslot-item text-sm ${isBooked ? 'bg-gray-200 cursor-not-allowed' : ''}" data-time="${slot.value}" ${isBooked ? 'disabled' : ''}>
                                            ${startTime} - ${endTime}
                                        </button>`
                                    );
                                });
                                $('.timeslot-item:not([disabled])').on('click', function() {
                                    $('.timeslot-item').removeClass('selected');
                                    $(this).addClass('selected');
                                    $('#appointment_time').val($(this).data('time'));
                                    console.log('Selected timeslot:', { time: $(this).data('time'), doctorId: doctorId });
                                });
                            } else {
                                container.append('<p class="text-gray-500 text-sm">No available timeslots</p>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching timeslots:', {
                                doctorId: doctorId,
                                status: status,
                                error: error,
                                response: xhr.responseText
                            });
                            $('#timeslot-container').empty().append('<p class="text-red-500 text-sm">Failed to load timeslots</p>');
                        }
                    });
                } else {
                    console.log('No doctor or date selected, clearing timeslots');
                    $('#timeslot-container').empty();
                }
            }
        });
    </script>
</body>
</html>