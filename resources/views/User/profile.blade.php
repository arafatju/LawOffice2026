@extends('common.notary2')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 font-weight-bold">Notary Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Documents - Profile Image -->
                        <div class="col-md-3 text-center mb-4">
                            @if(isset($documents->image) && !empty($documents->image))
                            <img src="{{ route('secure.image', ['appid' => session('appid'), 'filename' => $documents->image]) }}" alt="Profile Image" class="img-fluid rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 200px;">
                                    <i class="fas fa-user fa-5x text-secondary"></i>
                                </div>
                            @endif
                            <div class="mt-3">
                                <h4 class="font-weight-bold">{{ $personalInfo->name ?? 'N/A' }}</h4>
                                <p class="text-muted">Notary Public</p>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="border-bottom pb-2 mb-3"><i class="fas fa-user-circle mr-2"></i>Personal Information</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Full Name</p>
                                    <p class="font-weight-bold">{{ $personalInfo->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Father's Name</p>
                                    <p class="font-weight-bold">{{ $personalInfo->father ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Mother's Name</p>
                                    <p class="font-weight-bold">{{ $personalInfo->mother ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Date of Birth</p>
                                    <p class="font-weight-bold">{{ isset($personalInfo->dob) ? date('F d, Y', strtotime($personalInfo->dob)) : 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">National ID</p>
                                    <p class="font-weight-bold">{{ $personalInfo->nid ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">District</p>
                                    <p class="font-weight-bold">{{ $personalInfo->district ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Mobile</p>
                                    <p class="font-weight-bold">{{ $personalInfo->mobile ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Email</p>
                                    <p class="font-weight-bold">{{ $personalInfo->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Notary Information Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4 h-100">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0 font-weight-bold"><i class="fas fa-gavel mr-2"></i>Notary Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="text-muted">Bar Number</td>
                                        <td class="font-weight-bold">{{ $notaryInfo->barnumber ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Bar Date</td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->bardate) ? date('F d, Y', strtotime($notaryInfo->bardate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Law Number</td>
                                        <td class="font-weight-bold">{{ $notaryInfo->lawnumber ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Law Date</td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->lawdate) ? date('F d, Y', strtotime($notaryInfo->lawdate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Experience</td>
                                        <td class="font-weight-bold">{{ $notaryInfo->exp ?? 'N/A' }} Years</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Notary Sarok</td>
                                        <td class="font-weight-bold">{{ $notaryInfo->notarysarok ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Notary Date</td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->natarydate) ? date('F d, Y', strtotime($notaryInfo->natarydate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Practice Area</td>
                                        <td class="font-weight-bold">{{ $notaryInfo->area ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Renewal Date</td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->renewdate) ? date('F d, Y', strtotime($notaryInfo->renewdate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Last Renewed</td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->lastrenewdate) ? date('F d, Y', strtotime($notaryInfo->lastrenewdate)) : 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Educational & Documentation -->
                <div class="col-md-6">
                    <!-- Educational Information Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0 font-weight-bold"><i class="fas fa-graduation-cap mr-2"></i>Educational Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="text-muted">SSC Passed</td>
                                        <td class="font-weight-bold">{{ $educationInfo->sscpass ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">HSC Passed</td>
                                        <td class="font-weight-bold">{{ $educationInfo->hscpass ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Higher Education 1</td>
                                        <td class="font-weight-bold">{{ $educationInfo->edu1 ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Higher Education 2</td>
                                        <td class="font-weight-bold">{{ $educationInfo->edu2 ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Documents Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning">
                            <h4 class="mb-0 font-weight-bold"><i class="fas fa-file-alt mr-2"></i>Documents</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-signature fa-2x mb-2 text-primary"></i>
                                            <h6 class="mb-0">Signature</h6>
                                           
                                            @if(isset($documents->signature) && !empty($documents->signature))
                                            <a href="{{ route('secure.image', ['appid' => session('appid'), 'filename' => $documents->signature]) }}"
                                                class="btn btn-sm btn-outline-primary mt-2" target="_blank">View</a>
                                                                                         @else
                                                <span class="badge badge-secondary mt-2">Not Uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-certificate fa-2x mb-2 text-info"></i>
                                            <h6 class="mb-0">Bar Certificate</h6>
                                            @if(isset($documents->barcertificate) && !empty($documents->barcertificate))
                                            <a href="{{ route('secure.image', ['appid' => session('appid'), 'filename' => $documents->barcertificate]) }}" class="btn btn-sm btn-outline-primary mt-2" target="_blank">View</a>
                                            @else
                                                <span class="badge badge-secondary mt-2">Not Uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-scroll fa-2x mb-2 text-success"></i>
                                            <h6 class="mb-0">Notary Certificate</h6>
                                            @if(isset($documents->notarycertificate) && !empty($documents->notarycertificate))
                                            <a href="{{ route('secure.image', ['appid' => session('appid'), 'filename' => $documents->notarycertificate]) }}"
                                                class="btn btn-sm btn-outline-primary mt-2"
                                                target="_blank">View</a>
                                                                                         @else
                                                <span class="badge badge-secondary mt-2">Not Uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-id-card fa-2x mb-2 text-danger"></i>
                                            <h6 class="mb-0">NID Certificate</h6>
                                            @if(isset($documents->nidcertificate) && !empty($documents->nidcertificate))
                                            <a href="{{ route('secure.image', ['appid' => session('appid'), 'filename' => $documents->nidcertificate]) }}"
                                                class="btn btn-sm btn-outline-primary mt-2"
                                                target="_blank">View</a>
                                                                                         @else
                                                <span class="badge badge-secondary mt-2">Not Uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Address Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0 font-weight-bold"><i class="fas fa-map-marker-alt mr-2"></i>Address Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Present Address</h5>
                            <p class="lead">{{ $personalInfo->present ?? 'Not Available' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Permanent Address</h5>
                            <p class="lead">{{ $personalInfo->permanent ?? 'Not Available' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-3 mb-2">
                    <a href="{{ route('personal11', $personalInfo->applicationid ?? '') }}" class="btn btn-primary btn-block">
                        <i class="fas fa-edit mr-1"></i> Edit Profile
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('personal11', $personalInfo->applicationid ?? '') }}" class="btn btn-info btn-block" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Profile
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('personal11') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        font-weight: 600;
    }
    
    table.table-hover tr:hover {
        background-color: rgba(0,0,0,0.03);
    }
    
    .table td {
        vertical-align: middle;
    }
    
    @media print {
        .btn {
            display: none;
        }
        
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd;
        }
        
        body {
            padding: 0;
            margin: 0;
        }
    }
</style>
@endsection