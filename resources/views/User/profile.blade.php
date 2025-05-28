@extends('common.notary2')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 font-weight-bold">প্রোফাইল</h3>
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
                                    <h4 class="border-bottom pb-2 mb-3"><i class="fas fa-user-circle mr-2"></i>ব্যাক্তিগত তথ্যাদি</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted"> নাম    </p>
                                    <p class="font-weight-bold">{{ $personalInfo->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">পিতা</p>
                                    <p class="font-weight-bold">{{ $personalInfo->father ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">মাতা</p>
                                    <p class="font-weight-bold">{{ $personalInfo->mother ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">জন্ম তারিখ</p>
                                    <p class="font-weight-bold">{{ isset($personalInfo->dob) ? date('F d, Y', strtotime($personalInfo->dob)) : 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">জাতীয় পরিচয় পত্রের নম্বর  </p>
                                    <p class="font-weight-bold">{{ $personalInfo->nid ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">জেলা  </p>
                                    <p class="font-weight-bold">{{ $personalInfo->district ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">মোবাইল</p>
                                    <p class="font-weight-bold">{{ $personalInfo->mobile ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">ইমেইল</p>
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
                            <h4 class="mb-0 font-weight-bold"><i class="fas fa-gavel mr-2"></i> নোটারি সংক্রান্ত  </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="text-muted">বার কাউন্সিলের নাম্বার </td>
                                        <td class="font-weight-bold">{{ $notaryInfo->barnumber ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">বার কাউন্সিলের সনদ প্রাপ্তির তারিখ </td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->bardate) ? date('F d, Y', strtotime($notaryInfo->bardate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">আইনজীবী সদস্যের নাম্বার </td>
                                        <td class="font-weight-bold">{{ $notaryInfo->lawnumber ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">আইনজীবী সদস্য প্রাপ্তির তারিখ </td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->lawdate) ? date('F d, Y', strtotime($notaryInfo->lawdate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">অভিজ্ঞতা ( বছর )</td>
                                        <td class="font-weight-bold">{{ $notaryInfo->exp ?? 'N/A' }} Years</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">নোটারি স্মারক   </td>
                                        <td class="font-weight-bold">{{ $notaryInfo->notarysarok ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">নোটারি  সনদ প্রাপ্তির তারিখ </td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->natarydate) ? date('F d, Y', strtotime($notaryInfo->natarydate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">যে জেলার জন্য নোটারি  সনদ প্রাপ্ত হয়েছেন </td>
                                        <td class="font-weight-bold">{{ $notaryInfo->area ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">পরবর্তী নবায়ন</td>
                                        <td class="font-weight-bold">{{ isset($notaryInfo->renewdate) ? date('F d, Y', strtotime($notaryInfo->renewdate)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">সর্বশেষ নবায়ন  </td>
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
                            <h4 class="mb-0 font-weight-bold"><i class="fas fa-graduation-cap mr-2"></i> শিক্ষা সংক্রান্ত   </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="text-muted">এস সি পাসের সন  
</td>
                                        <td class="font-weight-bold">{{ $educationInfo->sscpass ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">এইচ এস সি পাসের সন</td>
                                        <td class="font-weight-bold">{{ $educationInfo->hscpass ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">সম্মান/স্নাতক পাসের সন</td>
                                        <td class="font-weight-bold">{{ $educationInfo->edu1 ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"> স্নাতকোত্তর পাসের সন</td>
                                        <td class="font-weight-bold">{{ $educationInfo->edu2 ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Documents Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning">
                            <h4 class="mb-0 font-weight-bold"><i class="fas fa-file-alt mr-2"></i>ডকুমেন্ট আপলোড </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-signature fa-2x mb-2 text-primary"></i>
                                            <h6 class="mb-0">স্বাক্ষর    </h6>
                                           
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
                                            <h6 class="mb-0">বার সার্টিফিকেট</h6>
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
                                            <h6 class="mb-0">নোটারি সার্টিফিকেট</h6>
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
                                            <h6 class="mb-0">এনআইডি</h6>
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
                    <h4 class="mb-0 font-weight-bold"><i class="fas fa-map-marker-alt mr-2"></i>ঠিকানা   </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">বর্তমান</h5>
                            <p class="lead">{{ $personalInfo->present ?? 'Not Available' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">স্থায়ী  </h5>
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