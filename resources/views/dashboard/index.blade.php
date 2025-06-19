@extends('dashboard')

@section('content')
 <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-white" style="background-color:#11849B; border: none; transition: transform 0.2s;">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-user-md fa-3x mb-3"></i>
                            <h5 class="card-title">Total Doctors</h5>
                            <p class="card-text display-6 fw-bold">25</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white" style="background-color:#11849B; border: none; transition: transform 0.2s;">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-stethoscope fa-3x mb-3"></i>
                            <h5 class="card-title">Specializations</h5>
                            <p class="card-text display-6 fw-bold">10</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white" style="background-color:#11849B; border: none; transition: transform 0.2s;">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-smile fa-3x mb-3"></i>
                            <h5 class="card-title">Satisfied Patients</h5>
                            <p class="card-text display-6 fw-bold">1200</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white" style="background-color:#11849B; border: none; transition: transform 0.2s;">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-calendar-check fa-3x mb-3"></i>
                            <h5 class="card-title">Active Services</h5>
                            <p class="card-text display-6 fw-bold">150</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Doctor Activities -->
            <div class="row mt-4">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold">Recent Doctor Activities</h5>
                            <ul class="timeline-widget mb-0 position-relative mb-n5">
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark mt-n1">Dr. Smith scheduled a dental checkup</div>
                                </li>
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div class="timeline-time text-dark flex-shrink-0 text-end">10:00</div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark mt-n1">Dr. Khan completed a consultation</div>
                                </li>
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div class="timeline-time text-dark flex-shrink-0 text-end">12:00</div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark mt-n1">Dr. Lee added to cardiology team</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Doctor Assignments</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Doctor</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Specialization</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Patients</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">Dr. John Smith</h6>
                                                <span class="fw-normal">Dentist</span>
                                            </td>
                                            <td class="border-bottom-0"><p class="mb-0 fw-normal">Dental</p></td>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">50</h6></td>
                                            <td class="border-bottom-0">
                                                <span class="badge bg-success rounded-3 fw-semibold">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">2</h6></td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">Dr. Sarah Khan</h6>
                                                <span class="fw-normal">Cardiologist</span>
                                            </td>
                                            <td class="border-bottom-0"><p class="mb-0 fw-normal">Cardiology</p></td>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">30</h6></td>
                                            <td class="border-bottom-0">
                                                <span class="badge bg-success rounded-3 fw-semibold">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">3</h6></td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">Dr. Michael Lee</h6>
                                                <span class="fw-normal">Orthopedist</span>
                                            </td>
                                            <td class="border-bottom-0"><p class="mb-0 fw-normal">Orthopedics</p></td>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">40</h6></td>
                                            <td class="border-bottom-0">
                                                <span class="badge bg-warning rounded-3 fw-semibold">On Leave</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection