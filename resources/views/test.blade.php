$results = DB::table('personalinfo as p')
        ->join('childinfo as c', 'p.userid', '=', 'c.userid')
        ->join('preferred_five_districts as prf', 'p.userid', '=', 'prf.userid')
        ->join('release_details as rls', 'p.userid', '=', 'rls.userid')
        ->join('wifeinfo as w', 'p.userid', '=', 'w.userid')
        ->join('working_history_officer as whf_current', 'p.userid', '=', 'whf_current.userid')
        ->join('working_history_officer as whf_before', 'p.userid', '=', 'whf_before.userid')
        ->where('whf_current.status','present')
        ->where('whf_before.status','before')
        ->orderBy('whf.start')
        ->orderBy('whf.designation')
        ->orderBy('whf.district')
        ->select(
            'p.id as id',
            'p.name',
        'p.home_district',
        'p.serviceid',
        'p.gradation',
        'p.marital_status',
        'whf_current.district as current_district',
        'whf_current.designation as current_designation',
        'whf_current.office as current_office',
        'whf_current.start as current_start',
        'whf_before.district as before_district',
        'w.wifename as wife_name',
        'w.profession as wife_profession',
        'w.designation as wife_designation',
        'w.wifeworkplace',
        'w.wifehomedistrict',
        'c.name as child_name',
        'c.age as child_age',
        'c.educationtype as child_educationtype',
        'c.educationlocation as child_educationlocation',
        'prf.district as preferred_district',
        'prf.reason as preferred_reason'
        )
        ->get();
          dd($results);   